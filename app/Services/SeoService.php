<?php

namespace App\Services;

use App\Models\Product;
use App\Models\BlogPost;
use App\Models\Service;
use App\Models\CaseStudy;
use App\Models\Setting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeoService
{
    /**
     * Get default meta tags
     */
    public function getDefaultMeta(): array
    {
        $siteName = setting('company.name', config('app.name', 'appKotha'));
        $siteDescription = setting('company.description', 'Premium digital products and custom software development services from Bangladesh. Trusted by 500+ clients worldwide.');
        $siteUrl = config('app.url');

        return [
            'title' => $siteName . ' | Software Solutions from Bangladesh',
            'description' => $siteDescription,
            'keywords' => setting('seo.keywords', 'software development, digital products, web development, mobile apps, Bangladesh, Laravel, PHP'),
            'image' => $this->getImageUrl(setting('company.logo')),
            'url' => $siteUrl,
            'type' => 'website',
            'site_name' => $siteName,
        ];
    }

    /**
     * Get meta tags for a product
     */
    public function getProductMeta(Product $product): array
    {
        $siteName = setting('company.name', config('app.name', 'appKotha'));
        $title = $product->meta_title ?: $product->name . ' - ' . $siteName;
        $description = $product->meta_description ?: $product->short_description ?: Str::limit(strip_tags($product->description ?? ''), 160);
        $image = $product->image ? Storage::url($product->image) : $this->getImageUrl(setting('company.logo'));

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $this->generateKeywords($product->name, $product->tagline),
            'image' => $image,
            'url' => route('products.show', $product),
            'type' => 'product',
            'site_name' => $siteName,
            'price' => $product->effective_price,
            'currency' => 'BDT',
        ];
    }

    /**
     * Get meta tags for a blog post
     */
    public function getBlogPostMeta(BlogPost $post): array
    {
        $siteName = setting('company.name', config('app.name', 'appKotha'));
        $title = $post->meta_title ?: $post->title . ' - ' . $siteName;
        $description = $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?? $post->content ?? ''), 160);
        $image = $post->featured_image ? Storage::url($post->featured_image) : $this->getImageUrl(setting('company.logo'));

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $this->generateKeywords($post->title, $post->excerpt),
            'image' => $image,
            'url' => route('blog.show', $post),
            'type' => 'article',
            'site_name' => $siteName,
            'published_time' => $post->published_at?->toISOString(),
            'modified_time' => $post->updated_at->toISOString(),
            'author' => $post->author?->name ?? $siteName,
        ];
    }

    /**
     * Get meta tags for a service
     */
    public function getServiceMeta(Service $service): array
    {
        $siteName = setting('company.name', config('app.name', 'appKotha'));
        $title = $service->meta_title ?: $service->name . ' - ' . $siteName;
        $description = $service->meta_description ?: $service->short_description ?: Str::limit(strip_tags($service->description ?? ''), 160);
        $image = $service->image ? Storage::url($service->image) : $this->getImageUrl(setting('company.logo'));

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $this->generateKeywords($service->name, $service->tagline),
            'image' => $image,
            'url' => route('services.show', $service),
            'type' => 'service',
            'site_name' => $siteName,
        ];
    }

    /**
     * Generate Organization structured data
     */
    public function getOrganizationSchema(): array
    {
        $siteUrl = config('app.url');
        $companyName = setting('company.name', config('app.name', 'appKotha'));
        $logo = $this->getImageUrl(setting('company.logo'));

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $companyName,
            'url' => $siteUrl,
            'logo' => $logo,
            'description' => setting('company.description', 'Premium digital products and custom software development services'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => setting('company.country', 'BD'),
                'addressLocality' => setting('company.city', 'Dhaka'),
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => setting('contact.phone'),
                'contactType' => 'Customer Service',
                'email' => setting('contact.email'),
            ],
            'sameAs' => $this->getSocialLinks(),
        ];
    }

    /**
     * Generate Product structured data
     */
    public function getProductSchema(Product $product): array
    {
        $siteUrl = config('app.url');
        $image = $product->image ? Storage::url($product->image) : $this->getImageUrl(setting('company.logo'));

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => strip_tags($product->description ?? $product->short_description ?? ''),
            'image' => $image,
            'url' => route('products.show', $product),
            'sku' => 'PROD-' . $product->id,
            'offers' => [
                '@type' => 'Offer',
                'price' => $product->effective_price,
                'priceCurrency' => 'BDT',
                'availability' => $product->is_published ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                'url' => route('products.show', $product),
            ],
        ];

        if ($product->sale_price && $product->sale_price < $product->price) {
            $schema['offers']['price'] = $product->sale_price;
            $schema['offers']['priceSpecification'] = [
                '@type' => 'UnitPriceSpecification',
                'price' => $product->sale_price,
                'priceCurrency' => 'BDT',
                'referenceQuantity' => [
                    '@type' => 'QuantitativeValue',
                    'value' => 1,
                    'unitCode' => 'C62',
                ],
            ];
        }

        return $schema;
    }

    /**
     * Generate Article structured data (for blog posts)
     */
    public function getArticleSchema(BlogPost $post): array
    {
        $siteUrl = config('app.url');
        $image = $post->featured_image ? Storage::url($post->featured_image) : $this->getImageUrl(setting('company.logo'));
        $companyName = setting('company.name', config('app.name', 'appKotha'));

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => strip_tags($post->excerpt ?? Str::limit($post->content ?? '', 200)),
            'image' => $image,
            'datePublished' => $post->published_at?->toISOString(),
            'dateModified' => $post->updated_at->toISOString(),
            'author' => [
                '@type' => 'Person',
                'name' => $post->author?->name ?? $companyName,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $companyName,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $this->getImageUrl(setting('company.logo')),
                ],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('blog.show', $post),
            ],
        ];
    }

    /**
     * Generate BreadcrumbList structured data
     */
    public function getBreadcrumbSchema(array $items): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [],
        ];

        $position = 1;
        foreach ($items as $item) {
            $schema['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $item['name'],
                'item' => $item['url'] ?? null,
            ];
        }

        return $schema;
    }

    /**
     * Generate FAQPage structured data
     */
    public function getFaqSchema(array $faqs): array
    {
        $mainEntity = [];
        foreach ($faqs as $faq) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => strip_tags($faq['answer']),
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity,
        ];
    }

    /**
     * Generate WebSite structured data with search action
     */
    public function getWebSiteSchema(): array
    {
        $siteUrl = config('app.url');
        $companyName = setting('company.name', config('app.name', 'appKotha'));

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $companyName,
            'url' => $siteUrl,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $siteUrl . '/search?q={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * Generate keywords from text
     */
    private function generateKeywords(string $title, ?string $subtitle = null): string
    {
        $keywords = [];
        $baseKeywords = setting('seo.keywords', 'software development, digital products, web development, Bangladesh');

        // Extract keywords from title
        $titleWords = explode(' ', strtolower($title));
        $keywords = array_merge($keywords, array_slice($titleWords, 0, 3));

        if ($subtitle) {
            $subtitleWords = explode(' ', strtolower($subtitle));
            $keywords = array_merge($keywords, array_slice($subtitleWords, 0, 2));
        }

        return implode(', ', array_unique(array_merge($keywords, explode(', ', $baseKeywords))));
    }

    /**
     * Get image URL (full URL)
     */
    private function getImageUrl(?string $path): string
    {
        if (!$path) {
            return config('app.url') . '/images/og-default.jpg';
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return Storage::url($path);
    }

    /**
     * Get social media links
     */
    private function getSocialLinks(): array
    {
        $links = [];
        $socialSettings = Setting::getGroup('social');

        foreach (['facebook', 'twitter', 'linkedin', 'instagram', 'youtube', 'github'] as $platform) {
            if (!empty($socialSettings[$platform . '_url'])) {
                $links[] = $socialSettings[$platform . '_url'];
            }
        }

        return $links;
    }
}
