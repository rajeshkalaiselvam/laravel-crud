<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD Data Table</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="{{ URL::asset('assets/style.css') }}">
	<script src="{{ URL::asset('assets/custom.js') }}"></script>
</head>
<body>
	<div class="container">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage Employees</h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ url('create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>						
					</div>
				</div>				
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Name</th>
						<th>Email</th>						
						<th>Mobile</th>						
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>	
					@foreach($data as $key=>$val)						
					<tr>
						<td>{{$key+1}}</td>
						<td>{{$val->name}}</td>
						<td>{{$val->email}}</td>										
						<td>{{$val->mobile}}</td>										
						<td>
							<a href="{{ url('edit/'.$val->id) }}" class="edit"><i class="material-icons" data-bs-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteEmployeeModal" class="delete" data-bs-toggle="modal" data-id="{{ $val->id }}"><i class="material-icons" data-bs-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr>
					@endforeach					
				</tbody>
			</table>
		</div>
	</div>

	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="{{ url('delete') }}">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Employee</h4>
						<button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">	
					
						<input type="hidden" name="id" id="id" value="">				
						<p>Are you sure you want to delete these Records?</p>
						@csrf
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script>
	$('.delete').click(function(){
        var id = $(this).data('id');
		console.log(id);
        $('#id').val(id);
    });
</script>
</html>