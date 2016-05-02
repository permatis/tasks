@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Roles</div>
                <div class="panel-body">
					{!! Form::open(['url' => 'admin/roles/'.$role->id, 'method' => 'put', 'class' => 'form-horizontal']) !!}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                    	{!! Form::label('name', 'Name Roles', ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
								{!! Form::text('name', $role->name, ['class' => 'form-control']) !!}

                            	@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	                    	{!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
								{!! Form::textarea('description', $role->description, ['class' => 'form-control']) !!}

                            	@if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>

						<div class="form-group">
	                        <div class="col-md-6 col-md-offset-4">
	                            <button type="submit" class="btn btn-success">
	                                Update
	                            </button>
	                        </div>
	                    </div>

					{!! Form::close() !!}
					
                </div>
            </div>
        </div>
    </div>
@endsection