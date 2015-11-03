@extends('app')

@section('content')
<h1>Create New Project</h1>
{!! Form::open(['action' =>'ProjectController@index']) !!}

	@include('projects.partials.form', ['submitButtonText' => 'Add Project'])

{!! Form::close() !!}

@include('errors.list')

@stop