<div role="tabpanel" class="tab-pane fade" id="user">

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name Task</th>
				<th>User</th>
				<th>Rating User</th>
				<th>Choose User</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($joined) && count($joined) > 0)
			@foreach($joined as $join)
			<tr>
				<td>{{ $join['task_name'] }}</td>
				<td>{{ $join['email'] }}</td>
				<td></td>
				<td>
					{!! Form::open(['url' => 'client/joiner/'.$join['user_id'].'/task/'.$join['task_id'], 'method' => 'PUT'])!!}
					{!! Form::submit('Accept') !!}
					{!! Form::close() !!}
				</td>
			</tr>
			@endforeach
			@else 
			<td colspan="4" style="text-align: center;">User not found.</td>
			@endif
		</tbody>
	</table>
</div>