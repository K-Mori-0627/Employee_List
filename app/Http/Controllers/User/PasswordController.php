<?php

/**
 * パスワード変更画面コントローラーのファイル
 *
 * パスワード変更画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordRequest;
use App\Services\User\PasswordServiceInterface;

/**
 * パスワード変更画面コントローラー
 *
 * パスワード変更画面に関連する処理を記載
 */
class PasswordController extends Controller
{
    private $passwordService;

    /**
     * コンストラクタ
     */
    public function __construct(PasswordServiceInterface $passwordServiceInterface)
    {
        $this->passwordService = $passwordServiceInterface;
        $this->middleware('auth:user');
    }

    /**
     * パスワード変更画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user/Password');
    }

    /**
     * パスワード更新処理
     *
     * @param PasswordRequest $request 登録データ
     * @param Integer $id ユーザーID
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordRequest $request, $id)
    {
        $this->passwordService->update($request, $id);

        return redirect()->route('user.profile.show', $id);
    }
}
