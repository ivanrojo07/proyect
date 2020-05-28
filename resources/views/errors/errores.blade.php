@if( Session::has('mensaje-error') )
	<!--div class="text-center alert alert-danger fade show" role="alert">
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
  	</button>
	{{-- Session::get('mensaje-error') --}}
	</div-->
	<div class="alert1 alert-danger fade show" role="alert" style="height: 34px;margin-top: -30px; border-radius: 0px 0px 10px 10px;padding-top: -1px;">
  		<!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
  		</button>-->
		<label style="font: 12.5px arial;margin-top: 3px">{{ Session::get('mensaje-error') }}</label>
	</div>			
@endif