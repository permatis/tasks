@extends('layouts.app')
@section('content')

<ul class="nav nav-tabs" id="moderator_tab">
	<li class="active"><a href="#moderate">Moderate New ({{ $count }})</a></li>
	<li><a href="#joined">Choose User</a></li>
	<li><a href="#status">Change Status</a></li>
</ul>

<div class="tab-content">
	@include('moderator.tabs.moderate')
	@include('moderator.tabs.joined')
	@include('moderator.tabs.status')
</div>

@endsection