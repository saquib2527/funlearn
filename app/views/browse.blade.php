@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<h1 class="page-heading">Available Topics</h1>
		<table class="table table-striped table-hover">
			@foreach($categories as $category)
				<tr>
					<td>{{ ucwords($category->name) }}</td>
					<td class="text-right">{{ HTML::link('tests/view/' . Str::slug($category->name), 'give test', ['class' => 'btn btn-sm btn-success give-test']) }}</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@stop
