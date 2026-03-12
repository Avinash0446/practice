<?php

namespace App\Repositories\Interfaces;
use illuminate\Support\Facades\Log;
Log::info('postInterface');
interface postsInterface
{
    public function getAllPosts($id);
    public function createPost($data);
    public function editPost($id, $data);
    public function deletePost($id);
    public function viewPost($id);
}
