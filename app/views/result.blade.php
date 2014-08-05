@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row col-md-8 center">
		<div class="result">
			<table class="table table-striped table-hover">
				<tr>
					<td>number of correct answers</td>
					<td class="text-right"><span class="text-success">{{ $num_correct_answer }}</span></td>
				</tr>
				<tr>
					<td>number of incorrect answers</td>
					<td class="text-right"><span class="text-danger">{{ $num_incorrect_answer }}</span></td>
				</tr>
				<tr>
					<td>number of untouched questions</td>
					<td class="text-right"><span class="text-warning">{{ $num_untouched }}</span></td>
				</tr>
				<tr>
					<td>points earned</td>
					<td class="text-right"><span class="text-primary">{{ $points_earned }}</span></td>
				</tr>
				<tr>
					<td>previous stats</td>
					<td class="text-right"><span>Level {{ $previous_rank }}</span> / <span>Points {{ $previous_points }}</span></td>
				</tr>
				<tr>
					<td>current stats</td>
					<td class="text-right"><span>Level {{ $current_rank }}</span> / <span>Points {{ $current_points }}</span></td>
				</tr>
			</table>
		</div>
		<div class="details">
			@foreach($questions as $question)
				<div class="panel panel-default">
					<div class="panel-heading">
							{{ $question->question }}
					</div>
					<div class="panel-body">
						<p class="text-success">correct answer: {{ $question->{'opt' . $question->answer} }}</p>
						@if(isset($answers[$question->id]))
						<p @if($answers[$question->id] == $question->answer) class="text-success"  @else class="text-danger" @endif>
						your answer: {{ $question->{'opt' . $answers[$question->id]} }}
						</p>
						@else
						<p class="text-muted">you did not answer this question</p>
						@endif
					</div>
					<div class="panel-footer">
						<small><a href="javascript:void(0);" data-qid="{{ $question->id }}" class="text-right">[report issue]</a></small>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@stop
