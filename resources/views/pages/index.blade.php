@extends('app')


@section('content')
<div class="tc">
	<div class="header">
		<img class="left" src="{{ config('printer.imagePath')['Logo'] }}" width="100"/>

		<h2>F4H TicketConverter </h2>
	</div>
	@if(Session::has('flash_message'))
		<div class="alert alert-success">
			{{Session::get('flash_message')}}
		</div>
	@endif
	
	@if(Session::has('error_message'))
		<strong> {{ config('jira.baseErrorMessage') }}</strong>
		<div class="alert alert-warning">
			{{Session::get('error_message')}}
		</div>
	@endif

	{!! Form::open(['action' =>'IndexController@confirmation']) !!}

	{!! Form::select('project', $projects, $projects->first()) !!}

	<div class="form-group">
		{!! Form::label('tickets', 'Tickets:')!!}
		{!! Form::textarea('tickets',null,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Print Tickets', ['class' => 'btn, btn-primary form-control']) !!}
	</div>

	{!! Form::close() !!}
	
	<p>
    	<a href="{{ action('ProjectController@index')}}" class="btn btn-primary" role="button">Manage Projects</a>
    </p>
</div>
@stop