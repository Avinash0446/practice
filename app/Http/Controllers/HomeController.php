<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id',auth()->id())->get();
        return view('home', compact('posts'));
    }
}
