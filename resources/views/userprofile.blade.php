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
