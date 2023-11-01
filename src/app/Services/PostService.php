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
     * モデルの全データを取得するメソッドの呼び出し
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return $this->post->getAllPosts();
    }
}
