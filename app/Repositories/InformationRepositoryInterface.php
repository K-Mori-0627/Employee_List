<?php

/**
 * Informationテーブルのリポジトリーインターフェースファイル
 *
 * Informationリポジトリーのインターフェースを記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Repositories;

/**
 * Informationテーブルリポジトリーインターフェース
 *
 * Informationリポジトリーのインターフェースを記載
 */
interface InformationRepositoryInterface
{
    public function getAllInformationData();
    public function selectInformationData();
    public function selectInformationDataFromID($id);
    public function selectInformationDataTake5();
    public function createInformationData($request);
    public function updateInformationData($request, $id);
    public function deleteInformationData($id);
    public function searchInformationData($request);
}
