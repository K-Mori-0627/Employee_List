<?php

/**
 * Userテーブルのリポジトリーインターフェースファイル
 *
 * Userリポジトリーのインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

/**
 * Userテーブルリポジトリーインターフェース
 *
 * Userリポジトリーのインターフェースを記載
 */
interface UserRepositoryInterface
{
    public function countUser();
    public function getEmployeeList();
    public function getUserData($id);
    public function selectProfileData($id);
    public function selectProfileDataFromID($id);
    public function updateProfileData($request, $id);
    public function updatePassword($request, $id);
}
