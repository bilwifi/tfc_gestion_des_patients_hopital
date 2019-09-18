@extends('layouts.master')
@inject('services','\App\Models\Service')
@section('content')
<div class="d-flex justify-content-center bg-transparent">
	<div class="card " style="border-radius: 30px;">
		<div class="card-body t" >
			@if (session()->has('message'))
				<div class="alert alert-danger">
				 	{{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> --}}
				 	{!! session()->get('message') !!}
				</div>

			@endif
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="list-unstyled">
						@foreach ($errors->all() as $error)
							<li>{!! $error !!}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form class="text-center" method ="POST">
				@csrf
			  <div class="form-group">
			    <label for="num_fiche">N° Fiche</label><br>
			    <input type="text" class="form-control-lg" id="num_fiche" aria-describedby="emailHelp" placeholder="N° du Fiche" name="num_fiche">
			    <small id="emailHelp" class="form-text text-muted">Veillez saisir votre numero de fiche</small>
			  </div>
			  <div class="form-group">
			    <label for="idservice">Service</label>
			    <select class="form-control" id="idservice" name="idservices">
			    	@foreach($services->get() as $s)
			      		<option value="{{ $s->idservices }}">{{ $s->lib }}</option>
			    	@endforeach
			    </select>
			  </div>
			  <button type="submit" class="btn btn-primary">Valider</button>
			</form>
		</div>		
	</div>
</div>

@endsection