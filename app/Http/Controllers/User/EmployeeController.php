<?php

/**
 * 社員一覧画面コントローラーのファイル
 *
 * 社員一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\EmployeeServiceInterface;

/**
 * 社員一覧画面コントローラー
 *
 * 社員一覧画面に関連する処理を記載
 */
class EmployeeController extends Controller
{
    private $employeeService;

    /**
     * コンストラクタ
     */
    public function __construct(EmployeeServiceInterface $employeeServiceInterface)
    {
        $this->employeeService = $employeeServiceInterface;
        $this->middleware('auth:user');
    }

    /**
     * 社員一覧画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        list($mixManageDept, $mixSalesDept, $mixEastDept, $mixWestDept) = $this->employeeService->index();

        return view('user/EmployeeList', compact('mixManageDept', 'mixSalesDept', 'mixEastDept', 'mixWestDept'));
    }
}
