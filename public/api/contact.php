<?php
/**
 * Contact Form API Endpoint
 *
 * Handles contact form submissions via AJAX
 */

// Set headers for JSON response
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// Enable CORS for same-origin only
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Load dependencies
require_once __DIR__ . '/../../app/ContactHandler.php';

try {
    // Process contact form
    $handler = new ContactHandler();
    $result = $handler->process();

    // Set appropriate HTTP status code
    http_response_code($result['success'] ? 200 : 400);

    // Return JSON response
    echo json_encode($result, JSON_PRETTY_PRINT);

} catch (Exception $e) {
    // Log error
    error_log('Contact API error: ' . $e->getMessage());

    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An unexpected error occurred. Please try again later.',
        'errors' => []
    ], JSON_PRETTY_PRINT);
}
