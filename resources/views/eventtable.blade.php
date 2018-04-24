<div class="container">
    <div class="row justify-content-center">
           <div class="panel panel-default">
                <div class="panel-body col-sm-12">
		
		<table class="table table-striped table-bordered table-hover">
 			<thead>
 				<tr>
 				<th> Event-ID</th>
 				<th> Event name</th>
				 <th> Category</th>
				 <th> Event Date </th>
 				<th> Creation Date </th>
				 <th> Organiser </th>
 				<th> Description </th>
 				<th> Location </th>
 				<th> Image </th>
 				<th> Organiser ID </th>
				<th> Organiser email </th>
 				<th> Likes </th>
 				<th> Link </th>
  				</tr>
 			</thead>
 			<tbody>
 				@foreach($events as $event)
 				<tr>
				<td> {{$event->id}} </td>
				<td> {{$event->Name}} </td>
				<td> {{$event->Category}} </td>
				<td> {{$event->Planned_for}} </td>
				<td> {{$event->Created_on}} </td>
				<?php $user = App\User::find($event->user_id); ?>
				<td> {{$user->name}} </td>
				<td> {{$event->Description}} </td>
				<td> {{$event->place}} </td>
				<td style= "max-width:100px; max-height:150px;" >
				<?php $img = App\Image::where('event_id', '=', $event->id)->get()->first();?>
				@if (isset($img))
				<img src = "{{asset('storage/uploads/'. $img->Name)}}" width="90" height ="100"></img>
				@else
				<p>No image </p>
	@endif
</td>
<td> {{$event->user_id}}</td>
<td> {{$user->email }} </td>
<td> {{$event->likes}} </td>
<td><a href= "{{route('show',$event->id)}}" class = "form-control btn btn-primary">View event</a></td>

 </tr>
 @endforeach
 </tbody>
</table>
</div>
</div>
</div>
</div>

<!-- Scripts -->

<script type="text/javascript">

$(document).ready(function() {
    $('#contacts').dataTable();

$('#contacts tbody').on('click', 'tr', function () {
    var name = $('td', this).eq(1).text();
    var link = $('td', this).eq(0).find('a');
    alert('You clicked on ' + name + '\'s row');
    window.location=link.attr('href');
});
 </script> 
