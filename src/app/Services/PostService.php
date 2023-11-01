<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    /**
     * The post instance.
     *
     * @var Post
     */
    protected $post;

    /**
     * インスタンスを生成
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
    public function create(array $data)
    {
        $this->post->store($data);
    }
}
