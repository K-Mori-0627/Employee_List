<?php

/**
 * 社員一覧画面のサービスファイル
 *
 * 社員一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\Admin;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\CodeTableRepositoryInterface;

/**
 * 社員一覧画面のサービス
 *
 * 社員一覧画面に関連する処理を記載
 */
class EmployeeService implements EmployeeServiceInterface
{
    private $userRepository;
    private $employeeRepository;
    private $codeTableRepository;

    /**
     * コンストラクタ
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     * @param EmployeeRepositoryInterface $employeeRepositoryInterface
     * @param CodeTableRepositoryInterface $codeTableRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface,
                                EmployeeRepositoryInterface $employeeRepositoryInterface,
                                CodeTableRepositoryInterface $codeTableRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
        $this->employeeRepository = $employeeRepositoryInterface;
        $this->codeTableRepository = $codeTableRepositoryInterface;
    }

    /**
     * 社員設定画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aryRoleData = $this->codeTableRepository->getRoleData();
        $aryDptData = $this->codeTableRepository->getDeptData();
        $mixMembers = $this->employeeRepository->selectEmployeeData();

        return [$aryRoleData, $aryDptData, $mixMembers];
    }

    /**
     * 社員データ登録画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aryRoleData = $this->codeTableRepository->getRoleData();
        $aryDptData = $this->codeTableRepository->getDeptData();

        return [$aryRoleData, $aryDptData];
    }

    /**
     * 社員データ登録関数
     *
     * @param EmployeeRequest $request 登録データ
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $aryParams = $request->all();
        unset($aryParams['_token']);

        if ($this->employeeRepository->createEmployeeData($aryParams)) {
            session()->flash('toastr', config('toastr.save'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }

    /**
     * 社員データ編集画面初期表示
     *
     * @param integer $id 団員ID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aryRoleData = $this->codeTableRepository->getRoleData();
        $aryDptData = $this->codeTableRepository->getDeptData();
        $mixProfile = $this->userRepository->getUserData($id);

        return [$aryRoleData, $aryDptData, $mixProfile];
    }

    /**
     * 社員データ更新関数
     *
     * @param EmployeeRequest $request 更新データ
     * @param integer $id 団員ID
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $aryParams = $request->all();
        unset($aryParams['_token']);

        if ($this->employeeRepository->updateEmployeeData($aryParams, $id)) {
            session()->flash('toastr', config('toastr.update'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }

    /**
     * 団員データ削除関数
     *
     * @param integer $id 削除データ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->employeeRepository->deleteEmployeeData($id)) {
            session()->flash('toastr', config('toastr.delete'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }

    /**
     * 社員検索
     *
     * @param EmployeeRequest $request 検索条件
     * @return \Illuminate\Http\Response
     */
    public function search($request)
    {

    }
}
