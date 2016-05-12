<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jrsx;

class JrsxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jrsxes = Jrsx::where('delflag',0)
                ->orderBy('postdate', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.jrsx.index',compact('jrsxes'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jrsx = ChaoSky::where('id',$id)->where('delflag',0)->first();

        return view('admin.jrsx.jrsx')->withPost($jrsx);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jrsx = Jrsx::findOrFail($id);

        $jrsx->delflag=1;
        $jrsx->save();
        return redirect()
                        ->route('admin.jrsx.index')
                        ->withSuccess('报料信息删除成功.');
    }

        /**
     * Search  the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchText = $request->searchText;
        $jrsxes = Jrsx::where('delflag',0)
                            ->where('username', 'like', '%'.$request->searchText.'%')
                            ->orwhere('dh', 'like', '%'.$request->searchText.'%')
                            ->orwherein('comments','like', '%'.$request->searchText.'%')
                            ->orderBy('postdate', 'desc')
                            ->paginate(config('cms.posts_per_page'));

        return view('admin.jrsx.index',compact('jrsxes','searchText'));
    }
}
