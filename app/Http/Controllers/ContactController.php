<?php

namespace App\Http\Controllers;

use App\Mail\ContactSubmissionAutoResponder;
use App\Mail\ContactSubmissionNotification;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Honeypot spam protection
        if ($request->filled('website')) {
            return response()->json([
                'success' => false,
                'message' => 'Spam detected.'
            ], 422);
        }

        // Rate limiting - 3 submissions per hour per IP
        $key = 'contact-form:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            return response()->json([
                'success' => false,
                'message' => "Too many submissions. Please try again in {$minutes} minutes."
            ], 429);
        }

        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Record the rate limit attempt
        RateLimiter::hit($key, 3600); // 1 hour

        // Create submission
        $submission = ContactSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'service' => $request->service,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'new',
        ]);

        // Send notification to company
        try {
            $companyEmail = config('mail.from.address', 'awaisnaseem1@gmail.com');
            Mail::to($companyEmail)->send(new ContactSubmissionNotification($submission));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact notification: ' . $e->getMessage());
        }

        // Send auto-responder to customer
        try {
            Mail::to($submission->email)->send(new ContactSubmissionAutoResponder($submission));
        } catch (\Exception $e) {
            \Log::error('Failed to send auto-responder: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you within 24-48 hours.'
        ]);
    }
}
