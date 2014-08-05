@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row col-md-8 center">
		<div class="result">
			<p>Number of Correct Answers: <span class="text-success">{{ $num_correct_answer }}</span></p>
			<p>Number of Inorrect Answers: <span class="text-danger">{{ $num_incorrect_answer }}</span></p>
			<p>Number of Untouched Questions: <span class="text-warning">{{ $num_untouched }}</span></p>
			<p>Points Earned: <span class="text-primary">{{ $points_earned }}</span></p>
			<p>Previous stats: <span>Level {{ $previous_rank }}</span> / Points {{ $previous_points }}</p>
			<p>Current stats: <span>Level {{ $current_rank }}</span> / Points {{ $current_points }}</p>
		</div>
		<div class="details">
			@foreach($questions as $question)
				<div class="panel panel-default">
					<div class="panel-heading">{{ $question->question }}</div>
					<div class="panel-body">
						<p class="text-success">Correct answer: {{ $question->{'opt' . $question->answer} }}</p>
						@if(isset($answers[$question->id]))
						<p @if($answers[$question->id] == $question->answer) class="text-success"  @else class="text-danger" @endif>
							Your answer: {{ $answers[$question->id] }}
						</p>
						@else
						<p>You did not answer this question</p>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@stop
