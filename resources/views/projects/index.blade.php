@extends('app')

@section('content')
	<h1>Projects</h1>
	<hr>
	@foreach ($projects as $project)
	<project>
		<h2>
			<a href="{{ action('ProjectController@show', [$project->id])}}">{{$project->name}}</a>
		</h2>
	</project>
	@endforeach
@stop