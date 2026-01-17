<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    /**
     * Generate robots.txt
     */
    public function index(): Response
    {
        $sitemapUrl = config('app.url') . '/sitemap.xml';

        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n";
        $robots .= "Disallow: /checkout/\n";
        $robots .= "Disallow: /downloads/\n";
        $robots .= "Disallow: /cart/\n";
        $robots .= "Disallow: /profile/\n";
        $robots .= "Disallow: /dashboard/\n";
        $robots .= "\n";
        $robots .= "User-agent: Googlebot\n";
        $robots .= "Allow: /\n";
        $robots .= "\n";
        $robots .= "User-agent: Bingbot\n";
        $robots .= "Allow: /\n";
        $robots .= "\n";
        $robots .= "Sitemap: {$sitemapUrl}\n";

        return response($robots, 200)
            ->header('Content-Type', 'text/plain; charset=utf-8');
    }
}
