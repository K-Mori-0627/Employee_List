<?php

/**
 * 社員一覧画面のサービスファイル
 *
 * 社員一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\User;

use App\Repositories\UserRepositoryInterface;

/**
 * 社員一覧画面のサービス
 *
 * 社員一覧画面に関連する処理を記載
 */
class EmployeeService implements EmployeeServiceInterface
{
    private $userRepository;

    /**
     * コンストラクタ
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    /**
     * 社員一覧画面初期表示
     *
     * @return miexd 社員リスト
     */
    public function index()
    {
        return $this->userRepository->getEmployeeList();
    }
}
