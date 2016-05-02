<div role="tabpanel" class="tab-pane fade in active" id="task">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Images</th>
				<th>Link</th>
				<th>Budget</th>
				<th>Price</th>
				<th>Type</th>
				<th>Info</th>
				<th>Status</th>
				<th>Join to Work</th>
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
				<td>{{ $task->description }}</td>
				<td>
					@foreach($task->status as $status)
					{{ $status->name }}
					@endforeach
				</td>
				<td>
					<!-- Find tasks by user and status 0 -->
					<?php $join = $task->userTask()->where('user_id', user()->id)->where('status', 0)->first(); ?>
					@if($join)
						<span class="label label-default"> Wait accept from client </span>
					@endif
					
					<!-- Find tasks by user and status 1 -->
					<?php $working = $task->userTask()->where('user_id', user()->id)->where('status', 1)->first(); ?>
					@if($working)
						<span class="label label-success"> You ready to work. </span>
					@endif

					<!-- Find tasks by user -->
					@if($task->userTask()->get() && ! $join && ! $working)
						{!! Form::open(['url' => 'user/join/'.$task->id, 'method' => 'PUT'])!!}
						{!! Form::submit('Join Task') !!}
						{!! Form::close() !!}
					@endif
					
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>