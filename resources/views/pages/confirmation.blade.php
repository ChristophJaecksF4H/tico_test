@extends('app')


@section('content')
<div class="tc">
	<div class="header">
		<img class="left" src="images/logo.gif" width="100"/>

		<h2>F4H TicketConverter <span>1.0</span></h2>
	</div>

	{!! Form::open(['action' =>'IndexController@confirmation']) !!}

	<ul class="list-group">
	@foreach ($doubleTickets as $doubleTicket)
		<li class="list-group-item">{{ $doubleTicket->getTicketName() }} - 
			
				{!! Form::checkbox('doubleTicket ' . $doubleTicket->id, $doubleTicket->id, true); !!}
			
		</li>
		
	@endforeach
	</ul>
	<div class="form-group">
		{!! Form::submit('Print Tickets',null,['class' => 'btn, btn-primary form-control']) !!}
	</div>


	{!! Form::close() !!}
	
</div>
@stop