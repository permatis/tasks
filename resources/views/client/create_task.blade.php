@extends('layouts.app')
@section('content')

<h1>Create Tasks</h1>
{{ link_to('client', 'Back to Tasks') }}

{!! Form::open(['route' => 'client.store', 'files' => true]) !!}
	{!! Form::select('type', $types, null, ['placeholder' => 'Choose type task']) !!}<br />
	{!! Form::text('name', '', ['placeholder' => 'Name task']) !!}<br />
	{!! Form::text('url', '', ['placeholder' => 'https://']) !!}<br />
	{!! Form::text('budget', '', ['placeholder' => 'Budget']) !!}<br />
	{!! Form::text('price', '', ['placeholder' => 'Price per one step']) !!}<br />
	{!! Form::textarea('description', '', ['placeholder' => 'Description']) !!}<br />
	{!! Form::file('images') !!}<br />
	{!! Form::submit('Save Task') !!}
{!! Form::close() !!}

@endsection