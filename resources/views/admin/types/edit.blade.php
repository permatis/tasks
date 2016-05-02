@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Type</div>
                <div class="panel-body">
					{!! Form::open(['url' => 'admin/types/'.$type->id, 'method' => 'put', 'class' => 'form-horizontal']) !!}
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                    	{!! Form::label('name', 'Name Type', ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
								{!! Form::text('name', $type->name, ['class' => 'form-control']) !!}

                            	@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>

						<div class="form-group">
	                        <div class="col-md-6 col-md-offset-4">
	                            <button type="submit" class="btn btn-success">
	                                Updated
	                            </button>
	                        </div>
	                    </div>

					{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection