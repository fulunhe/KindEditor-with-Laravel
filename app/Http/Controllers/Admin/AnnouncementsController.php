<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Announcement;

class AnnouncementsController extends Controller
{
 
  	public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }
	
	public function index()
	{ 
		return view('admin.announcement.index')->withAnnouncements(DB::table('announcements')->orderBy('id', 'desc')->paginate(8));
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.announcement.create');
    }
    
    
    //add 
    public function store(Request $request)
    {
    	$announcement = new Announcement();
    	$announcement->title = $request->input('title');
    	$announcement->body = $request->input('body');
    	$announcement->user_id=auth('admin')->user()->id;
    	
    	if ($announcement->save()) {
    		return redirect('admin/announcements');
    	} else {
    		return back()->withInput()->withErrors('保存失败');
    	}
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) 
    {
    	$announcement=Announcement::find($id);
    	return view('admin.announcement.edit',compact('announcement'));
    }
    
    
    /**
     *  update
     */
    public function update(Request $request,$id)
    {
    	$announcement = Announcement::find($id);
    	$announcement->title = $request->input('title');
    	$announcement->body = $request->input('body');
    
    
    	if ($announcement->save()) {
    		return redirect('admin/announcements');
    	} else {
    		return back()->withInput()->withErrors('保存失败');
    	}
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete(Request $request)
    {
    	$res=0;
    	$id=$request->input('id');
    	
    	$announcement = Announcement::find($id);
    	$result=$announcement->delete();
     
    	$result==true && $res=1;
    	
    	return  $res;
    }
    
    
}
