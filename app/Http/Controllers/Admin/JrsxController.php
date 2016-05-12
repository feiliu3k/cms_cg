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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

        /**
     * Search  the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $pros=ChaoPro::where('proname','like', '%'.$request->searchText.'%')->get();
        $users=User::where('name','like', '%'.$request->searchText.'%')->get();

        $proids=array();
        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }

        $userids=array();
        foreach ($users as $user) {
            array_push($userids, $user->id);
        }

        $chaoSkies = ChaoSky::where('delflag',0)
                            ->where('tiptitle', 'like', '%'.$request->searchText.'%')
                            ->orwhere('tipcontent', 'like', '%'.$request->searchText.'%')
                            ->orwherein('proid',$proids)
                            ->orwherein('userid',$userids)
                            ->orderBy('stime', 'desc')
                            ->paginate(config('cms.posts_per_page'));

        return view('admin.news.index',compact('chaoSkies'));
    }
}
