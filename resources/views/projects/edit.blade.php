@extends('app')

@section('content')
	<h1>Project:  {!! $project->name !!}</h1>

{!! Form::model($project,['method' =>'Patch','action' => ['ProjectController@update', $project->id]]) !!}

	@include('projects.partials.form', ['submitButtonText' => 'Edit Project'])

{!! Form::close() !!}

	@include('errors.list')

@stop