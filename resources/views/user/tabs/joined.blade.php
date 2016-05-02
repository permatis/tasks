<div role="tabpanel" class="tab-pane fade" id="joined">
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
			@foreach($joiners as $join)
			<tr>
				<td>
					@foreach($join->image as $img)
					<img src="{{ asset('img/tasks/'.$img->file) }}">
					@endforeach
				</td>
				<td><a href="{{ $join->url }}">{{ $join->name }}</a></td>
				<td>{{ $join->budget }}</td>
				<td>{{ $join->price }}</td>
				<td>
					@foreach($join->type as $type)
					{{ $type->name }}
					@endforeach
				</td>
				<td>{{ $join->description }}</td>
				<td>
					@foreach($join->status as $status)
					{{ $status->name }}
					@endforeach
				</td>
				<td>
					<span class="label label-success"> You ready to work. </span>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>