<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $posts = BlogPost::published()
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->published();
        }])->orderBy('sort_order')->get();

        $featuredPosts = BlogPost::published()
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'featuredPosts'));
    }

    public function show(BlogPost $post): View
    {
        // Only show published posts
        if (!$post->is_published) {
            abort(404);
        }

        // Increment views
        $post->incrementViews();

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->when($post->category_id, function ($query) use ($post) {
                $query->where('category_id', $post->category_id);
            })
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category(BlogCategory $category): View
    {
        $posts = $category->posts()
            ->published()
            ->with(['author'])
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = BlogCategory::withCount(['posts' => function ($query) {
            $query->published();
        }])->orderBy('sort_order')->get();

        return view('blog.category', compact('category', 'posts', 'categories'));
    }
}
