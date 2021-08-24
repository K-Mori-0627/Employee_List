<?php

/**
 * CodeTableテーブルのリポジトリーインターフェースファイル
 *
 * CodeTableリポジトリーのインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

/**
 * CodeTableテーブルリポジトリーインターフェース
 *
 * CodeTableリポジトリーのインターフェースを記載
 */
interface CodeTableRepositoryInterface
{
    public function getRoleData();
    public function getDeptData();
}
