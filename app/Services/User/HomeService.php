<?php

/**
 * ホーム画面のサービスファイル
 *
 * ホーム画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\User;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\InformationRepositoryInterface;

/**
 * ホーム画面のサービス
 *
 * ホーム画面に関連する処理を記載
 */
class HomeService implements HomeServiceInterface
{
    private $userRepository;
    private $informationRepository;

    /**
     * コンストラクタ
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     * @param InformationRepositoryInterface $informationRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface,
                                InformationRepositoryInterface $informationRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
        $this->informationRepository = $informationRepositoryInterface;
    }

    /**
     * ホーム画面初期表示
     *
     */
    public function index()
    {
        // お知らせ取得
        $mixInfo = $this->informationRepository->selectInformationDataTake5();

        // 団員データ取得
        $mixMemberCnt = $this->userRepository->countUser();

        return [$mixInfo, $mixMemberCnt];
    }
}
