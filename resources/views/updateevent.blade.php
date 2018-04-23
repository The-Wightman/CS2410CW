@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit an event</div>

                <div class="panel-body">

            <form class="form-horizontal" action="{{ route('updateevent', $event->id) }}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

		<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Event Name</label>

                            <div class="col-md-6">
                                <input id="Name" type="text" class="form-control" name="Name" value="{{$event->Name}}" required>
                            </div>
                        </div>
<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select name = "Category" class="form-control" >
<option value = "Sport">Sport</option>
<option value = "Culture">Culture </option>
<option value = "Other">Other</option>
</select>
                            </div>
                        </div>
<div class="form-group">
                            
                            <label for="Name" class="col-md-4 control-label">Event Date</label>

                            <div class="col-md-6">
                                <input id="Planned_for" type="datetime" class="form-control" name="Planned_for" value="{{ $event->Planned_for}}" required>
                            </div>
                        </div>
<div class="form-group">
                            
                            <label for="Name" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="Description" type="text" class="form-control" name="Description" value="{{$event->Description}}" >
                            </div>
                        </div>
<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Venue</label>

                            <div class="col-md-6">
                                <input id="place" type="text" class="form-control" name="place" value="{{$event->place}}" >
                            </div>
                        </div>
<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="file[]" accept="image/*" value= multiple>
                            </div>
                        </div>
<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

@endsection
