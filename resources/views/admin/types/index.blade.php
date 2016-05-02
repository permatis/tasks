@extends('layouts.app')
@section('content')
<h3>All Types</h3>
{{ link_to('admin/types/create', 'Create Type') }}
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($types as $type)
		<tr>
			<td>{{ $type->name }}</td>
			<td>
				{!! link_to('admin/types/'.$type->id.'/edit', 'edit') !!}
				{!! Form::open(['url' => 'admin/types/'.$type->id, 'method' => 'DELETE']) !!}
				{!! Form::submit('delete') !!}
				{!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection