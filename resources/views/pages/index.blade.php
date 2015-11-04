@extends('app')


@section('content')
<div class="tc">
	<div class="header">
		<img class="left" src="images/logo.gif" width="100"/>

		<h2>F4H TicketConverter <span>1.0</span></h2>
	</div>
	@if(Session::has('flash_message'))
		<div class="alert alert-success">
			{{Session::get('flash_message')}}
		</div>
	@endif

	{{--@if(Session::has('errors'))--}}
		{{--<div class="alert alert-warning">--}}
			{{--<span>Following Tickets could not be printed: </span>--}}
			{{--@foreach(Session::get('errors') as $error)--}}
				{{--{{ $error }}--}}
			{{--@endforeach--}}
		{{--</div>--}}
	{{--@endif--}}

	{!! Form::open(['action' =>'IndexController@confirmation']) !!}

	{!! Form::select('project', $projects, $projects->first()) !!}

	<div class="form-group">
		{!! Form::label('ticket', 'Tickets:')!!}
		{!! Form::textarea('ticket',null,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Print Tickets',null,['class' => 'btn, btn-primary form-control']) !!}
	</div>


	{!! Form::close() !!}
	
</div>
@stop