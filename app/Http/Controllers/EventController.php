<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Event;
use Gate;
use Auth;

/**
	The Event controller class oversees any action performed on an event and provides functions for Creating/Viewing/Deleting
events and is an extension of the {@link Controller} class.
*/

class EventController extends Controller
	{
		/**
			Purpose: Show all the information assigned to the event of the given ID
			Parameters: An event ID value
			Description: Takes a singular event ID values, finds the corresponding event form the event database thenreturns the show view file with the array containing all of that events information. 
			
		*/
		public function show($id)
		{
 			$event = Event::find($id);
 			return view('/show', array('event' => $event));
		}

		/**
			Purpose: Show a list of only events with a specific category.
			Parameters: A category enum value;
			Description: Take a value that corresponds to the category enum , then fetch a list of events where thecategory value is equal to the one provided, then return the list view with an array of matching events and the enum value.
			
		*/

		public function showbytype($category)
		{
			$events = Event::where('category', '=',$category)->get();
			$searchedType = $category;
			return view('/list')->with(compact('events','searchedType'));
		}

		/**
			Purpose: Handle filtering requests by the user to show subsets of data
			Parameters: Request from Search.blade.php form
			Description: Receive a request and retrieve the input value which denotes the users desired filter. Then feed the value into a switch statement which will either:
				-Redirect to the category page and filter by desired category preference
				-Return the list view with a special array of events containing only events matching the users preference			
		*/
		public function sort(Request $request)
		{
		$filter = $request->input('type');
		switch($filter)
			{
			case"1":
				return redirect()->route('category','Sport');
			break;
		
			case"2":
				return redirect()->route('category','Culture');
			break;
		
			case"3":
				return redirect()->route('category','Other');
			break;
			case"4":
				return view('/list',array('events'=>Event::orderBy('likes','asc')->get()));
			break;
			case"5":
				return view('/list',array('events'=>Event::orderBy('Planned_for','asc')->get()));
			break;
			case"6":
				return view('/list',array('events'=>Event::orderBy('Name','asc')->get()));
			break;
			case"7":
				return view('/list',array('events'=>Event::orderBy('Organiser','asc')->get()));
			break;
			case"8":
				return view('/list',array('events'=>Event::orderBy('place','asc')->get()));
			break;
			case"9":
				return view('/list',array('events'=>Event::orderBy('likes','desc')->get()));
			break;
			case"10":
				return view('/list',array('events'=>Event::orderBy('Planned_for','desc')->get()));
			break;
			case"11":
				return view('/list',array('events'=>Event::orderBy('Name','desc')->get()));
			break;
			case"12":
				return view('/list',array('events'=>Event::orderBy('Organiser','desc')->get()));
			break;
			case"13":
				return view('/list',array('events'=>Event::orderBy('place','desc')->get()));
			break;
			default:
				return redirect()->route('list');
			break;
			}
		}

		/**
			Purpose: Return a list of all Events
			Parameters:none
			Description: Return the list view and an array of all the events stored in the database
			
		*/
		public function list()
		{
 			return view('/list', array('events'=>Event::all()));
		}

		/**
			Purpose: Return a list of all of the users events
			Parameters: none
			Description: Return the list view with an array containing all the events where the current users id matches the events organiser ID
			
		*/
		public function myevents()
		{
 			$eventsQuery=Event::query()->where('user_id','=', Auth::user()->id)->get(); 	
			return view('/userevents', array('events'=>$eventsQuery));	
		}

		/**
			Purpose: Return the Create event view file.
			Parameters: None
			Description: Return the createevent view.
			
		*/
		public function createevent()
		{
		return view('createevent');
		}

		/**
			Purpose: Creates a new event on the event table of the database
			Parameters: A request from the createevent.blade.php form
			Description: Recieve a request from the createvent form containing all the data inputs from the user, it then validates that each file passed in matches acceptable image file types. A new event i sthen created and the basic information is retrieved from the request and inputted into the matching fields of the new event ready for addition to the database and is then saved. For each image a new images file is created on the database and the image is stored in the public resources section to allow access. Once the event and image entries have been created redirect to a show route with the id of the newly created event to show the new event on the website.
			
		*/
		public function create(Request $request)
		{
			$this->validate($request, array('file.*' => 'image'));
			$event = new Event();
			$event->Name = $request->input('Name');
			$event->Category = $request->input('Category');
			$event->Organiser = $request->input('Organiser');
			$event->email = $request->input('email');
			$event->Planned_for = $request->input('Planned_for');
			$event->Created_on = $request->input('Created_on');
			$event->Description = $request->input('Description');
			$event->place = $request->input('place');
			$event->user_id = Auth::user()->id;
			$event->save();

			foreach($request->file as $file)
			{
		
				$img = new Image();
				$img->name = time() . '_' . $file->hashName();
				$img->event_id = $event->id;
				$img->save();
				$file->storeAs('public/uploads', $img->name);
			}
			return redirect()->route('show', array('id' => $event->id));
		}	

		/**
			Purpose: Allow a user to modify an existing event
			Parameters: A single event ID value
			Description:The user passes in the ID of the event they wish to modify, that event is retrieved from the database and then checked against the current users ID to ensure the event is being modified by the owner and then returns the updatevent view with an array containing all of the current events information.
			
		*/
		public function alterevent($id)
		{
			$event=Event::find($id);
			if (Gate::allows('AuthCheck', $event))
			{
				return view('updateevent',array('event' => $event));
			}
		}

		/**
			Purpose: Update an event
			Parameters: A request from the updateevent.blade.php form and an event ID
			Description: The passed ID is used to create a new local variable version of the event being modified. Then the updated fields are overwritten using the values inputted into the form, if any new pictures have been added to the event then for each of the images create a linked entry in the images table and store them in the public uploads folder. Once complete redirect them to the show route with the events ID so the user can see the updates have been completed.
			
		*/
		public function updateevent(Request $request,$id)
		{
			$event = Event::find($id);
			$event->Name = $request->input('Name');
			$event->Category = $request->input('Category');
			$event->Planned_for = $request->input('Planned_for');
			$event->Description = $request->input('Description');
			$event->place = $request->input('place');
			$event->save();

			if(isset($request->file))
			{
				foreach($request->file as $file)
				{
					$img = new Image();
					$img->name = time() . '_' . $file->hashName();
					$img->event_id = $event->id;
					$img->save();
					$file->storeAs('public/uploads', $img->name);
				}
			}	

			return redirect()->route('show',$id);
		}
			/**
				Purpose: Allow the user to show interest in an event by liking it
				Parameters: A request from the show.blade.php like form and an event ID
				Description: The event ID is used to retrive the events information from the database with an if statement then ensuring that a modification is only attempted if an event was returned and the current user hasnt already liked the event. Then the events likes count is incremented and the new event is saved back to the database, the current users session is also updated so they cannot then like the event multiple times. Once the likes have been updated return back to the page you are currently viewing to update the information.
			
			*/

		public function like(Request $request, $id)
		{
			$event = Event::find($id);
			if(isset($event)&& !in_array($event->id, $request->session()->get('likes')))
			{
				++$event->likes;
				$event->save();
				$likes = $request->session()->get('likes');
				array_push($likes, $event->id);
				$request->session()->put('likes', $likes);
			}
			return redirect()->route('show', array('id' => $id));
		}

		/**
			Purpose: Allow the user to remove interest in an event by unliking it
			Parameters: A request from the show.blade.php like form and an event ID
			Description: The event ID is used to retrive the events information from the database with an if statement then ensuring that a modification is only attempted if an event was returned and the current user has already liked the event. Then the events likes count is decremented and the new event is saved back to the database, the current users session is also updated so they can then like the event . Once the likes have been updated return back to the page you are currently viewing to update the information.
			
		*/
		public function unlike(Request $request, $id)
		{
			$event = Event::find($id);
			if(isset($event)&& in_array($event->id, $request->session()->get('likes')))
			{
				--$event->likes;
				$event->save();
				$likes = $request->session()->get('likes');
				unset($likes[array_search($event->id, $likes)]);
				$request->session()->put('likes', $likes);
			}
			return redirect()->route('show', array('id' => $id));
		}

		/**
			Purpose: Allow the owner of an event to delete it from the page.
			Parameters: An event ID
			Description: The event ID is used to bring the matching event into a local variable and all images that correspond to the loaded event into a second local variable. The current users ID is checked to ensure they are the organiser of the event, if they are for each image related to event it deletes each file stored in the public uploads, then the event is deleted with the image table being updated by casading deletion. Once this process has finished you are redirected back to the list of all events as the current page no longer exists.
			
		*/
		public function deleteevent($id)
		{
			$event=Event::find($id);
			$images=Image::query()->where('event_id', '=',$id)->get();
			if (Gate::allows('AuthCheck', $event))
			{
				foreach($images as $image)
				{
					$entry= "public/uploads/" . $image->Name; 
					Storage::delete($entry);					
				}				
			$event->delete($event->id);
			return redirect()->route('list');
		}
			
		
	}

}

