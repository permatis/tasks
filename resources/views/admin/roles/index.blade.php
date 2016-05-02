@extends('layouts.app')
@section('content')
<h3>All Roles</h3>
{{ link_to('admin/roles/create', 'Create Roles') }}
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($roles as $role)
		<tr>
			<td>{{ $role->name }}</td>
			<td>{{ $role->description }}</td>
			<td>
				{!! link_to('admin/roles/'.$role->id.'/edit', 'edit') !!}
				{!! Form::open(['url' => 'admin/roles/'.$role->id, 'method' => 'DELETE']) !!}
				{!! Form::submit('delete') !!}
				{!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection