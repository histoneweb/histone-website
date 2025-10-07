<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sections.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/testimonials.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/faq.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact-form.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/legal.css') }}">

    @stack('styles')
</head>
<body data-theme="dark">

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
