@extends('admin.layouts.dashboard')

@include('partials.macros')

@section('template_title')
	Edit your profile
@endsection

@section('template_fastload_css')
@endsection

@section('content')
	 <div class="content-wrapper">
	    <section class="content-header">
			<h1>
				{{ Lang::get('profile.editProfileTitle',['username' => $displayusername] ) }}
				<small> {{ Lang::get('pages.dashboard-access-level',['access' => $access] ) }} </small>
			</h1>

            {!! Breadcrumbs::render('profile_edit', $user) !!}

	    </section>
	    <section class="content">
			<div class="row">

				{{-- LEFT/TOP COLUMN --}}
				<div class="col-lg-8 col-md-12 col-sm-12">
					@if ($user->profile)
						@if (Auth::user()->id == $user->id)
							@include('admin.partials.return-callouts')
							@include('admin.modules.profile-image-box')
							@include('admin.forms.edit-profile-form')
						@else
							<p>{{ Lang::get('profile.notYourProfile') }}</p>
						@endif
					@else
						<p>{{ Lang::get('profile.noProfileYet') }}</p>
						{!! HTML::link(url('/profile/'.Auth::user()->name.'/edit'), Lang::get('titles.createProfile')) !!}
					@endif
				</div>

			    {{-- RIGHT/BOTTOM COLUMN --}}
			    <div class="col-lg-4 col-md-12 col-sm-12">
			    	@include('admin.modules.profile-basics')
			    	@include('admin.modules.profile-about')
			    </div>

			</div>
	    </section>
	</div>

	@include('admin.modals.confirm-save')

@endsection

@section('template_scripts')

	@include('admin.structure.dashboard-scripts')

	{!! HTML::script('//maps.googleapis.com/maps/api/js?libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}

	<script type="text/javascript">

	    //FUNCTION TO ASSIST WITH AUTO ADDRESS INPUT USING GOOGLE MAPS API3
	    //<![CDATA[
	    window.onload=function(){
	        if(document.getElementById("location"))
	        {
	            var input = document.getElementById('location');
	            var options; // = {componentRestrictions: {country: 'us'}};
	            var autocomplete = new google.maps.places.Autocomplete(input, options);
	        }
	     }//]]>

		// MODEL SAVE CONFIRMATION
		$('#confirmSave').on('show.bs.modal', function (e) {
			var message = $(e.relatedTarget).attr('data-message');
			var title = $(e.relatedTarget).attr('data-title');
			var form = $(e.relatedTarget).closest('form');
			$(this).find('.modal-body p').text(message);
			$(this).find('.modal-title').text(title);
			$(this).find('.modal-footer #confirm').data('form', form);
		});

		$('#confirmSave').find('.modal-footer #confirm').on('click', function(){
		  	$(this).data('form').submit();
		});
	</script>

@endsection
