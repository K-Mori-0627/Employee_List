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

use App\Models\Information;
use App\Http\Controllers\Controller;

/**
 * お知らせ一覧画面コントローラー
 *
 * お知らせ一覧画面に関連する処理を記載
 */
class InformationController extends Controller
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * お知らせ一覧画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // お知らせ取得
        $mixInfo = Information::orderby('created_at', 'desc')->get();

        return view('user.information', compact('mixInfo'));
    }
}
