@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(isset($warning))
                <div class="alert alert-danger">
                    <strong>{{ $warning }}</strong>
                </div>
            @else
            <div class="panel panel-default">
                <div class="panel-heading">Complete Account</div>
                <div class="panel-body">
					{!! Form::open(['url' => 'account/complete', 'method' => 'post', 'class' => 'form-horizontal']) !!}
						
                        {!! Form::hidden('id', $user->id) !!}
	                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                    	{!! Form::label('name', 'Full Name', ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
								{!! Form::text('name', '', ['class' => 'form-control']) !!}

                            	@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>

	                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                    	{!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
								{!! Form::password('password', ['class' => 'form-control']) !!}

                            	@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>

	                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	                    	{!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                            	{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                            	
                            	@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group">
	                        <div class="col-md-6 col-md-offset-4">
	                            <button type="submit" class="btn btn-primary">
	                                <i class="fa fa-btn fa-user"></i>Save
	                            </button>
	                        </div>
	                    </div>

					{!! Form::close() !!}

                </div>
            </div>
            @endif
        </div>
    </div>

@endsection