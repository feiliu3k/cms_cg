<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\NewsFormFields;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\ChaoSky;
use App\ChaoPro;
use App\User;
use Auth, Image;

use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchText=null;
        $pros=Auth::user()->ChaoPros;
        $proids=array();
        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }
        $chaoSkies = ChaoSky::where('delflag',0)
                ->wherein('proid',$proids)
                ->orwhere('userid',Auth::user()->id)
                ->orderBy('stime', 'desc')
                ->paginate(config('cms.posts_per_page'));
        return view('admin.news.index',compact('chaoSkies','searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data = $this->dispatch(new NewsFormFields());


       return view('admin.news.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCreateRequest $request)
    {
        //$post = ChaoSky::create($request->postFillData());
        $ChaoSky=New ChaoSky();

        $ChaoSky->tiptitle=$request->tiptitle;
        $ChaoSky->tipimg1=$request->tipimg1;
        $ChaoSky->tipcontent=$request->tipcontent;
        $ChaoSky->tipvideo=$request->tipvideo;
        $ChaoSky->readnum=$request->readnum;
        if($request->commentflag){
            $ChaoSky->commentflag=$request->commentflag;
        }else
        {
            $ChaoSky->commentflag=0;
        }

        if($request->draftflag){
            $ChaoSky->draftflag=$request->draftflag;
        }else
        {
            $ChaoSky->draftflag=0;
        }

        $ChaoSky->stime=new Carbon($request->publish_date.' '.$request->publish_time
        );
        $ChaoSky->proid=$request->proid;
        $ChaoSky->userid=Auth::user()->id;
        //$ChaoSky->post_user=Auth::user()->id;
        $ChaoSky->save();

        return redirect()
                        ->route('admin.news.index')
                        ->withSuccess('新闻添加成功.');

    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tipid)
    {
        $data = $this->dispatch(new NewsFormFields($tipid));

        return view('admin.news.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, $tipid)
    {
        $post = ChaoSky::findOrFail($tipid);
        $post->fill($request->postFillData());
        $post->save();

        $next = ChaoSky::where('tipid', '<', $tipid)->max('tipid');



        if ($request->action === 'continue') {
            // return redirect()
            //                 ->back()
            //                 ->withSuccess('新闻保存成功.');

            return redirect()
                            ->route('admin.news.edit', $next)
                            ->withSuccess('新闻保存成功.');
        }

        return redirect()
                        ->route('admin.news.index')
                        ->withSuccess('新闻保存成功.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = ChaoSky::findOrFail($id);

        $post->delflag=1;
        $post->save();
        return redirect()
                        ->route('admin.news.index')
                        ->withSuccess('新闻删除成功.');
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
        $pros=ChaoPro::where('proname','like', '%'.$request->searchText.'%')->get();
        $users=User::where('name','like', '%'.$request->searchText.'%')->get();

        $ipros=Auth::user()->ChaoPros;
        $iproids=array();
        foreach ($ipros as $ipro) {
            array_push($iproids, $ipro->id);
        }

        $proids=array();
        foreach ($pros as $pro) {
            if (in_array($pro->id, $iproids)){
                array_push($proids, $pro->id);
            }
        }


        $userids=array();
        foreach ($users as $user) {
            array_push($userids, $user->id);
        }

        $chaoSkies = ChaoSky::where('delflag',0)
                            ->where('tiptitle', 'like', '%'.$searchText.'%')
                            ->orwhere('tipcontent', 'like', '%'.$searchText.'%')
                            ->orwherein('proid',$proids)
                            ->orwherein('userid',$userids)
                            ->orderBy('stime', 'desc')
                            ->paginate(config('cms.posts_per_page'));

        return view('admin.news.index',compact('chaoSkies','searchText'));
    }
}
