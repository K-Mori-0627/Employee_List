<?php

/**
 * パスワード変更画面のサービスファイル
 *
 * パスワード変更画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\User;

use App\Repositories\UserRepositoryInterface;

/**
 * パスワード変更画面のサービス
 *
 * パスワード変更画面に関連する処理を記載
 */
class PasswordService implements PasswordServiceInterface
{
    private $userRepository;

    /**
     * コンストラクタ
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    /**
     * パスワード更新処理
     *
     * @param Arrey $request 登録データ
     * @param Integer $id ユーザーID
     */
    public function update($request, $id)
    {
        $aryParams = $request->all();
        unset($aryParams['_token']);

        if ($this->userRepository->updatePassword($aryParams, $id)) {
            session()->flash('toastr', config('toastr.update'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }
}
