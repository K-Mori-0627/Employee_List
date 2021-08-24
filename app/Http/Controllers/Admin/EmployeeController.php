<?php

/**
 * 社員一覧画面コントローラーのファイル
 *
 * 社員一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Services\Admin\EmployeeServiceInterface;

/**
 * 社員一覧画面コントローラー
 *
 * 社員一覧画面に関連する処理を記載
 */
class EmployeeController extends Controller
{
    private $employeService;

    /**
     * コンストラクタ
     */
    public function __construct(EmployeeServiceInterface $employeServiceInterface)
    {
        $this->employeService = $employeServiceInterface;
        $this->middleware('auth:admin');
    }

    /**
     * 社員設定画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        list($aryRoleData, $aryDptData, $mixMembers) = $this->employeService->index();

        return view('admin/EmployeeSetting', compact('aryRoleData', 'aryDptData', 'mixMembers'));
    }

    /**
     * 社員データ登録画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        list($aryRoleData, $aryDptData) = $this->employeService->create();

        return view('admin/EmployeeRegister', compact('aryRoleData', 'aryDptData'));
    }

    /**
     * 社員データ登録関数
     *
     * @param EmployeeRequest $request 登録データ
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $this->employeService->store($request);

        return redirect()->route('admin.employee.index');
    }

    /**
     * 社員データ編集画面初期表示
     *
     * @param integer $id 団員ID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        list($aryRoleData, $aryDptData, $mixProfile) = $this->employeService->edit($id);

        return view('admin/EmployeeEdit', compact('aryRoleData', 'aryDptData', 'mixProfile'));
    }

    /**
     * 社員データ更新関数
     *
     * @param EmployeeRequest $request 更新データ
     * @param integer $id 団員ID
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $this->employeService->update($request, $id);

        return redirect()->route('admin.employee.index');
    }

    /**
     * 団員データ削除関数
     *
     * @param integer $id 削除データ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->employeService->destroy($id);

        return redirect()->route('admin.employee.index');
    }

    /**
     * 社員検索
     *
     * @param EmployeeRequest $request 検索条件
     * @return \Illuminate\Http\Response
     */
    public function search(EmployeeRequest $request)
    {
        $this->employeService->search($request);

        return redirect()->route('admin.employee.index');
    }
}
