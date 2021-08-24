<?php

/**
 * お知らせ一覧画面コントローラーのファイル
 *
 * お知らせ一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\InformationServiceInterface;

/**
 * お知らせ一覧画面コントローラー
 *
 * お知らせ一覧画面に関連する処理を記載
 */
class InformationController extends Controller
{
    private $informationService;

    /**
     * コンストラクタ
     */
    public function __construct(InformationServiceInterface $informationServiceInterface)
    {
        $this->informationService = $informationServiceInterface;
        $this->middleware('auth:user');
    }

    /**
     * お知らせ一覧画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mixInfo = $this->informationService->index();

        return view('user.information', compact('mixInfo'));
    }
}
