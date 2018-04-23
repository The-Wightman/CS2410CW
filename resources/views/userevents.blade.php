@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Search your events</h2></div>
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
                <div class="panel-heading"><h2>Search results</h2></div>
                <div class="panel-body">
 @include('eventtable')
</div>
</div>
</div>
@endsection
</div>
</div>
</div>
</div>
