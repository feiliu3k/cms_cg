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
use App\VoteItem;

use Auth, Image, DB;

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
    public function store(Request $request)
    {
        //$post = ChaoSky::create($request->postFillData());
        // dd($request);
        // exit;
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

        if ($request->voteflag){
            $ChaoSky->voteflag=1;
            $ChaoSky->votenum=$request->votenum;
            $ChaoSky->vbtime=new Carbon($request->vote_begin_date.' '.$request->vote_begin_time
            );
            $ChaoSky->vetime=new Carbon($request->vote_end_date.' '.$request->vote_end_time

            );
        }else{
            $ChaoSky->voteflag=0;
            $ChaoSky->votenum=$request->votenum;
            $ChaoSky->vbtime=new Carbon($request->vote_begin_date.' '.$request->vote_begin_time
        );
            $ChaoSky->vetime=new Carbon($request->vote_end_date.' '.$request->vote_end_time

        );
        }

        $ChaoSky->stime=new Carbon($request->publish_date.' '.$request->publish_time
        );
        $ChaoSky->proid=$request->proid;
        $ChaoSky->userid=Auth::user()->id;
        //$ChaoSky->post_user=Auth::user()->id;
        $ChaoSky->save();
        // todo 存储投票选项列表
        if ($request->voteflag){
            $i=0;
            foreach ($request->vote_items as $vi) {
                if (trim($vi)!=""){
                    $voteItem = new VoteItem(['itemcontent' => $vi]);
                    $voteItem->votecount=$request->votecounts[$i];
                    $ChaoSky->voteItems()->save($voteItem);
                }
                $i++;
            }
        }

        return redirect()
                        ->route('admin.news.index')
                        ->withSuccess('文章添加成功.');
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
        if ($request->voteflag){
            $post->voteItems()->delete($post->voteItems);
            $post->voteflag=1;
            $i=0;
            if ($request->vote_items){
                foreach ($request->vote_items as $vi) {
                    if (trim($vi)!=""){
                        $voteItem = new VoteItem(['itemcontent' => $vi]);
                        $voteItem->votecount=$request->votecounts[$i];
                        $voteItem->id=$request->voteitemids[$i];
                        $post->voteItems()->save($voteItem);
                    }
                    $i++;
                }
            }else{
               $post->voteItems()->delete($post->voteItems);
               $post->voteflag=0;
               $post->votenum=1;
            }
        }
        else{
            $post->voteItems()->delete($post->voteItems);
            $post->voteflag=0;
            $post->votenum=1;
        }

        $post->save();

        $next = ChaoSky::where('tipid', '<', $tipid)->max('tipid');

        if ($request->action === 'continue') {
            // return redirect()
            //                 ->back()
            //                 ->withSuccess('文章保存成功.');

            return redirect()
                            ->route('admin.news.edit', $next)
                            ->withSuccess('文章保存成功.');
        }

        return redirect()
                        ->route('admin.news.index')
                        ->withSuccess('文章保存成功.');
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
                        ->withSuccess('文章删除成功.');
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

        $pros=Auth::user()->ChaoPros;
        $proids=array();
        foreach ($pros as $pro) {
            array_push($proids, $pro->id);
        }

        $chaoSkies = ChaoSky::where('delflag',0)
                            ->wherein('proid',$proids)
                            ->where(function ($query) use ($searchText)
                            {
                                $query->where('tiptitle', 'like', '%'.$searchText.'%')
                                      ->orwhere('tipcontent', 'like', '%'.$searchText.'%');
                            })
                            ->orderBy('stime', 'desc')->get();

       return view('admin.news.search',compact('chaoSkies','searchText'));
    }
}
