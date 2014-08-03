<!DOCTYPE html>
<html lang="en">
	@include('layouts.head')
<body>

	<div class="nav-only">
		<div class="container">
			@include('layouts.nav')
		</div>
	</div>

	@yield('content')

	@include('layouts.footer')

</body>
</html>
