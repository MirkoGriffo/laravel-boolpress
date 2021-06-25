<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    //Get Blog Post (archivio)

    public function index()
    {
        //$posts = Post::all();

        $posts = Post::paginate(3);

        return response()->json($posts);

    }
}
