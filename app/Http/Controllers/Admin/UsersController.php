<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }
    
	public function index()
	{ 
		return view('admin.user.index')->withUsers(DB::table('users')->orderBy('id', 'desc')->paginate(8));
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user.create');
    }
    
    
    public function store(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required||unique:users|max:255',
            'email' => 'required|unique:users|max:255|email',
	 		'password' => 'required|max:255|confirmed|min:6',
	 		'password_confirmation' => 'required|max:255|min:6',
        ]);
        
    	$user = new User();
    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->password = bcrypt($request->input('password'));
    	
    	if ($user->save()) {
    		return redirect('admin/users');
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
		return view('admin.user.edit')->withUser(User::find($id));
	}
    
/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'name'=>'required|max:255',
			'email' => 'required|max:255|email',
			'password' => 'required|max:255|confirmed|min:6',
			'password_confirmation' => 'required|max:255|min:6',
		]);
		
		$user=User::find($id);
		
    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->password = bcrypt($request->input('password'));
		
	  	if ($user->save()) {
            return redirect('admin/users');
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
    	
    	$user = User::find($id);
    	$result=$user->delete();
     
    	$result==true && $res=1;
    	
    	return  $res;
    }
}
