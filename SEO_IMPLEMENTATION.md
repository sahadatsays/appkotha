# SEO Implementation Guide for appKotha

This document outlines the SEO best practices implemented for the appKotha Laravel application.

## 📋 Table of Contents

1. [Meta Tags](#meta-tags)
2. [Structured Data (JSON-LD)](#structured-data-json-ld)
3. [Sitemap](#sitemap)
4. [Robots.txt](#robotstxt)
5. [URL Structure](#url-structure)
6. [Page Speed Optimizations](#page-speed-optimizations)
7. [Implementation Examples](#implementation-examples)

---

## Meta Tags

### Implementation

The `SeoService` class handles all meta tag generation. Use the `<x-seo-meta>` component in your Blade templates.

**Features:**
- ✅ Primary meta tags (title, description, keywords)
- ✅ Open Graph tags (Facebook, LinkedIn)
- ✅ Twitter Card tags
- ✅ Canonical URLs
- ✅ Product-specific meta tags (price, currency)
- ✅ Article-specific meta tags (published time, author)

### Usage in Controllers

```php
use App\Services\SeoService;

public function show(Product $product)
{
    $seo = app(SeoService::class);
    $seoMeta = $seo->getProductMeta($product);
    
    return view('products.show', [
        'product' => $product,
        'seoMeta' => $seoMeta,
        'structuredDataType' => 'product',
        'structuredData' => $product,
    ]);
}
```

### Usage in Blade Templates

```blade
<x-seo-meta
    :title="$seoMeta['title']"
    :description="$seoMeta['description']"
    :image="$seoMeta['image']"
    :url="$seoMeta['url']"
    :type="$seoMeta['type']"
/>
```

---

## Structured Data (JSON-LD)

### Supported Types

1. **Organization** - Company information
2. **Product** - Product details with pricing
3. **Article** - Blog posts
4. **BreadcrumbList** - Navigation breadcrumbs
5. **FAQPage** - FAQ sections
6. **WebSite** - Site-wide search action

### Implementation

Use the `<x-seo-structured-data>` component:

```blade
<!-- Default (Organization + WebSite) -->
<x-seo-structured-data />

<!-- Product -->
<x-seo-structured-data type="product" :data="$product" />

<!-- Article -->
<x-seo-structured-data type="article" :data="$post" />

<!-- Breadcrumbs -->
<x-seo-structured-data 
    type="breadcrumb" 
    :data="[
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Products', 'url' => route('products.index')],
        ['name' => $product->name, 'url' => route('products.show', $product)]
    ]" 
/>
```

---

## Sitemap

### Access

- **URL**: `/sitemap.xml`
- **Route**: `sitemap`
- **Caching**: 1 hour (3600 seconds)

### Included Pages

- ✅ Homepage
- ✅ Static pages (About, Pricing, Portfolio, Contact)
- ✅ All published products
- ✅ All published services
- ✅ All published blog posts
- ✅ Blog categories
- ✅ Case studies

### Features

- Image sitemap support
- Priority and change frequency
- Last modified dates
- Automatic cache invalidation

### Manual Cache Clear

```php
Cache::forget('sitemap_index');
```

---

## Robots.txt

### Access

- **URL**: `/robots.txt`
- **Route**: `robots`

### Configuration

**Allowed:**
- All public pages
- Product pages
- Blog posts
- Services

**Disallowed:**
- `/admin/` - Admin panel
- `/api/` - API endpoints
- `/checkout/` - Checkout pages
- `/downloads/` - User downloads
- `/cart/` - Shopping cart
- `/profile/` - User profiles
- `/dashboard/` - User dashboard

**Sitemap Reference:**
- Automatically includes sitemap URL

---

## URL Structure

### Best Practices Implemented

1. **Clean URLs**
   - Products: `/products/{slug}`
   - Services: `/services/{slug}`
   - Blog: `/blog/{slug}`
   - Categories: `/blog/category/{slug}`

2. **Slug Generation**
   - Automatic from titles
   - Unique constraint
   - SEO-friendly (lowercase, hyphens)

3. **Canonical URLs**
   - Prevents duplicate content
   - Points to primary URL

### URL Examples

```
✅ Good:
/products/laravel-admin-panel
/blog/getting-started-with-laravel
/services/web-development

❌ Bad:
/products/123
/blog/post?id=456
```

---

## Page Speed Optimizations

### Implemented

1. **Lazy Loading**
   - Images load on scroll
   - Defer non-critical scripts

2. **Resource Hints**
   - `preconnect` for fonts
   - `dns-prefetch` for external resources

3. **Caching**
   - Sitemap caching (1 hour)
   - Settings caching (1 hour)
   - View caching for static content

4. **Minification**
   - CSS/JS via Vite
   - HTML minification (production)

5. **Image Optimization**
   - Responsive images
   - WebP format support
   - Proper sizing

### Recommendations

1. **Enable Compression**
   ```apache
   # .htaccess
   <IfModule mod_deflate.c>
       AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
   </IfModule>
   ```

2. **Browser Caching**
   ```apache
   <IfModule mod_expires.c>
       ExpiresActive On
       ExpiresByType image/jpg "access plus 1 year"
       ExpiresByType image/jpeg "access plus 1 year"
       ExpiresByType image/png "access plus 1 year"
       ExpiresByType text/css "access plus 1 month"
       ExpiresByType application/javascript "access plus 1 month"
   </IfModule>
   ```

3. **CDN Integration**
   - Use CDN for static assets
   - Cloudflare or AWS CloudFront

---

## Implementation Examples

### Product Page

```php
// Controller
public function show(Product $product)
{
    $seo = app(SeoService::class);
    
    return view('products.show', [
        'product' => $product,
        'seoMeta' => $seo->getProductMeta($product),
        'structuredDataType' => 'product',
        'structuredData' => $product,
        'breadcrumbs' => [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Products', 'url' => route('products.index')],
            ['name' => $product->name, 'url' => route('products.show', $product)]
        ],
    ]);
}
```

```blade
{{-- products/show.blade.php --}}
<x-frontend-layout>
    <x-seo-meta
        :title="$seoMeta['title']"
        :description="$seoMeta['description']"
        :image="$seoMeta['image']"
        :url="$seoMeta['url']"
        :type="'product'"
        :price="$seoMeta['price']"
    />
    
    <x-seo-structured-data type="product" :data="$product" />
    <x-seo-structured-data type="breadcrumb" :data="$breadcrumbs" />
    
    {{-- Product content --}}
</x-frontend-layout>
```

### Blog Post Page

```php
// Controller
public function show(BlogPost $post)
{
    $seo = app(SeoService::class);
    
    return view('blog.show', [
        'post' => $post,
        'seoMeta' => $seo->getBlogPostMeta($post),
        'structuredDataType' => 'article',
        'structuredData' => $post,
    ]);
}
```

### Homepage

```php
// Controller
public function index()
{
    $seo = app(SeoService::class);
    
    return view('pages.home', [
        'seoMeta' => $seo->getDefaultMeta(),
        'structuredDataType' => 'default', // Includes Organization + WebSite
    ]);
}
```

---

## Testing SEO

### Tools

1. **Google Search Console**
   - Submit sitemap: `https://yoursite.com/sitemap.xml`
   - Monitor indexing
   - Check for errors

2. **Google Rich Results Test**
   - Test structured data: https://search.google.com/test/rich-results

3. **PageSpeed Insights**
   - Test performance: https://pagespeed.web.dev/

4. **Schema.org Validator**
   - Validate JSON-LD: https://validator.schema.org/

### Checklist

- [ ] All pages have unique titles
- [ ] Meta descriptions are 150-160 characters
- [ ] Images have alt text
- [ ] Canonical URLs are set
- [ ] Sitemap is accessible
- [ ] Robots.txt is configured
- [ ] Structured data validates
- [ ] Mobile-friendly (responsive)
- [ ] Fast page load (< 3 seconds)
- [ ] HTTPS enabled

---

## Settings Configuration

Configure SEO settings in the admin panel:

1. **Company Information** (`/admin/settings/grouped`)
   - Company name
   - Description
   - Logo
   - Address

2. **SEO Settings**
   - Default keywords
   - Meta descriptions
   - Social media links

3. **Social Media**
   - Facebook URL
   - Twitter handle
   - LinkedIn URL
   - Instagram URL

---

## Maintenance

### Regular Tasks

1. **Update Sitemap**
   - Automatically regenerated every hour
   - Clear cache after major content updates

2. **Monitor Search Console**
   - Check for crawl errors
   - Monitor indexing status
   - Review search performance

3. **Update Structured Data**
   - Test after schema changes
   - Validate with Google tools

4. **Performance Monitoring**
   - Regular PageSpeed tests
   - Monitor Core Web Vitals
   - Optimize slow pages

---

## Support

For questions or issues:
- Check Laravel documentation
- Review schema.org documentation
- Google Search Central guidelines

---

**Last Updated**: {{ date('Y-m-d') }}
