<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Event;
use App\User;
use App\Image;

use Auth;
use Gate;
use Hash;

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
	
		/**
			Purpose: Allow a user to modify his account
			Parameters: A single user ID value
			Description:The user passes in the ID of the user they wish to modify, that user is retrieved from the database and then checked against the current users ID to ensure the event is being modified by the owner and then returns the updateuser view with an array containing all of the current changeable user information.
			
		*/
		public function alteruser($id)
		{
			$user=User::find($id);
			if (Gate::allows('AuthCheckUser', $user))
			{
				return view('updateuser',array('user' => $user));
			}
		}

		/**
			Purpose: Update a User
			Parameters: A request from the updateuser.blade.php form and a User ID
			Description: The passed ID is used to create a new local variable version of the user being modified. Then the updated fields are overwritten using the values inputted into the form.. Once complete redirect them to the userprofile route with the user ID so the user can see the updates have been completed.
			
		*/
		public function updateuser(Request $request,$id)
		{
			$user = User::find($id);
			$user->Name = $request->input('Name');
			$user->email = $request->input('email');
			$user->phone = $request->input('phone');			
			$user->save();
			
			
			return redirect()->route('userprofile',$id);
		}

		/**
			Purpose: Allow the owner of an account to delete it from the website.
			Parameters: A user ID
			Description: The user ID is used to bring the matching user into a local variable and all images that correspond to the loaded user into a second local variable. The current users ID is checked to ensure they are the owner of the account, if they are for each event related to the user it deletes each event. Once this process has finished you are redirected back to the list of all events as the current page no longer exists.
			
		*/
		public function deleteuser($id)
		{
			$user=User::find($id);
			$events=Event::query()->where('user_id', '=',$id)->get();
			if (Gate::allows('AuthCheckUser', $id))
			{
				foreach($events as $event)
				{
					$images=Image::query()->where('event_id', '=',$event->id)->get();
					foreach($images as $image)
					{
						$entry= "public/uploads/" . $image->Name; 
						Storage::delete($entry);
						$event->delete($event->id);
					}					
				}
			
								
			$user->delete($user->id);
			return redirect()->route('list');
		}
	}
	
		public function updateuserpass()
		{
        		return view('auth.changepassword');
    		}
		
		public function changeuserpass(Request $request)
		{
			if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
			return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
		}		
		$validatedData = $request->validate
		([
			'current-password' => 'required',
			'new-password' => 'required|string|min:6|confirmed',
		]);
		$user = Auth::user();
		$user->password = bcrypt($request->get('new-password'));
		$user->save();
		return redirect()->route('home');
}

			
		
	
	


	
	
	
}
