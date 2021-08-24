<?php

/**
 * 管理者画面コントローラーのファイル
 *
 * 管理者画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeRequest;
use App\Services\Admin\HomeServiceInterface;

/**
 * 管理者画面コントローラー
 *
 * 管理者画面に関連する処理を記載
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
        $this->middleware('auth:admin');
    }

    /**
     * 管理者画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mixAdmins = $this->homeService->index();

        return view('admin/home', compact('mixAdmins'));
    }

    /**
     * 管理者更新画面表示
     *
     * @param integer $id 管理者ID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mixAdmin = $this->homeService->edit($id);

        return view('admin/AdminEdit', compact('mixAdmin'));
    }

    /**
     * 管理者更新処理
     *
     * @param HomeRequest $_request 登録データ
     * @param integer $id 管理者ID
     * @return \Illuminate\Http\Response
     */
    public function update(HomeRequest $request, $id)
    {
        $this->homeService->update($request, $id);

        return redirect()->route('admin.home.index');
    }

    /**
     * 管理者削除処理
     *
     * @param integer $id 削除データ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->homeService->destroy($id);

        return redirect()->route('admin.home.index');
    }

    /**
     * 管理者検索
     *
     * @param HomeRequest $request 検索条件
     * @return \Illuminate\Http\Response
     */
    public function search(HomeRequest $request)
    {
        $this->homeService->search($request);

        return redirect()->route('admin.home.index');
    }
}
