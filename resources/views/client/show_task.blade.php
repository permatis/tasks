@extends('layouts.app')
@section('content')
<ul>
	<li>{{ link_to('client', 'All Tasks') }}</li>
	<li>{{ link_to('client/create-task', 'Create Tasks') }}</li>
</ul>

<h4>Choose user for this task</h4>
<b>Task:</b> {{ ucwords($task->name) }}
<li>{{ link_to('client', 'back to all tasks') }}</li>
<table>
	<thead>
		<tr>
			<th>User</th>
			<th>Rating User</th>
			<th>Choose User</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			@if(count($join) > 0)
			<td>
				@foreach($join as $user)
				{{ $user->name }}
				@endforeach
			</td>
			<td></td>
			<td>
				@foreach($join as $userid)
				{!! Form::open(['url' => 'task/'.$task->id.'/user/'.$userid->id, 'method' => 'PUT'])!!}
				{!! Form::submit('Accept') !!}
				{!! Form::close() !!}
				@endforeach
			</td>
			@else 
			<td colspan="3" style="text-align: center;">User not found.</td>
			@endif
		</tr>

	</tbody>
</table>
@endsection