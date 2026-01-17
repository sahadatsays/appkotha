@props([
    'type' => 'default', // default, product, article, organization, breadcrumb, faq, website
    'data' => null,
])

@php
    $seo = app(\App\Services\SeoService::class);
    $schema = null;
    
    switch($type) {
        case 'organization':
            $schema = $seo->getOrganizationSchema();
            break;
        case 'product':
            $schema = $data ? $seo->getProductSchema($data) : null;
            break;
        case 'article':
            $schema = $data ? $seo->getArticleSchema($data) : null;
            break;
        case 'breadcrumb':
            $schema = $data ? $seo->getBreadcrumbSchema($data) : null;
            break;
        case 'faq':
            $schema = $data ? $seo->getFaqSchema($data) : null;
            break;
        case 'website':
            $schema = $seo->getWebSiteSchema();
            break;
        default:
            // Default: include organization and website
            break;
    }
@endphp

@if($type === 'default')
    <!-- Organization Schema -->
    <script type="application/ld+json">
        {!! json_encode($seo->getOrganizationSchema(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- WebSite Schema with SearchAction -->
    <script type="application/ld+json">
        {!! json_encode($seo->getWebSiteSchema(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@elseif($schema)
    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endif
