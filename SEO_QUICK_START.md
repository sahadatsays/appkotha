# SEO Quick Start Guide

## 🚀 Quick Implementation

### 1. Update Product Controller

```php
// app/Http/Controllers/Frontend/ProductController.php

use App\Services\SeoService;

public function show(Product $product): View
{
    if (!$product->is_published) {
        abort(404);
    }

    $seo = app(SeoService::class);
    
    $relatedProducts = Product::published()
        ->where('id', '!=', $product->id)
        ->take(3)
        ->get();

    return view('products.show', [
        'product' => $product,
        'relatedProducts' => $relatedProducts,
        'seoMeta' => $seo->getProductMeta($product),
        'structuredDataType' => 'product',
        'structuredData' => $product,
    ]);
}
```

### 2. Update Blog Controller

```php
// app/Http/Controllers/Frontend/BlogController.php

use App\Services\SeoService;

public function show(BlogPost $post): View
{
    if (!$post->is_published) {
        abort(404);
    }

    $post->incrementViews();
    
    $seo = app(SeoService::class);

    $relatedPosts = BlogPost::published()
        ->where('id', '!=', $post->id)
        ->when($post->category_id, function ($query) use ($post) {
            $query->where('category_id', $post->category_id);
        })
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    return view('blog.show', [
        'post' => $post,
        'relatedPosts' => $relatedPosts,
        'seoMeta' => $seo->getBlogPostMeta($post),
        'structuredDataType' => 'article',
        'structuredData' => $post,
    ]);
}
```

### 3. Update Service Controller

```php
// app/Http/Controllers/Frontend/ServiceController.php

use App\Services\SeoService;

public function show(Service $service): View
{
    if (!$service->is_published) {
        abort(404);
    }

    $seo = app(SeoService::class);

    return view('services.show', [
        'service' => $service,
        'seoMeta' => $seo->getServiceMeta($service),
        'structuredDataType' => 'default', // or create service schema
        'structuredData' => null,
    ]);
}
```

### 4. Update Home Controller

```php
// app/Http/Controllers/Frontend/HomeController.php

use App\Services\SeoService;

public function index(): View
{
    $seo = app(SeoService::class);
    
    $products = Product::published()
        ->featured()
        ->orderBy('sort_order')
        ->take(3)
        ->get();

    $services = Service::published()
        ->featured()
        ->orderBy('sort_order')
        ->take(4)
        ->get();

    $testimonials = Testimonial::published()
        ->featured()
        ->orderBy('sort_order')
        ->take(3)
        ->get();

    $caseStudies = CaseStudy::published()
        ->featured()
        ->orderBy('sort_order')
        ->take(2)
        ->get();

    $latestPosts = BlogPost::published()
        ->with(['category', 'author'])
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    return view('pages.home', [
        'products' => $products,
        'services' => $services,
        'testimonials' => $testimonials,
        'caseStudies' => $caseStudies,
        'latestPosts' => $latestPosts,
        'seoMeta' => $seo->getDefaultMeta(),
        'structuredDataType' => 'default',
    ]);
}
```

## ✅ Testing Checklist

1. **Check Sitemap**: Visit `/sitemap.xml`
2. **Check Robots**: Visit `/robots.txt`
3. **Test Meta Tags**: View page source, check for:
   - `<title>` tag
   - Meta description
   - Open Graph tags
   - Twitter Card tags
   - Canonical URL

4. **Test Structured Data**:
   - Visit: https://search.google.com/test/rich-results
   - Enter your page URL
   - Verify schema validation

5. **Test Page Speed**:
   - Visit: https://pagespeed.web.dev/
   - Enter your URL
   - Aim for 90+ score

## 📝 Notes

- The frontend layout automatically includes SEO components
- Default meta tags are used if `$seoMeta` is not provided
- Structured data defaults to Organization + WebSite if not specified
- Sitemap is cached for 1 hour (clear cache after major updates)
