<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostIndexController extends Controller
{

    public function __invoke(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::published()
            ->when($request->has('category'), fn ($query) => $query->whereHas(
                'category', fn ($query) => $query->where('slug', $request->input('category'))
            ))
            ->published()
            ->simplePaginate();

        return view('posts.index', [
            'posts' => $posts,
            'category' => Category::find($request->input('category')),
        ]);
    }
}
