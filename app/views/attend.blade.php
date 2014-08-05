<!DOCTYPE html>
<html lang="en">
	@include('layouts.head')
<body style="padding-top: 65px">
	<nav class="navbar navbar-default navbar-fixed-top text-center" id="timer-nav">
		<h1 id="timer">0:00</h1>
	</nav>
	<div class="container question-container">
		<div class="row col-md-8 center">
			{{ Form::open(['id' => 'examForm']) }}
			@foreach($questions as $key=>$question)
			<div class="panel panel-default">
				<div class="panel-heading">{{ $question->question }}</div>
				<div class="panel-body">
					<div class="radio">
						<label>
							{{ Form::radio('q' . $key, 1) }}
							{{ $question->opt1 }}
						</label>
					</div>
					<div class="radio">
						<label>
							{{ Form::radio('q' . $key, 2) }}
							{{ $question->opt2 }}
						</label>
					</div>
					<div class="radio">
						<label>
							{{ Form::radio('q' . $key, 3) }}
							{{ $question->opt3 }}
						</label>
					</div>
					<div class="radio">
						<label>
							{{ Form::radio('q' . $key, 4) }}
							{{ $question->opt4 }}
						</label>
					</div>
				</div>
			</div>
			@endforeach
			{{ Form::submit('Submit Answers', ['class' => 'btn give-test btn-success btn-lg pull-right']) }}
			{{ Form::close() }}
		</div>
	</div>

	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	<script>
		function setTimer(){
			var seconds = 0;
			var minutes = 0;
			var intervalHandler = setInterval(function(){
				if(seconds == 59){
					seconds = 0;
					minutes++;
					}else{
					seconds++;
				}
				$('#timer').html(minutes + ':' + ('0' + seconds).slice(-2));
			}, 1000);
		}

		$(document).ready(function(){
			setTimer();
		});
	</script>
</body>
</html>
