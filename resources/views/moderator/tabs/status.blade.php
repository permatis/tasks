<div role="tabpanel" class="tab-pane fade" id="status">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Images</th>
				<th>Task</th>	
				<th>Status</th>
				<th>Change Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if(count($tasks) > 0)
			@foreach($tasks as $task)
			<tr>
				
				<td>
					@foreach($task->image as $img)
					<img src="{{ asset('img/tasks/'.$img->file) }}">
					@endforeach
				</td>
				
				<td>{{ $task->name }}</td>

				<td>
					@foreach($task->status as $status)
					{{ $status->name }}
					@endforeach
				</td>
				{!! Form::open(['route' => ['moderator.status', $task->id], 'method' => 'put']) !!}
				<td>
					{!! Form::select('status_id', $stat) !!}
				</td>
				<td>
					<button type="submit" class="btn btn-sm">Update</button>
				</td>
				{!! Form::close() !!}
			</tr>
			@endforeach
			@else 
			<tr>
				<td colspan="8" style="text-align: center;">Task not avaiable to moderate.</td>
			</tr>
			@endif
		</tbody>
	</table>
</div>