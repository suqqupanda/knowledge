<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
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
     * 投稿を登録
     *
     * @param Postrequest $request
     * @return RedirectResponse
     */
    public function createPost(Postrequest $request): RedirectResponse
    {
        $post = new Post();

        $data = [
            'title' => $request->title,
            'post' => $request->post
        ];

        // タイトルと投稿の登録
        $post->store($data);

        // 後にポスト一覧に切り替える
        return redirect(route('home'));
    }   
}
