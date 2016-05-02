<div role="tabpanel" class="tab-pane fade in active" id="task">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Images</th>
				<th>Task</th>			
				<th>Budget</th>
				<th>Price</th>
				<th>Type</th>
				<th>Status</th>
				<th>Publish</th>
				@if(count($workers) > 0)
				<th>User</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($tasks as $task)
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
				<td>
					@foreach($task->status as $status)
					{{ $status->name }}
					@endforeach
				</td>
				<td>
					<span class="label label-default" style="display: inline-block;">
					@if($task->published == 0)
						Wait publish from moderator
					@else
						Published
					@endif
					</span>

				</td>
				@if(count($workers) > 0 )
				<td>
					@foreach($workers as $worker)
					@if($worker['task_id'] == $task->id)
					<span class="label label-primary" style="display: inline-block;">
						{{ $worker['email'] }}
					</span>
					@endif
					@endforeach
				</td>
				@endif
			
			</tr>
			@endforeach
		</tbody>
	</table>
</div>