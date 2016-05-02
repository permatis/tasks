<div role="tabpanel" class="tab-pane fade in active" id="moderate">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Images</th>
				<th>Task</th>
				<th>Budget</th>
				<th>Price</th>
				<th>Type</th>
				<th>Info</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if(count($unpublished) > 0)
			@foreach($unpublished as $task)
			<tr>
				<td>
					@foreach($task->image as $img)
					<img src="{{ asset('img/tasks/'.$img->file) }}">
					@endforeach
				</td>
				<td><a href="{{ $task->url }}">{{ $task->name }}</a></td>
				<td>{{ $task->budget }}</td>
				<td>{{ $task->price }}</td>
				<td>
					@foreach($task->type as $type)
					{{ $type->name }}
					@endforeach
				</td>
				<td>{{ $task->description }}</td>
				<td>
					@foreach($task->status as $status)
					{{ $status->name }}
					@endforeach
				</td>
				<td>
					{!! Form::open(['url' => 'moderator/publish/'.$task->id, 'method' => 'PUT'])!!}
					{!! Form::submit('Publish Task') !!}
					{!! Form::close() !!}				
				</td>
			</tr>
			@endforeach
			@else 
			<tr>
				<td colspan="8" style="text-align: center;">Task not avaiable published to moderate.</td>
			</tr>
			@endif
		</tbody>
	</table>
</div>