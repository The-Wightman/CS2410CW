<table class="table table-striped table-bordered table-hover">
 <thead>
 <tr>
 <th> Event name</th>
 <th> Category</th>
 <th> Event Date </th>
 <th> Organiser </th>
 <th> Location </th>
 <th> Likes </th>
 <th> Link </th>
  </tr>
 </thead>
 <tbody>
 @foreach($events as $event)
 <tr>
<td> {{$event->Name}} </td>
<td> {{$event->Category}} </td>
<td> {{$event->Planned_for}} </td>
<?php $user = App\User::find($event->user_id); ?>
<td> {{$user->name}} </td>
<td> {{$event->place}} </td>
<td> {{$event->likes}} </td>
<td><a href= "{{route('show',$event->id)}}">View event</a></td>

 </tr>
 @endforeach
 </tbody>
</table>


