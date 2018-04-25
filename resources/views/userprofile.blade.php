@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>{{ $user->name }}'s profile</h2></div>
                <div class="panel-body"> 
 <h1>Profile:  {{ $user->name }}</h1>
 <h2>User Email: {{ $user->email }}</h2>
 <h2>User Phonenumber: {{$user->phone}}</h2>
 <h2>User ID: {{ $user->id }} </h2>

	<div class="col-md-4 col-xs-4">
			@if (Auth::User()->id == $user->id)
				<div>
				<a href= "{{route('alteruser',$user->id)}}" class = "form-control btn btn-primary">Edit Details</a>
				</div>
				</br>
				<form action="{{route('updatepassword')}}" method="POST">
       						{{csrf_field()}}
      					  <input class = "form-control btn btn-primary" type = "submit" value = "Update password">
    				</form>
						
					<form action="{{route('deleteuser', $user->id)}}" method="POST">
       						 {{csrf_field()}}
      					  <input class = "form-control btn btn-primary" type = "submit" value = "Delete account">
    						</form>
						</br>
								
@endif
					</div>
 				</div>
			</div>
		</div>
	</div>
<div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>{{ $user->name }}'s Events</h2></div>
                <div class="panel-body"> 
@include('eventtable')
@endsection</div>
	</div>
	</div>
</div>
