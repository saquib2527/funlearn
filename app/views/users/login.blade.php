@extends('layouts.master')

@section('content')
<div id="login-panel" class="center col-md-6">
	<div class="panel">
		<div class="panel-heading"><h3>Login</h3></div>
		<div class="panel-body">
			{{ Form::open() }}
			<div class="input-group input-group-lg">
				<span class="input-group-addon glyphicon glyphicon-envelope"></span>
				{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
			</div>
			<div class="input-group input-group-lg">
				<span class="input-group-addon glyphicon glyphicon-wrench"></span>
				{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
			</div>
			{{ Form::submit('Submit', ['class' => 'btn btn-lg btn-block']) }}
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop
