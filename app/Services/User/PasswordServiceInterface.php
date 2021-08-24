<?php

/**
 * パスワード変更画面のサービスインターフェースファイル
 *
 * パスワード変更画面のサービスインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\User;

/**
 * パスワード変更画面サービスインターフェース
 *
 * パスワード変更画面のサービスインターフェースを記載
 */
interface PasswordServiceInterface
{
    public function update($request, $id);
}
