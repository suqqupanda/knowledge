<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;
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

    /**
     * 投稿の詳細を表示
     *
     * @param integer $postId
     * @return View|Redirectresponse
     */
    public function detailPost(int $postId): View|Redirectresponse
    {
        $post = $this->postService->getPostById($postId);

        // 投稿が存在しない場合
        if (is_null($post))
        {
            return redirect(route('post.index'))->with('error', 'Post not found');
        }

        return view('post.detail', compact('post'));
    }

    public function showUpdatePost(int $postId)
    {
        $post = $this->postService->getPostById($postId);

        return view('post.update', compact('post'));
    }

    public function updatePost(PostRequest $request, int $postId)
    {
        // リクエストから必要な情報を抽出して配列に
        $postData = $request->only(['title', 'post']);

        // 投稿の持ち主のユーザーidとログインしているユーザーのidを比較
        if (Auth::id() !== $this->postService->getPostById($postId)->user_id)
        {
            return redirect(route('post.index'));
        }

        $this->postService->updatePost($postData, $postId);

        $post = $this->postService->getPostById($postId);

        return view('post.detail', compact('post'));
    }
}
