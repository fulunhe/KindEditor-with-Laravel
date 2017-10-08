<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Type; 

class TypesController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }
	
	public function index()
	{ 
		return view('admin.type.index')->withTypes(DB::table('types')->orderBy('id', 'desc')->paginate(8));
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.type.create');
    }
    
    
    //add 
    public function store(Request $request)
    {
    	$type = new Type();
    	$type->name = $request->input('name');
    	$type->description = $request->input('description');
    	
    	if ($type->save()) {
    		return redirect('admin/types');
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
    	$type=Type::find($id);
    	return view('admin.type.edit',compact('type'));
    }
    
    
    /**
     *  update
     */
    public function update(Request $request,$id)
    {
    	$Type = Type::find($id);
    	$Type->name = $request->input('name');
    	$Type->description = $request->input('description');
    
    
    	if ($Type->save()) {
    		return redirect('admin/types');
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
    	
    	$type = Type::find($id);
    	$result=$type->delete();
     
    	$result==true && $res=1;
    	
    	return  $res;
    }
    
}
