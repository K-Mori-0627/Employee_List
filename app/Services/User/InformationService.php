<?php

/**
 * お知らせ一覧画面のサービスファイル
 *
 * お知らせ一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\User;

use App\Repositories\InformationRepositoryInterface;

/**
 * お知らせ一覧画面のサービス
 *
 * お知らせ一覧画面に関連する処理を記載
 */
class InformationService implements InformationServiceInterface
{
    private $informationRepository;

    /**
     * コンストラクタ
     *
     * @param InformationRepositoryInterface $informationRepositoryInterface
     */
    public function __construct(InformationRepositoryInterface $informationRepositoryInterface)
    {
        $this->informationRepository = $informationRepositoryInterface;
    }

    /**
     * お知らせ一覧画面初期表示
     *
     * @return mixed お知らせデータ
     */
    public function index()
    {
        // お知らせ取得
        return $this->informationRepository->getAllInformationData();
    }
}
