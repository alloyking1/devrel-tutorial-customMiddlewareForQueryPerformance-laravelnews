<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::where('title', 'like', '%API%')
            ->limit(10)
            ->get();
    }
}
