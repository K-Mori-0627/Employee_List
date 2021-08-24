<?php

/**
 * Employeeテーブルのリポジトリーインターフェースファイル
 *
 * Employeeリポジトリーのインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

/**
 * Employeeテーブルリポジトリーインターフェース
 *
 * Employeeリポジトリーのインターフェースを記載
 */
interface EmployeeRepositoryInterface
{
    public function selectEmployeeData();
    public function createEmployeeData($request);
    public function updateEmployeeData($request, $id);
    public function deleteEmployeeData($id);
    public function searchEmployeeData($request);
}
