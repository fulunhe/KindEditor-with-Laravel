<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Article;
use App\Type;

class ArticlesController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

	public function index()
	{ 
		return view('admin.article.index')->withArticles(DB::table('articles')->orderBy('id', 'desc')->paginate(8));
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.article.create')->withTypes(Type::all());
    }
    
    
    //add 
    public function store(Request $request)
    {
    	$article = new Article();
    	$article->title = $request->input('title');
    	$article->body = $request->input('body');
    	$article->typeId = $request->input('typeId');
    	$article->user_id=auth('admin')->user()->id;
    	
    	if ($article->save()) {
    		return redirect('admin/articles');
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
    	$article=Article::find($id);
    	$types=Type::all();
    	
    	return view('admin.article.edit',compact('article','types'));
    }
    
    
    /**
     *  update
     */
    public function update(Request $request,$id)
    {
    	$article = Article::find($id);
    	$article->title = $request->input('title');
    	$article->body = $request->input('body');
    	$article->typeId = $request->input('typeId');
    
    	if ($article->save()) {
    		return redirect('admin/articles');
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
    	
    	$article = Article::find($id);
    	$result=$article->delete();
     
    	$result==true && $res=1;
    	
    	return  $res;
    }
    
}
