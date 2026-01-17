<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BlogPost;
use App\Models\Service;
use App\Models\CaseStudy;
use App\Models\BlogCategory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap
     */
    public function index(): Response
    {
        $sitemap = Cache::remember('sitemap_index', 3600, function () {
            $baseUrl = config('app.url');
            $now = now()->toAtomString();

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
            $xml .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"';
            $xml .= ' xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";

            // Homepage
            $xml .= $this->urlElement($baseUrl, $now, '1.0', 'daily');

            // Static Pages
            $staticPages = [
                ['url' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['url' => route('pricing'), 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['url' => route('portfolio'), 'priority' => '0.8', 'changefreq' => 'weekly'],
                ['url' => route('contact.index'), 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['url' => route('products.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
                ['url' => route('services.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
                ['url' => route('blog.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ];

            foreach ($staticPages as $page) {
                $xml .= $this->urlElement($page['url'], $now, $page['priority'], $page['changefreq']);
            }

            // Products
            $products = Product::published()->get();
            foreach ($products as $product) {
                $lastmod = $product->updated_at->toAtomString();
                $xml .= $this->urlElement(
                    route('products.show', $product),
                    $lastmod,
                    '0.8',
                    'weekly',
                    $product->image ? Storage::url($product->image) : null,
                    $product->name
                );
            }

            // Services
            $services = Service::published()->get();
            foreach ($services as $service) {
                $lastmod = $service->updated_at->toAtomString();
                $xml .= $this->urlElement(
                    route('services.show', $service),
                    $lastmod,
                    '0.8',
                    'weekly'
                );
            }

            // Blog Posts
            $posts = BlogPost::published()->get();
            foreach ($posts as $post) {
                $lastmod = $post->updated_at->toAtomString();
                $xml .= $this->urlElement(
                    route('blog.show', $post),
                    $lastmod,
                    '0.7',
                    'monthly',
                    $post->featured_image ? Storage::url($post->featured_image) : null,
                    $post->title
                );
            }

            // Blog Categories
            $categories = BlogCategory::all();
            foreach ($categories as $category) {
                $xml .= $this->urlElement(
                    route('blog.category', $category),
                    $now,
                    '0.6',
                    'weekly'
                );
            }

            // Case Studies
            $caseStudies = CaseStudy::published()->get();
            foreach ($caseStudies as $caseStudy) {
                $lastmod = $caseStudy->updated_at->toAtomString();
                $xml .= $this->urlElement(
                    route('portfolio.show', $caseStudy),
                    $lastmod,
                    '0.7',
                    'monthly'
                );
            }

            $xml .= '</urlset>';

            return $xml;
        });

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate URL element for sitemap
     */
    private function urlElement(
        string $url,
        string $lastmod,
        string $priority = '0.5',
        string $changefreq = 'monthly',
        ?string $imageUrl = null,
        ?string $imageTitle = null
    ): string {
        $xml = "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($url) . "</loc>\n";
        $xml .= "    <lastmod>" . $lastmod . "</lastmod>\n";
        $xml .= "    <changefreq>" . $changefreq . "</changefreq>\n";
        $xml .= "    <priority>" . $priority . "</priority>\n";

        if ($imageUrl) {
            $xml .= "    <image:image>\n";
            $xml .= "      <image:loc>" . htmlspecialchars($imageUrl) . "</image:loc>\n";
            if ($imageTitle) {
                $xml .= "      <image:title>" . htmlspecialchars($imageTitle) . "</image:title>\n";
            }
            $xml .= "    </image:image>\n";
        }

        $xml .= "  </url>\n";

        return $xml;
    }
}
