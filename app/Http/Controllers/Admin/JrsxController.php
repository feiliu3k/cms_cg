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
        $searchText=null;
        $jrsxes = Jrsx::where('delflag',0)
                ->orderBy('postdate', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.jrsx.index',compact('jrsxes','searchText'));
    }

    public function fav()    {

        $jrsxes = Jrsx::where('delflag',0)
                ->orderBy('postdate', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.jrsx.fav',compact('jrsxes'));
    }

    public function addFav(Request $request,$jrsxid,$userid)
    {

    }

    public function remark()
    {
        $jrsxes = Jrsx::where('delflag',0)
                ->orderBy('postdate', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.jrsx.remark',compact('jrsxes'));
    }

    public function addRemark()
    {
        $jrsxes = Jrsx::where('delflag',0)
                ->orderBy('postdate', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.jrsx.remark',compact('jrsxes'));
    }

    public function UpdateRemark()
    {
        $jrsxes = Jrsx::where('delflag',0)
                ->orderBy('postdate', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.jrsx.remark',compact('jrsxes'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jrsx = Jrsx::where('id',$id)->where('delflag',0)->first();
        return view('admin.jrsx.jrsx')->withJrsx($jrsx);
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
                            ->where('username', 'like', '%'.$searchText.'%')
                            ->orwhere('dh', 'like', '%'.$searchText.'%')
                            ->orwhere('comments','like', '%'.$searchText.'%')
                            ->orderBy('postdate', 'desc')
                            ->paginate(config('cms.posts_per_page'));

        return view('admin.jrsx.index',compact('jrsxes','searchText'));
    }
}
