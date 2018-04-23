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
<td> {{$event->Organiser}} </td>
<td> {{$event->place}} </td>
<td> {{$event->likes}} </td>
<td><a href= "{{route('show',$event->id)}}">View event</a></td>

 </tr>
 @endforeach
 </tbody>
</table>

<!-- Scripts -->

<script type="text/javascript" >

$(document).ready(function() {
    $('#contacts').dataTable();

$('#contacts tbody').on('click', 'tr', function () {
    var name = $('td', this).eq(1).text();
    var link = $('td', this).eq(0).find('a');
    alert('You clicked on ' + name + '\'s row');
    window.location=link.attr('href');
});
 </script>
