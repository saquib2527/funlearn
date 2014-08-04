@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="center test-topic col-md-8">
			<h2>Test on {{ $category->name }}</h2>
			<p>{{ $category->description }}</p>
		</div>
	</div>
	<div class="row">
		<div class="rules col-md-8 center">
			<h3>Rules</h3>
			<ul class="list-group">
				<li class="list-group-item">A test consists of {{ NUMBER_OF_QUESTIONS }} questions.</li>
				<li class="list-group-item">All are Multiple Choice Questions.</li>
				<li class="list-group-item">You can take as much time as you want.</li>
				<li class="list-group-item">The amount of points earned is a function of time taken and correct answers.</li>
				<li class="list-group-item">There are no penalties for wrong answer.</li>
			</ul>
			{{ HTML::link('tests/attend', 'Give Test', ['class' => 'give-test btn btn-success']) }}
		</div>
	</div>
</div>
@stop
