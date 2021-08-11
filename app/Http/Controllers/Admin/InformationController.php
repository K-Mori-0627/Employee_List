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

use App\Models\Information;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $this->middleware('auth:admin');
    }

    /**
     * お知らせリスト画面初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mixInfo = Information::select()->sortable()->paginate(10);

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
     * @param Request $request 登録データ
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'max:255'],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            Information::create([
                'subject' => $aryParams['subject'],
            ]);
            DB::commit();
            session()->flash('msg_success', '登録が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '登録に失敗しました。');
        }

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
        $mixInfo = Information::find($id);

        return view('admin/InformationEdit', compact('mixInfo'));
    }

    /**
     * お知らせ更新処理
     *
     * @param Request $_request 登録データ
     * @param integer $id お知らせID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => ['required', 'max:255'],
        ]);

        $aryParams = $request->all();
        unset($aryParams['_token']);

        // DBトランザクション開始
        DB::beginTransaction();

        try {
            $mixArticle = Information::find($id);
            $mixArticle->fill($aryParams)->save();
            DB::commit();
            session()->flash('msg_success', '登録が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '登録に失敗しました。');
        }

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
        // DBトランザクション開始
        DB::beginTransaction();

        try {
            Information::where('id', $id)->delete();
            DB::commit();
            session()->flash('msg_success', '削除が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('msg_error', '削除に失敗しました。');
        }

        return redirect()->route('admin.information.index');
    }
}
