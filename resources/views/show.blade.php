@extends('layouts.app')

@section('content')
<div class="container">
 	<div class="row justify-content-center">
 		<div class="col-md-8">
			 <div class="card"> 
 				<div class="card-body">
				 @if (session('status'))
 				<div class="alert alert-success">
 				{{ session('status') }}
 				</div>
 				@endif
				</div>
			</div>
		</div>
	</div>
	<div class="container">
    		<div class="row">
       			 <div class="col-md-12 col-xs-12">
           			 <div class="panel panel-default">
 					<title>{{ $event->Name }}</title>
					<h1><ul> Event: {{ $event->Name }}</ul></h1>
					<h2><ul> Event-ID: {{ $event->id }} </ul></h2>
				</div>
			</div>
		</div>

   	 <div class="row">
       		<div class="col-md-6 col-xs-6">
           		<div class="panel panel-default">
               			<div class="panel-heading">Event Details</div>
                			<div class="panel-body">
 					<li>Category: {{ $event->Category }}</li>
 					<li>Event Date: {{ $event->Planned_for }}</li>
 					<li>Creation Date: {{ $event->Created_on }}</li>
 					<li>Organiser: {{ $event->Organiser }}</li>
 					<li>Description: {{ $event->Description }}</li>
 					<li>Location: {{ $event->place }}</li> 
 					<li>Organiser ID: {{ $event->user_id}}</li>
 					<li>Likes: {{ $event->likes}}</li>
					@if (in_array($event->id, Session::get('likes')))
    						<form action="{{route('unlikeevent', $event->id)}}" method="POST">
        					{{csrf_field()}}
       						 <input class = "form-control btn btn-secondary" type = "submit" value = "Unlike">
    						</form>
					</br>
					@else
  						  <form action="{{route('likeevent', $event->id)}}" method="POST">
      						  {{csrf_field()}}
 					   	 	<input class = "form-control btn btn-primary" type="submit" value="Like">
   						 </form>	
					</br>
					@endif
					<?php $organiser = App\User::find($event->user_id); ?>
    					<a href = "mailto:{{$organiser->email}}?subject= Questions about {{$event->Name}} on the {{$event->Planned_for}}." class = "form-control btn btn-primary">Email organiser</a>
	
					</br>
					</br>
					@if (Auth::check())
					@if (Auth::User()->id == $event->user_id)
						<a href= "{{route('alterevent',$event->id)}}" class = "form-control btn btn-primary">Edit event</a>
					
					</br>
					</br>
						<form action="{{route('deleteevent', $event->id)}}" method="POST">
       						 {{csrf_field()}}
      						  <input class = "form-control btn btn-primary" type = "submit" value = "Delete event">
    						</form>
						</br>
					
					@endif
					@endif
					</div>
				</div>
			</div>
	<div class="row">
        	<div class="col-md-6 col-xs-6">
            		<div class="panel panel-default">
              	 	 <div class="panel-heading">Images</div>
              		  <div class="panel-body">
				<?php $images = App\Image::where('event_id', '=', $event->id)->get(); ?>
				@if(!$images->isEmpty())
				@foreach($images as $img)				
					<img src = "{{asset('storage/uploads/'. $img->Name)}}" width="200" height ="200"></img>
				@endforeach
					
				@else
					<p> There are no images for this event </p>
				@endif
			
				
				</div>
			</div>
		</div>
	</div>
 
 </div>
</div>


@endsection
