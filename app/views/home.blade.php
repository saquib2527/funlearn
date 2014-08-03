<!DOCTYPE html>
<html lang="en">
	@include('layouts.head')
	<body>

		<div class="jumbotron">
			<div class="container">
				@include('layouts.nav')

				<div class="row text-center">
					<h1>Welcome to <span>Funlearn</span>!</h1>
					<h3>test your <span>knowledge base</span> on a number of categories</h3>
					<a class="btn btn-primary btn-lg">Get Started</a>
				</div>
			</div>
		</div>
		<!--nav within a jumbotron end-->

		<!--carousel start-->
		<div class="process">
			<div class="heading">
				<div class="container">
					<div class="row">
						<div class="col-md-6 text-center"><!--mobile first, so center text-->
							<h1>Learning Process</h1>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div id="carousel-process" class="carousel slide">
						<!--indicators-->
						<ol class="carousel-indicators">
							<li data-target="#carousel-process" data-slide-to="0" class="active">Select</li>
							<li data-target="#carousel-process" data-slide-to="1">Attend</li>
							<li data-target="#carousel-process" data-slide-to="2">Achieve</li>
						</ol>
						<!--slides-->
						<div class="carousel-inner">
							<div class="item active text-center">
								<div class="col-md-6">{{ HTML::image('img/plan.png', 'plan', ['class' => 'hidden-xs']) }}</div>
								<div class="col-md-6">
									<h4>Select</h4>
									<p>
									We provide a huge number of categories to give test on. These ranges from various topics of  general knowledge to other academic topics. Take a look at our collection. Chances are, we have the topic you are looking for. Even better, you might stumble upon something you like.
									</p>
								</div>
							</div>
							<div class="item text-center">
								<div class="col-md-6">{{ HTML::image('img/plan.png', 'plan', ['class' => 'hidden-xs']) }}</div>
								<div class="col-md-6">
									<h4>Attend</h4>
									<p>
									Once you have found what you are looking for, attend the tests. There are literally thousands of questions, resulting in hundreds of random tests. You will get a detailed report of your performance after the test. You can give test on any topic you like, as many times you want. 
									</p>
								</div>
							</div>
							<div class="item text-center">
								<div class="col-md-6">{{ HTML::image('img/plan.png', 'plan', ['class' => 'hidden-xs']) }}</div>
								<div class="col-md-6">
									<h4>Achieve</h4>
									<p>
									Rank up by giving tests. As you give tests you will achieve points. Based on these points, your ranks will be determined. It's not only educative, but also quite fun! Try to achieve the highest rank possible, compare with other users, and get a competitive feelings as you push along.
									</p>
								</div>
							</div>
						</div>
						<!--no controls-->
					</div>
				</div>
			</div>
		</div>
		<!--carousel end-->

		@include('layouts.footer')

	</body>
</html>
