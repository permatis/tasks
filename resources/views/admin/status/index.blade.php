@extends('layouts.app')
@section('content')
<h3>All Status</h3>
{{ link_to('admin/status/create', 'Create Status') }}
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($status as $s)
		<tr>
			<td>{{ $s->name }}</td>
			<td>{{ $s->description }}</td>
			<td>
				{!! link_to('admin/status/'.$s->id.'/edit', 'edit') !!}
				{!! Form::open(['url' => 'admin/status/'.$s->id, 'method' => 'DELETE']) !!}
				{!! Form::submit('delete') !!}
				{!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection