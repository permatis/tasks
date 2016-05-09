<div role="tabpanel" class="tab-pane fade" id="user">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name Task</th>
				<th>User Page Links</th>
				<th>Comment</th>
				<th>Rating User</th>
				<th>User</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($joined) && count($joined) > 0)
			@foreach($joined as $join)
			<tr>
				<td>{{ $join['task_name'] }}</td>
				<td>{{ $join['url'] }}</td>
				<td>
					@foreach($join['comment'] as $comment)
					{{ $comment['text'] }}
					@endforeach
				</td>
				<td></td>
				<td>
					<img src="{{ ($join['avatar']) ? $join['avatar'] : avatar($join['email'], 15) }}" alt="{{ $join['username'] }}" title="{{ $join['username'] }}" class="img-circle">
				</td>
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