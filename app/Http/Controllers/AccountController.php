<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

/**
	An extension of the {@link Controller} class that oversees user accounts and provides functionality based on authentication
*/
class EventController extends Controller
{
	/**
		Purpose: Ch 
		Parameters:
		Description: 
			
	*/
	public function show($id)
	{
		$event = Event::find($id);
		return view('/show', array('event' => $event));
	}
	/**
		Purpose: 
		Parameters:
		Description: 
			
	*/
	public function list()
	{
		return view('/list', array('events'=>Events::all()));
	}
}

