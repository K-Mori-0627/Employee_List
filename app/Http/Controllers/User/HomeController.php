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

use App\Models\User;
use App\Models\Information;
use App\Http\Controllers\Controller;

/**
 * ホーム画面コントローラー
 *
 * ホーム画面に関連する処理を記載
 */
class HomeController extends Controller
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * ホーム画面初期表示
     *
     * @return 表示するblade
     */
    public function index()
    {
        // お知らせ取得
        $mixInfo = Information::orderby('created_at', 'desc')->take(5)->get();

        // 団員データ取得
        $mixMemberCnt = User::count();

        return view('user.home', compact('mixInfo', 'mixMemberCnt'));
    }
}
