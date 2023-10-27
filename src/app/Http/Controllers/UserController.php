<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * ユーザー新規登録画面を表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * 必須の新規ユーザー情報を登録
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $userModel = new User();

        // 登録情報をデータベースに保存
        $user = $userModel->register(
            $request->name,
            $request->email,
            $request->password,
            $request->icon->store('public/profileIcons')
        );

        // 新規登録後そのままログインさせる
        event(new Registered($user));
        Auth::login($user);

        // 後に投稿一覧ページにリダイレクトさせる
        return redirect(route('home'));
    }
    
}
