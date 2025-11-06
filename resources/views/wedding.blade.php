<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Basic Meta Tags -->
    <title>{{ $page['props']['seo']['title'] ?? 'James & Dannica' }}</title>
    <meta name="description" content="{{ $page['props']['seo']['description'] ?? 'Mark your calendars for our special day as we celebrate love and new beginnings.' }}">
    <meta name="keywords" content="{{ $page['props']['seo']['keywords'] ?? 'wedding, James, Dannica, Villaluz, Tejada, marriage, celebration' }}">
    <meta name="author" content="{{ $page['props']['seo']['author'] ?? 'James & Dannica' }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="language" content="English">

    <!-- Favicon and icons -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $page['props']['seo']['title'] ?? 'James & Dannica' }}">
    <meta property="og:description" content="{{ $page['props']['seo']['description'] ?? 'Mark your calendars for our special day as we celebrate love and new beginnings.' }}">
    <meta property="og:image" content="{{ $page['props']['seo']['image'] ?? '/images/meta-image.png' }}">
    <meta property="og:image:alt" content="Dannica & James Wedding Celebration">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="{{ $page['props']['seo']['url'] ?? config('app.url') }}">
    <meta property="og:type" content="{{ $page['props']['seo']['type'] ?? 'website' }}">
    <meta property="og:site_name" content="{{ $page['props']['seo']['site_name'] ?? 'James & Dannica' }}">
    <meta property="og:locale" content="{{ $page['props']['seo']['locale'] ?? 'en_US' }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page['props']['seo']['title'] ?? 'James & Dannica' }}">
    <meta name="twitter:description" content="{{ $page['props']['seo']['description'] ?? 'Mark your calendars for our special day as we celebrate love and new beginnings.' }}">
    <meta name="twitter:image" content="{{ $page['props']['seo']['image'] ?? '/images/meta-image.png' }}">
    <meta name="twitter:image:alt" content="Dannica & James Wedding Celebration">

    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="#E6B8C2">
    <meta name="msapplication-TileColor" content="#E6B8C2">
    <meta name="application-name" content="James & Dannica">
    <meta name="apple-mobile-web-app-title" content="J&D Wedding">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $page['props']['seo']['url'] ?? config('app.url') }}">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">

    <!-- Wedding theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/wedding-theme.css') }}">

    @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="antialiased" style="font-family: var(--font-primary);">
    @inertia
</body>

</html>