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
     * @param int $postId
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

    /**
     * 投稿編集画面を表示
     *
     * @param int $postId
     * @return View|RedirectResponse
     */
    public function showUpdatePost(int $postId): View|RedirectResponse
    {
        $post = $this->postService->getPostById($postId);

        // 投稿が存在しない場合はリダイレクト
        if (is_null($post)) {
            return redirect()->route('post.index')->with('error', '投稿が見つかりません。');
        }

        return view('post.update', compact('post'));
    }

    /**
     * 編集された投稿の情報を更新
     *
     * @param PostRequest $request
     * @param int $postId
     * @return View|RedirectResponse
     */
    public function updatePost(PostRequest $request, int $postId): View|RedirectResponse
    {
        // 最初に投稿を取得
        $post = $this->postService->getPostById($postId);
    
        // 投稿が存在しない場合はリダイレクト
        if (is_null($post)) {
            return redirect()->route('post.index')->with('error', '投稿が見つかりません。');
        }
    
        // 投稿の持ち主がログインユーザーでなければリダイレクト
        if (Auth::id() !== $post->user_id) {
            return redirect(route('post.index'))->with('error', 'この操作は許可されていません。');
        }
    
        // リクエストからデータを取得して更新
        $postData = $request->only(['title', 'post']);
        $this->postService->updatePost($postData, $postId);
    
        // 更新された投稿を取得してビューに渡す
        return view('post.detail', compact('post'));
    }
    
    /**
     * 投稿を削除
     *
     * @param int $postId
     * @return RedirectResponse
     */
    public function deletePost(int $postId): RedirectResponse
    {
        $post = $this->postService->getPostById($postId);

        // 投稿が存在しない場合
        if (is_null($post))
        {
            return redirect()->route('post.index')->with('error', 'Post not found');
        }

        // 投稿がログインしているユーザーのものではない場合
        if (Auth::id() !== $post->user_id)
        {
            return redirect()->route('post.index')->with('error', 'You cannot delete post from others');
        }

        $this->postService->deletePost($postId);

        return redirect(route('post.index'));
    }
}
