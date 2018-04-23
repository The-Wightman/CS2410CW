@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create an Event</div>
                <div class="panel-body">

            	<form class="form-horizontal" action="{{ route('createevent') }}" method="POST" enctype="multipart/form-data" >
	                {{ csrf_field() }}
			<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Event Name</label>

                            <div class="col-md-6">
                                <input id="Name" type="text" class="form-control" name="Name" required>
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
                            <label for="Name" class="col-md-4 control-label">Organiser</label>
                            <div class="col-md-6">
                                <input id="Organiser" type="text" class="form-control" name="Organiser" required >
                            </div>
                        </div>
			<div class="form-group">
                            <label for="Name" class="col-md-4 control-label" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" >Organiser Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>
			<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Event Date</label>
                            <div class="col-md-6">
                                <input id="Planned_for" type="datetime-local" class="form-control" name="Planned_for" required>
                            </div>
                        </div>
			<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Creation date</label>

                            <div class="col-md-6">
                                <input id="Created_on" type="datetime-local" class="form-control" name="Created_on" required>
                            </div>
                        </div>
			<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="Description" type="text" class="form-control" name="Description" >
                            </div>
                        </div>
			<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Venue</label>

                            <div class="col-md-6">
                                <input id="place" type="text" class="form-control" name="place" required>
                            </div>
                        </div>
			<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="file[]" accept="image/*" multiple>
                            </div>
                        </div>
			<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>

@endsection
