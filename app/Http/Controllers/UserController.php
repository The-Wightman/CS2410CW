<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Auth;

/**
	The User controller class oversees any action performed on an User and provides functions for listing and viewing users and user profiles and is an extension of the {@link Controller} class.
*/

class UserController extends Controller
{
    
	/**
			Purpose: List all the users registered with the site
			Parameters: None
			Description: Returns the userlist.blade.php file as a view with an array loaded with all users of the website
			
	*/
	public function list()
	{
 		return view('userlist', array('users'=>User::all()));
	}

	/**
			Purpose: View a single users profile
			Parameters: A User ID
			Description: take the $id parameter and return the user table entry with a matching ID, then create another new local variable annd load it with all of that users events where they are the organiser. Then return the userprofile.blade.php file as a view with the two local variables as well for use by the view.
			
	*/
	public function profile($id)
	{
		$user = User::where('id', '=', $id)->first();
 		$events = Event::where('user_id', '=',$id)->get();
 		return view('/userprofile')->with(compact('user','events')); 
	}

	/**
			Purpose: Handle filtering requests by the user to show subsets of data
			Parameters: Request from Search.blade.php form
			Description: Receive a request and retrieve the input value which denotes the users desired filter. Then feed the value into a switch statement which will Return the userlist view with a special array of events containing only events matching the users preference.			
		*/
	public function sort(Request $request)
	{
		$filter = $request->input('type');
		switch($filter)
		{
			case"1":
				return view('/userlist',array('users'=>User::orderBy('name','asc')->get()));
			break;
		
			case"2":
				return view('/userlist',array('users'=>User::orderBy('email','asc')->get()));
			break;
		
			case"3":
				return view('/userlist',array('users'=>User::orderBy('phone','asc')->get()));
			break;
			case"4":
				return view('/userlist',array('users'=>User::orderBy('name','desc')->get()));
			break;
			case"5":
				return view('/userlist',array('users'=>User::orderBy('email','desc')->get()));
			break;
			case"6":
				return view('/userlist',array('users'=>User::orderBy('phone','desc')->get()));
			break;
			default:
				return redirect()->route('userlist');
			break;
		}
	}


	
	
	
}
