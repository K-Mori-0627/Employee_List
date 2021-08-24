<?php

/**
 * プロフィール画面コントローラーのファイル
 *
 * プロフィール画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileRequest;
use App\Services\User\ProfileServiceInterface;

/**
 * プロフィール画面コントローラー
 *
 * プロフィール画面に関連する処理を記載
 */
class ProfileController extends Controller
{
    private $profileService;

    /**
     * コンストラクタ
     */
    public function __construct(ProfileServiceInterface $profileServiceInterface)
    {
        $this->profileService = $profileServiceInterface;
        $this->middleware('auth:user');
    }

    /**
     * プロフィール画面初期表示
     *
     * @param Integer $id ユーザーID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mixProfile = $this->profileService->show($id);

        return view('user/Profile', compact('mixProfile'));
    }

    /**
     * プロフィール編集画面初期表示
     *
     * @param Integer $id ユーザーID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        list($mixProfile, $aryRoleData) = $this->profileService->edit($id);

        return view('user/ProfileEdit', compact('mixProfile', 'aryRoleData'));
    }

    /**
     * プロフィール編集処理
     *
     * @param Integer $id ユーザーID
     * @param ProfileRequest $request 登録データ
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $this->profileService->update($request, $id);

        return redirect()->route('user.profile.show', $id);
    }
}
