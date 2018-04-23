<table class="table table-striped table-bordered table-hover">
 <thead>
 <tr>
 <th> Organiser ID</th>
 <th> Organiser Name</th>
 <th> Contact Email</th>
 <th> Contact Number </th>
 <th> Profile Link </th>
  </tr>
 </thead>
 <tbody>
 @foreach($users as $user)
 <tr>
<td> {{$user->id}} </td>
<td> {{$user->name}} </td>
<td> {{$user->email}} </td>
<td> {{$user->phone}} </td>
<td><a href= "{{route('userprofile', $user->id)}}">View User</a></td>
 </tr>
 @endforeach
 </tbody>
</table>
