<?php

/**
 * 社員一覧画面のサービスインターフェースファイル
 *
 * 社員一覧画面のサービスインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\Admin;

/**
 * 社員一覧画面サービスインターフェース
 *
 * 社員一覧画面のサービスインターフェースを記載
 */
interface EmployeeServiceInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
    public function search($request);
}
