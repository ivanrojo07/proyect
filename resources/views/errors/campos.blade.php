@if( count($errors) > 0)
	<!--div class="alert alert-danger fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<ul>
		{{--	@foreach( $errors->all() as $error )
				<li>{!! $error !!}</li>
			@endforeach--}}
		</ul>
	</div-->	
	<div class="alert1 alert-danger fade show" role="alert" >
	<!--	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>-->
	
			@foreach( $errors->all() as $error )
				<label style="font: 12.5px arial; margin-top:3px; ">{!! $error !!}</label>
			@endforeach
		
	</div>		
@endif