<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Repositories\Interfaces\postsInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EditorController extends Controller
{
    protected $postRepo;

    public function __construct(postsInterface $postRepository)
    {
        $this->postRepo = $postRepository;
    }
    public function editorDashboard(){
        return view('editor.dashboard');
    }

    public function createPostForm(){
        return view('editor.create-post');
    }

    public function createPost(StorePostRequest $request){
        // dd('here', $request->all());
        Log::info('EditorController');
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $post = $this->postRepo->createPost($data);
       return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }
}
