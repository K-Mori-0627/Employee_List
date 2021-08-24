<?php

/**
 * お知らせ一覧画面のサービスファイル
 *
 * お知らせ一覧画面に関連する処理を記載
 *
 * @version 1.0
 * @author K-Mori
 */

namespace App\Services\Admin;

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
     * お知らせリスト画面初期表示
     *
     * @return mixed お知らせデータ
     */
    public function index()
    {
        return $this->informationRepository->selectInformationData();
    }

    /**
     * お知らせ登録処理
     *
     * @param InformationRequest $request 登録データ
     * @return mixed お知らせデータ
     */
    public function store($request)
    {
        $aryParams = $request->all();
        unset($aryParams['_token']);

        if ($this->informationRepository->createInformationData($aryParams)) {
            session()->flash('toastr', config('toastr.save'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }

    /**
     * お知らせ更新画面表示
     *
     * @param integer $id お知らせID
     * @return mixed お知らせデータ
     */
    public function edit($id)
    {
        return $this->informationRepository->selectInformationDataFromID($id);
    }

    /**
     * お知らせ更新処理
     *
     * @param InformationRequest $request 登録データ
     * @param integer $id お知らせID
     */
    public function update($request, $id)
    {
        $aryParams = $request->all();
        unset($aryParams['_token']);

        if ($this->informationRepository->updateInformationData($aryParams, $id)) {
            session()->flash('toastr', config('toastr.update'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }

    /**
     * お知らせ削除処理
     *
     * @param integer $id 削除データ
     */
    public function destroy($id)
    {
        if ($this->informationRepository->deleteInformationData($id)) {
            session()->flash('toastr', config('toastr.delete'));
        } else {
            session()->flash('toastr', config('toastr.error'));
        }
    }

    /**
     * お知らせ検索
     *
     * @param InformationRequest $request 検索条件
     * @return \Illuminate\Http\Response
     */
    public function search($request)
    {

    }
}
