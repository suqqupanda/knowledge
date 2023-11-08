<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    /**
     * The post instance.
     *
     * @var Post
     */
    protected $post;

    /**
     * コンストラクタ
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * モデルのデータを保存するメソッドの呼び出し
     *
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        $this->post->store($data);
    }

    /**
     * モデルの全投稿を取得するメソッドの呼び出し
     *
     * @return LengthAwarePaginator
     */
    public function getAllPosts(): LengthAwarePaginator
    {
        return $this->post->getAllPosts();
    }

    /**
     * モデルの特定の投稿を取得するメソッドの呼び出し
     *
     * @param int $postId
     * @return Post|null
     */
    public function getPostById(int $postId): Post|null
    {
        return $this->post->getPostById($postId);
    }

    /**
     * モデルの編集された投稿の情報を更新するメソッドの呼び出し
     *
     * @param array $postData
     * @param int $postId
     * @return void
     */
    public function updatePost(array $postData, int $postId): void
    {
        $this->post->updatePost($postData, $postId);
    }

    /**
     * モデルの投稿を削除するメソッドの呼び出し
     *
     * @param int $postId
     * @return void
     */
    public function deletePost(int $postId): void
    {
        $this->post->deletePost($postId);
    }
}
