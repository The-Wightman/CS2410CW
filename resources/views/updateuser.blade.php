@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your profile</div>

                <div class="panel-body">

            <form class="form-horizontal" action="{{ route('updateuser', $user->id) }}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

		<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-6">
                                <input id="Name" type="text" class="form-control" name="Name" value="{{$user->Name}}" required>
                            </div>
                        </div>
		
		<div class="form-group">
                            
                            <label for="Name" class="col-md-4 control-label">User Email</label>

                            <div class="col-md-6">
                                <input id="email" type="datetime" class="form-control" name="email" value="{{ $user->email}}" required>
                            </div>
                        </div>
		<div class="form-group">
                            
                            <label for="Name" class="col-md-4 control-label">User Phone number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$user->phone}}" >
                            </div>
                        </div>

                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

@endsection
