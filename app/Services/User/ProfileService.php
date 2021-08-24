<?php

/**
 * プロフィール画面のサービスファイル
 *
 * プロフィール画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\User;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\CodeTableRepositoryInterface;

/**
 * プロフィール画面のサービス
 *
 * プロフィール画面に関連する処理を記載
 */
class ProfileService implements ProfileServiceInterface
{
    private $userRepository;
    private $codeTableRepository;

    /**
     * コンストラクタ
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     * @param CodeTableRepositoryInterface $codeTableRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface,
                                CodeTableRepositoryInterface $codeTableRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
        $this->codeTableRepository = $codeTableRepositoryInterface;
    }

    /**
     * プロフィール画面初期表示
     *
     * @param Integer $id ユーザーID
     * @return Arrey
     */
    public function show($id)
    {
        return $this->userRepository->selectProfileData($id);
    }

    /**
     * プロフィール編集画面初期表示
     *
     * @param Integer $id ユーザーID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mixProfile = $this->userRepository->selectProfileDataFromID($id);
        $aryRoleData = $this->codeTableRepository->getRoleData();

        return [$mixProfile, $aryRoleData];
    }

    /**
     * プロフィール編集処理
     *
     * @param Integer $id ユーザーID
     * @param ProfileRequest $request 登録データ
     */
    public function update($request, $id)
    {
        $aryParams = $request->all();
        unset($aryParams['_token']);

        if ($this->userRepository->updateProfileData($aryParams, $id)) {
            session()->flash('toastr', config('toastr.update'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }
}
