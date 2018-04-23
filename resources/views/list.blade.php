@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>All Events</h2></div>
               	 <div class="panel-body">
 			@if (session('status'))
 			<div class="alert alert-success">
 			{{ session('status') }}
 			</div>

 		@endif
 		@include('search')
			</div>
		</div>
	</div>
 <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2> Search Results</h2></div>
                	<div class="panel-body">
 			@include('reducedetable')
			</div>
		</div>
	</div>
	@endsection
</div>


