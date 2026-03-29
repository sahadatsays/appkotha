<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogCategoryRequest;
use App\Http\Requests\Admin\StoreBlogPostRequest;
use App\Http\Requests\Admin\UpdateBlogCategoryRequest;
use App\Http\Requests\Admin\UpdateBlogPostRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author']);

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request) {
                $builder->where('title_en', 'like', '%'.$request->search.'%')
                    ->orWhere('title_bn', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = BlogCategory::orderBy('name_en')->get();

        return view('admin.blog.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('name_en')->get();

        return view('admin.blog.create', compact('categories'));
    }

    public function store(StoreBlogPostRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_en']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $validated['author_id'] = auth()->id();
        $validated['title'] = $validated['title_en'];
        $validated['excerpt'] = $validated['excerpt_en'] ?? null;
        $validated['content'] = $validated['content_en'];
        $validated['meta_title'] = $validated['meta_title_en'] ?? null;
        $validated['meta_description'] = $validated['meta_description_en'] ?? null;
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->boolean('is_published') && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::orderBy('name')->get();

        return view('admin.blog.edit', compact('post', 'categories'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $post)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_en']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $validated['title'] = $validated['title_en'];
        $validated['excerpt'] = $validated['excerpt_en'] ?? null;
        $validated['content'] = $validated['content_en'];
        $validated['meta_title'] = $validated['meta_title_en'] ?? null;
        $validated['meta_description'] = $validated['meta_description_en'] ?? null;
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['is_published'] && ! $post->is_published && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $post)
    {
        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    public function togglePublish(BlogPost $post)
    {
        $post->update([
            'is_published' => ! $post->is_published,
            'published_at' => ! $post->is_published ? now() : $post->published_at,
        ]);

        return back()->with('success', 'Post status updated.');
    }

    // Categories Management
    public function categories()
    {
        $categories = BlogCategory::withCount('posts')->orderBy('name_en')->get();

        return view('admin.blog.categories', compact('categories'));
    }

    public function storeCategory(StoreBlogCategoryRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        $validated['name'] = $validated['name_en'];
        $validated['description'] = $validated['description_en'] ?? null;

        BlogCategory::create($validated);

        return back()->with('success', 'Category created successfully.');
    }

    public function updateCategory(UpdateBlogCategoryRequest $request, BlogCategory $category)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        $validated['name'] = $validated['name_en'];
        $validated['description'] = $validated['description_en'] ?? null;

        $category->update($validated);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(BlogCategory $category)
    {
        if ($category->posts()->count() > 0) {
            return back()->with('error', 'Cannot delete category with posts.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}
