@extends('layouts.app')
@section('content')
{{ link_to('client/create', 'Create Tasks') }}
<div class="">

	<ul class="nav nav-tabs" id="client_tab">
		<li class="active"><a href="#task">All Tasks</a></li>
		<li><a href="#user">Choose User</a></li>
		<li><a href="#status">Change Status</a></li>
	</ul>

	<div class="tab-content">
		@include('client.tabs.mytask')
		@include('client.tabs.joined')
		@include('client.tabs.status') 
	</div>

</div>
@endsection