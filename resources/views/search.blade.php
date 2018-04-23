<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Filter and Order results</div>
                <div class="panel-body">
	@if(isset($events))
				<form method="POST" action="{{ route('eventsort') }}">
				{{ csrf_field() }}
  				<select name="type" value="type">
  				  <option value="1">Filter Sport</option>
 				  <option value="2">Filter Culture</option>
   				  <option value="3">Filter Other</option>
 				  <option value="4">Order by likes (ASC)</option>
 				  <option value="5">Order by Date (ASC)</option>
   				  <option value="6">Order by Name (ASC)</option>
  				  <option value="7">Order by Organiser (ASC)</option>
 				  <option value="8">Order by Location (ASC)</option>
				  <option value="9">Order by likes (DESC)</option>
 				  <option value="10">Order by Date (DESC)</option>
   				  <option value="11">Order by Name (DESC)</option>
  				  <option value="12">Order by Organiser (DESC)</option>
 				  <option value="13">Order by Location (DESC)</option>
   				  </select>
				 <button type="submit" class="btn btn-primary">
                                   Filter
                                </button>
				</form>
				</div>
	@else
			<form method="POST" action="{{ route('usersort') }}">
				{{ csrf_field() }}
  				<select name="type" value="type">
  				  <option value="1">Order by Name (ASC)</option>
 				  <option value="2">Order by Email (ASC)</option>
   				  <option value="3">Order by Phone (ASC)</option>
				  <option value="4">Order by Name (DESC)</option>
 				  <option value="5">Order by Email (DESC)</option>
   				  <option value="6">Order by Phone (DESC)</option>
 				 </select>
				 <button type="submit" class="btn btn-primary">
                                   Apply
                                </button>
				</form>
				</div>
	@endif
			</div>
		</div>
	</div>
</div>


