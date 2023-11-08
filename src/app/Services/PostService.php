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
     * @param integer $postId
     * @return Post|null
     */
    public function getPostById(int $postId): Post|null
    {
        return $this->post->getPostById($postId);
    }
}
