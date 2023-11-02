<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    /**
     * The post service instance.
     *
     * @var PostService
     */
    protected $postService;

    /**
     * 投稿画面を表示
     *
     * @return View
     */
    public function showPost(): View
    {
        return view('post.post');
    }

    /**
     * コンストラクタ
     *
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * 投稿を登録
     *
     * @param Postrequest $request
     * @return RedirectResponse
     */
    public function createPost(Postrequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->title,
            'post' => $request->post
        ];
        // $date = $request->only(['title', 'post']);

        // タイトルと投稿の登録
        $this->postService->create($data);

        return redirect(route('post.index'));
    }

    /**
     * 投稿一覧の表示
     *
     * @return view
     */
    public function indexPost(): View
    {
        // 投稿一覧を取得して表示
        $posts = $this->postService->getAllPosts();

        return view('post.index', compact('posts'));
    }
}
