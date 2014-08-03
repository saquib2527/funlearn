<nav class="navbar navbar-default" role="navigation">
<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>	
	</button>
	{{ HTML::link('/', 'Funlearn', ['class' => 'navbar-brand']) }}
</div>
<div class="collapse navbar-collapse" id="main-nav">
	<ul class="nav navbar-nav">
		<li @if($active == 'home') class="active" @endif>{{ HTML::link('/', 'Home') }}</li>
		<li @if($active == 'browse') class="active" @endif>{{ HTML::link('browse', 'Browse') }}</li>
		<li @if($active == 'about') class="active" @endif>{{ HTML::link('about', 'About') }}</li>
		@if(Auth::guest())
			<li @if($active == 'register') class="active" @endif>{{ HTML::link('users/register', 'Register') }}</li>
			<li @if($active == 'login') class="active" @endif>{{ HTML::link('users/login', 'Login') }}</li>
		@else	
			<li @if($active == 'profile') class="active" @endif>{{ HTML::link('users/profile', 'Profile') }}</li>
			@if(Auth::user()->type == 'A')
				<li @if($active == 'dashboard') class="active" @endif>{{ HTML::link('dashboard', 'Dashboard') }}</li>
			@endif
			<li @if($active == 'logout') class="active" @endif>{{ HTML::link('users/logout', 'Logout') }}</li>
		@endif
	</ul>
</div>
</nav>
