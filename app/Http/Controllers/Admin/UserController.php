<?php
	namespace App\Http\Controllers\Admin;

	use App\Http\Requests;

	use Illuminate\Http\Request;

	use App\Http\Controllers\Controller;

	class UserController extends Controller
	{
	    /**
	     * Display a listing of the resource.
	     *
	     * @return \Illuminate\Http\Response
	     */
	    public function index(Request $request)
	    {
	        
	       return view('admin.user.index');
	    
	    }   

    
	}