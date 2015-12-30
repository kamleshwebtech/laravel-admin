@extends('admin.layouts.dashboard')

@include('partials.macros')

@section('template_title')
	Showing User {{ $user->name }}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
	 <div class="content-wrapper">
	    <section class="content-header">
			<h1>Showing {{ $user->name }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('users') }}"><i class="fa fa-users"></i> Users</a></li>
                <li class="active">{{ $user->name }}</li>
            </ol>
	    </section>
	    <section class="content">

			<ul>
				<li><a href="{{ URL::to('users/create') }}">Create a User</a>
			</ul>



			<div class="jumbotron text-center">
				<h2>{{ $user->name }}</h2>
				<p>
					<strong>Email:</strong> {{ $user->email }}<br>
				</p>
			</div>


	    </section>
	</div>
@endsection

@section('template_scripts')

    @include('admin.structure.dashboard-scripts')


@endsection