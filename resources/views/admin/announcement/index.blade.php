@extends('admin.app')

@section('content')
<div class="container">  
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Announcement Management</div>

        <div class="panel-body"> NOTE: Articles posted by admins can only be shown in admin special column.(Gorilla's work column)<br/>
            <br/><br/>

		<a href="{{ URL('admin/announcements/create') }}" class="btn btn-lg btn-primary">Add</a>
        <table class="table table-striped">
          <tr class="row">
            <th class="col-lg-4">Content</th>
            <th class="col-lg-2">Title</th>
            <th class="col-lg-4">View</th>
            <th class="col-lg-1">Edit</th>
            <th class="col-lg-1">Remove</th>
          </tr>
          @foreach ($announcements as $announcement)
            <tr class="row">
              <td class="col-lg-6">
                {{ $announcement->body }}
              </td>
              <td class="col-lg-2">
                    {{ $announcement->title }}
              </td>
              <td class="col-lg-4">
                <a href="{{ URL('announcements/show/'.$announcement->id) }}" target="_blank">
                  {{ App\Announcement::find($announcement->id)->title }}
                </a>
              </td>
              <td class="col-lg-1">
                <a href="{{ URL('admin/announcements/'.$announcement->id.'/edit') }}" class="btn btn-success">Edit</a>
              </td>
              <td class="col-lg-1">
                  <button onclick="deleteInfo({{$announcement->id}});"   class="btn btn-danger">Remove</button>
              </td>
            </tr>
          @endforeach
        </table>

<?php echo $announcements->render(); ?>
        </div>
      </div>
    </div>
  </div>
</div>  

<script>
function deleteInfo(id)
{
	if(id) {
		var r=confirm('Are you SURE?!?!?!?');
		if(r==true) {
			$.ajax({ 
				url: "{{ URL('admin/announcements/delete/') }}", 
				type: "POST",
				data:{id:id,_token:'{{csrf_token()}}'},
				success: function(data){
					if(data==1) {
		        		alert('OH YEAH!');
		        		location.href= "{{ URL('admin/announcements/')}}";
					} else {
						alert('OH FXXK NO! ERROR!');
					}
		     }});
		}
	}
}
</script>

@endsection


