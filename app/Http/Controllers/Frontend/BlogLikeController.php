<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;

class BlogLikeController extends Controller
{
    public function store(BlogPost $post): RedirectResponse
    {
        $user = auth()->user();

        $user->blogLikes()->firstOrCreate([
            'blog_post_id' => $post->id,
        ]);

        return back()->with('status', 'Blog added to liked list.');
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        $user = auth()->user();

        $user->blogLikes()->where('blog_post_id', $post->id)->delete();

        return back()->with('status', 'Blog removed from liked list.');
    }
}
