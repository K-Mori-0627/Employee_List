<?php

/**
 * 管理者画面のサービスインターフェースファイル
 *
 * 管理者画面のサービスインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\Admin;

/**
 * 管理者画面サービスインターフェース
 *
 * 管理者画面のサービスインターフェースを記載
 */
interface HomeServiceInterface
{
    public function index();
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
    public function search($request);
}
