@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<h1>Available Topics</h1>
		<table class="table table-striped table-hover">
			@foreach($categories as $category)
				<tr>
					<td>{{ $category->name }}</td>
					<td class="text-right">{{ HTML::link('test/' . Str::slug($category->name), 'give test', ['class' => 'btn btn-sm btn-success']) }}</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@stop
