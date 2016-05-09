@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-md-3 text-center">
			<img src="{{ ($user->avatar) ? $user->avatar : avatar($user->email) }}" alt="" class="img-circle">
			<h3 class="title">{{ $user->name }}</h3>
			<label >Member Since :</label> {{ $user->updated_at->diffForHumans() }}
			<a href="/" class="btn btn-default">Edit Profile</a>
		</div>
		<div class="col-md-9">
			
			{!! Form::open(['route' => 'user.pages.save', 'method' => 'post']) !!}
				
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					{!! Form::text('name', '', ['placeholder' => 'Name Pages', 'class' => 'form-control']) !!}

	            	@if ($errors->has('name'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @endif
				</div>
				<div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
					{!! Form::text('url', '', ['placeholder' => 'URL Pages', 'class' => 'form-control']) !!}

                	@if ($errors->has('url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default">Create It!</button>
				</div>
			
			{!! Form::close() !!}
			
			<h3>Pages</h3>
			<hr />
			<div id="all-pages">
				@if(count($pages) > 0)
					@foreach($pages as $page)
						<ul>
							<li>{!! link_to($page->url, $page->name) !!}</li>
						</ul> 
					@endforeach
				@else
					<h3 class="text-center">Hay. You must create pages.</h3>
				@endif
			</div>
		</div>
	</div>
@endsection