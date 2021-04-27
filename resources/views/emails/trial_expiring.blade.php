@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')

		<h4 class="secondary"><strong>{{ __('Hello') }},</strong></h4>
		<p>{{ __('This is an email to tell you that your trial will expire soon') }}</p>

	@include('beautymail::templates.widgets.articleEnd')


	@include('beautymail::templates.widgets.newfeatureStart')
		<p>{{ __('Please login to your account to subscribe to a plan.') }}</p>

	@include('beautymail::templates.widgets.newfeatureEnd')

@stop