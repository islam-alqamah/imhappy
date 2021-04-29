@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')

		<h4 class="secondary"><strong>Hello,</strong></h4>
		<p>You have been invited to join team {{$team->name}}.<br>
            Click here to join: <a href="{{route('teams.accept_invite', $invite->accept_token)}}">{{route('teams.accept_invite', $invite->accept_token)}}</a></p>

	@include('beautymail::templates.widgets.articleEnd')

@stop