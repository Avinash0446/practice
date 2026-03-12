<?php

namespace App\Repositories;
use App\Models\Post;
use App\Repositories\Interfaces\postsInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsRepository implements postsInterface
{

    public function __construct()
    {
        //
    }

    public function getAllPosts($id)
    {
        return Post::where('user_id', $id)->all();
    }
    public function viewPost($userId)
    {
        return Post::where('user_id', $userId)->get();
    }

    public function createPost($data)
    {
        Log::info('post_repository');
        $imagePath = null;

        if (isset($data['post_image'])) {

            $randomString = Str::random(6);
            $file = $data['post_image'];

            $filename = $randomString . '_' . time() . '.' . $file->getClientOriginalExtension();

            $imagePath = $file->storeAs('posts', $filename, 'public');
        }
        return Post::create(
            [
                'user_id' => $data['user_id'],
                'caption' => $data['title'],
                'post_images' => $filename ?? null
            ]
        );
    }
    public function editPost($user_id, $data)
    {
        $post = Post::find(($user_id));
        $post->update($data);
        return $post;
    }
    public function deletePost($id)
    {
        return Post::destroy($id);
    }

}
