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
    public function displayRegisterPage(): View
    {
        return view('auth.register');
    }

    /**
     * 必須の新規ユーザー情報を登録
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function userCreate(RegisterRequest $request): RedirectResponse
    {
        $userModel = new User();

        $iconPath = config('const.NOICON_PATH');

        if ($request->hasFile('icon'))
        {
            $iconPath = $request->icon->store(config('const.ICON_PATH'));
        }

        // 登録情報を配列にまとめる
        $registrationData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'icon' => $iconPath,
        ];

        // 登録情報をデータベースに保存
        $user = $userModel->register($registrationData);

        // 新規登録後そのままログインさせる
        event(new Registered($user));
        Auth::login($user);

        // 後に投稿一覧ページにリダイレクトさせる
        return redirect(route('home'));
    }
}
