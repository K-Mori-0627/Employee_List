<?php

/**
 * お知らせ一覧画面のサービスインターフェースファイル
 *
 * お知らせ一覧画面のサービスインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\Admin;

/**
 * お知らせ一覧画面サービスインターフェース
 *
 * お知らせ一覧画面のサービスインターフェースを記載
 */
interface InformationServiceInterface
{
    public function index();
    public function store($request);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
    public function search($request);
}
