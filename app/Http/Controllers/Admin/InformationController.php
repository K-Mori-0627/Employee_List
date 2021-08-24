<?php

/**
 * お知らせ一覧画面コントローラーのファイル
 *
 * お知らせ一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InformationRequest;
use App\Services\Admin\InformationServiceInterface;

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
        $this->middleware('auth:admin');
    }

    /**
     * お知らせリスト画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mixInfo = $this->informationService->index();

        return view('admin/InformationSetting', compact('mixInfo'));
    }

    /**
     * お知らせ登録画面表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/InformationRegister');
    }

    /**
     * お知らせ登録処理
     *
     * @param InformationRequest $request 登録データ
     * @return \Illuminate\Http\Response
     */
    public function store(InformationRequest $request)
    {
        $this->informationService->store($request);

        return redirect()->route('admin.information.index');
    }

    /**
     * お知らせ更新画面表示
     *
     * @param integer $id お知らせID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mixInfo = $this->informationService->edit($id);

        return view('admin/InformationEdit', compact('mixInfo'));
    }

    /**
     * お知らせ更新処理
     *
     * @param InformationRequest $request 登録データ
     * @param integer $id お知らせID
     * @return \Illuminate\Http\Response
     */
    public function update(InformationRequest $request, $id)
    {
        $this->informationService->update($request, $id);

        return redirect()->route('admin.information.index');
    }

    /**
     * お知らせ削除処理
     *
     * @param integer $id 削除データ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->informationService->destroy($id);

        return redirect()->route('admin.information.index');
    }

    /**
     * お知らせ検索
     *
     * @param InformationRequest $request 検索条件
     * @return \Illuminate\Http\Response
     */
    public function search(InformationRequest $request)
    {
        $this->informationService->search($request);

        return redirect()->route('admin.information.index');
    }
}
