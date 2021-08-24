<?php

/**
 * プロフィール画面のサービスインターフェースファイル
 *
 * プロフィール画面のサービスインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\User;

/**
 * プロフィール画面サービスインターフェース
 *
 * プロフィール画面のサービスインターフェースを記載
 */
interface ProfileServiceInterface
{
    public function show($id);
    public function edit($id);
    public function update($request, $id);
}
