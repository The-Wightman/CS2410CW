@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Aston events</div>
@if ($user = Auth::user())
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
		<p> Welcome back to the aston events page {{$user->name}} . </p>
		<p> You can use the navbar to navigate or click on one of the links below to get started. </p>
		<a href= "{{route('createevent')}}" class = "form-control btn btn-primary">Create a new event</a>
		</br>
		</br>
		<a href= "{{route('userprofile',$user->id)}}" class = "form-control btn btn-primary">View your profile</a>
		</br>
		</br>		
		<a href= "{{route('userevents')}}" class = "form-control btn btn-primary">View just your events</a>
		</br>
		</br>		
		
 </div>
@else
		<div class="panel-body">
                   
			<p> You can use the navbar to navigate or click on one of the links below to get started. </p>
		<a href= "{{route('list')}}" class = "form-control btn btn-primary">View a list of all events</a>

		</br>
		</br>
		<a href= "{{route('userlist')}}" class = "form-control btn btn-primary">View a list of all organisers</a>
		</br>
		</br>		
                        </div>
                    

                    
                </div>
@endif
            </div>
        </div>
    </div>
</div>
@endsection
