<?php

/**
 * Adminテーブルのリポジトリーインターフェースファイル
 *
 * Adminリポジトリーのインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

/**
 * Adminテーブルリポジトリーインターフェース
 *
 * Adminリポジトリーのインターフェースを記載
 */
interface AdminRepositoryInterface
{
    public function selectAdminData();
    public function selectAdminDataFromID($id);
    public function createAdminData($request);
    public function updateAdminData($request, $id);
    public function deleteAdminData($id);
    public function searchAdminData($request);
}
