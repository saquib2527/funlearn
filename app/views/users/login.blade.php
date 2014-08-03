@extends('layouts.master')

@section('content')
<div id="login-panel" class="center col-md-6">
	<div class="panel">
		<div class="panel-heading"><h3>Login</h3></div>
		<div class="panel-body">
			<div class="input-group input-group-lg">
				<span class="input-group-addon glyphicon glyphicon-envelope"></span>
				<input type="text" class="form-control" placeholder="Email">
			</div>
			<div class="input-group input-group-lg">
				<span class="input-group-addon glyphicon glyphicon-wrench"></span>
				<input type="password" class="form-control" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-lg btn-block">Submit</button>
		</div>
	</div>
</div>
@stop
