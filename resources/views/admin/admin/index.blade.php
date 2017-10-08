@extends('admin.app')

@section('content')
<div class="container">  
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">ADMIN</div>

        <div class="panel-body">
		<a href="{{ URL('admin/admins/create') }}" class="btn btn-lg btn-primary">New Admin</a>
        <table class="table table-striped">
          <tr class="row">
            <th class="col-lg-4">user name</th>
            <th class="col-lg-4">Email address</th>
            <th class="col-lg-1">edit</th>
            <th class="col-lg-1">remove</th>
          </tr>
          @foreach ($admins as $admin)
            <tr class="row">
              <td class="col-lg-4">
                    {{ $admin->name }}
              </td>
               <td class="col-lg-4">
                    {{ $admin->email }}
              </td>
              <td class="col-lg-1">
                <a href="{{ URL('admin/admins/'.$admin->id.'/edit') }}" class="btn btn-success">edit</a>
              </td>
              <td class="col-lg-1">
                  <button onclick="deleteInfo({{$admin->id}});"   class="btn btn-danger">remove</button>
              </td>
            </tr>
          @endforeach
        </table>

<?php echo $admins->render(); ?>
        </div>
      </div>
    </div>
  </div>
</div>  

<script>
function deleteInfo(id)
{
	if(id) {
		var r=confirm('Are you sre?');
		if(r==true) {
			$.ajax({ 
				url: "{{ URL('admin/admins/delete/') }}", 
				type: "POST",
				data:{id:id,_token:'{{csrf_token()}}'},
				success: function(data){
					if(data==1) {
		        		alert('Removed successfully');
		        		location.href= "{{ URL('admin/admins/')}}";
					} else {
						alert('Failed to remove');
					}
		     }});
		}
	}
}
</script>

@endsection


