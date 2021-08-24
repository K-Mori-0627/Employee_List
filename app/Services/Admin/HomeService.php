<?php

/**
 * 管理者画面のサービスファイル
 *
 * 管理者画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\Admin;

use App\Repositories\AdminRepositoryInterface;

/**
 * 管理者画面のサービス
 *
 * 管理者画面に関連する処理を記載
 */
class HomeService implements HomeServiceInterface
{
    private $adminRepository;

    /**
     * コンストラクタ
     *
     * @param AdminRepositoryInterface $adminRepositoryInterface
     */
    public function __construct(AdminRepositoryInterface $adminRepositoryInterface)
    {
        $this->adminRepository = $adminRepositoryInterface;
    }

    /**
     * 管理者画面初期表示
     *
     * @return 表示するblade
     */
    public function index()
    {
        return $this->adminRepository->selectAdminData();
    }

    /**
     * 管理者更新画面表示
     *
     * @param integer $id 管理者ID
     * @return 表示するblade
     */
    public function edit($id)
    {
        return $this->adminRepository->selectAdminDataFromID($id);
    }

    /**
     * 管理者更新処理
     *
     * @param HomeRequest $_request 登録データ
     * @param integer $id 管理者ID
     */
    public function update($request, $id)
    {
        $aryParams = $request->all();
        unset($aryParams['_token']);

        if ($this->adminRepository->updateAdminData($aryParams, $id)) {
            session()->flash('toastr', config('toastr.update'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }

    /**
     * 管理者削除処理
     *
     * @param integer $id 削除データ
     */
    public function destroy($id)
    {
        if ($this->adminRepository->deleteAdminData($id)) {
            session()->flash('toastr', config('toastr.delete'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }

    /**
     * 管理者検索
     *
     * @param HomeRequest $request 検索条件
     * @return \Illuminate\Http\Response
     */
    public function search($request)
    {

    }
}
