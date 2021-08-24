<?php

/**
 * ホーム画面コントローラーのファイル
 *
 * ホーム画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\HomeServiceInterface;

/**
 * ホーム画面コントローラー
 *
 * ホーム画面に関連する処理を記載
 */
class HomeController extends Controller
{
    private $homeService;

    /**
     * コンストラクタ
     */
    public function __construct(HomeServiceInterface $homeServiceInterface)
    {
        $this->homeService = $homeServiceInterface;
        $this->middleware('auth:user');
    }

    /**
     * ホーム画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        list($mixInfo, $mixMemberCnt) = $this->homeService->index();

        return view('user.home', compact('mixInfo', 'mixMemberCnt'));
    }
}
