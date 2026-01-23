@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
    'siteName' => null,
    'publishedTime' => null,
    'modifiedTime' => null,
    'author' => null,
    'price' => null,
    'currency' => 'BDT',
])

@php
    $seo = app(\App\Services\SeoService::class);
    $defaultMeta = $seo->getDefaultMeta();

    $metaTitle = $title ?? $defaultMeta['title'];
    $metaDescription = $description ?? $defaultMeta['description'];
    $metaKeywords = $keywords ?? $defaultMeta['keywords'];
    $metaImage = $image ?? $defaultMeta['image'];
    $metaUrl = $url ?? $defaultMeta['url'];
    $metaType = $type ?? $defaultMeta['type'];
    $metaSiteName = $siteName ?? $defaultMeta['site_name'];
@endphp

<!-- Primary Meta Tags -->
<title>{{ $metaTitle }}</title>
<meta name="title" content="{{ $metaTitle }}">
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $metaKeywords }}">
<meta name="author" content="{{ $author ?? $metaSiteName }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="language" content="English">
<meta name="revisit-after" content="7 days">
<meta name="rating" content="general">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $metaType }}">
<meta property="og:url" content="{{ $metaUrl }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ $metaImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="{{ $metaSiteName }}">
<meta property="og:locale" content="en_US">

@if($publishedTime)
    <meta property="article:published_time" content="{{ $publishedTime }}">
@endif

@if($modifiedTime)
    <meta property="article:modified_time" content="{{ $modifiedTime }}">
@endif

@if($author)
    <meta property="article:author" content="{{ $author }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $metaUrl }}">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $metaImage }}">
@if(setting('social.twitter_handle'))
    <meta name="twitter:site" content="@{{ setting('social.twitter_handle') }}">
    <meta name="twitter:creator" content="@{{ setting('social.twitter_handle') }}">
@endif

<!-- Additional Meta Tags -->
<link rel="canonical" href="{{ $metaUrl }}">
<meta name="theme-color" content="#6366f1">

@if($price)
    <meta property="product:price:amount" content="{{ $price }}">
    <meta property="product:price:currency" content="{{ $currency }}">
@endif

<!-- Geo Tags (if applicable) -->
@if(setting('company.country'))
    <meta name="geo.region" content="{{ setting('company.country') }}">
@endif

@if(setting('company.city'))
    <meta name="geo.placename" content="{{ setting('company.city') }}">
@endif
