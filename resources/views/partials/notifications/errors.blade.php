@if (count($errors) > 0)
    @foreach($errors->all() as $error)
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
		<ul>
			<li>{{ $error }}</li>
		</ul>
	</div>
    @endforeach
@endif