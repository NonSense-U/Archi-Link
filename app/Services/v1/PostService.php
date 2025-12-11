<?php

namespace App\Services\v1;

use App\Models\Post;

class PostService
{
    public function createPost(array $payload, int $userId)
    {
        try {
            $payload['user_id'] = $userId;
            return Post::create($payload);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updatePost(Post $post, array $payload, int $userId)
    {
        try {
            //! Update exception later
            if (!$post || $post->user_id !== $userId) {
                throw new \Exception('Post not found or you do not have permission to update this post.');
            }
            $post->update($payload);
            return $post;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function deletePost(Post $post, int $userId)
    {
        try {
            //! Update exception later
            if (!$post || $post->user_id !== $userId) {
                throw new \Exception('Post not found or you do not have permission to delete this post.');
            }
            $post->delete();
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
