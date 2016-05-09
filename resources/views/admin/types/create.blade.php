@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Type</div>
                <div class="panel-body">
					{!! Form::open(['url' => 'admin/types', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name Type', ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
                                {!! Form::text('name', '', ['class' => 'form-control']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('urls') ? ' has-error' : '' }}">
	                    	{!! Form::label('urls', "URL's", ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
								{!! Form::text('urls', '', ['class' => 'form-control']) !!}

                            	@if ($errors->has('urls'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('urls') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>

						<!-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                    	{!! Form::label('name', 'Choose Field', ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
								{!! Form::select('name', ['button' => 'Button', 'text' => 'Text'], null, ['class' => 'form-control']) !!}

                            	@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
							</div>
						</div> -->

						<div class="form-group">
	                        <div class="col-md-6 col-md-offset-4">
	                            <button type="submit" class="btn btn-primary">
	                                Save
	                            </button>
	                        </div>
	                    </div>

					{!! Form::close() !!}
					
                </div>
            </div>
        </div>
    </div>
@endsection