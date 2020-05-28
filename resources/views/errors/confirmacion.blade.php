@if( Session::has('mensaje-confirmar') )
	<div class="text-center alert alert-success fade show" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
		{{ Session::get('mensaje-confirmar') }}
	</div>		
@endif