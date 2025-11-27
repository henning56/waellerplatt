{{-- SEO partial: accepts a `$meta` array or uses defaults provided by AppServiceProvider --}}
@php
    $title = $meta['title'] ?? config('app.name');
    $description = $meta['description'] ?? config('app.description', '');
    $canonical = $meta['canonical'] ?? url()->current();
    $image = $meta['image'] ?? asset('images/default.png');
    $published = $meta['published'] ?? null;
    $modified = $meta['modified'] ?? null;
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="index, follow">

<!-- Open Graph -->
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:type" content="{{ $meta['og_type'] ?? 'website' }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

@if($published || $modified)
    <meta property="article:published_time" content="{{ $published }}">
    <meta property="article:modified_time" content="{{ $modified }}">
@endif

<!-- JSON-LD basic Organization (override by providing `jsonld` in $meta) -->
@php
    $jsonld = $meta['jsonld'] ?? [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => config('app.name'),
        'url' => config('app.url'),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($jsonld, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
