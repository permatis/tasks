@extends('layouts.app')
@section('content')
	<ul class="nav nav-tabs" id="client_tab">
		<li class="active"><a href="#task">All Tasks</a></li>
		<li><a href="#joined">My Work</a></li>
	</ul>

	<div class="tab-content">
		@include('user.tabs.all')
		@include('user.tabs.joined')
	</div>

@endsection