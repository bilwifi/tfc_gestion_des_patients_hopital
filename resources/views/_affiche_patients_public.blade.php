<div style="position: relative;overflow-y: scroll; max-height: 400px" >
	@foreach($patients as $p)
	<button type="button" class="btn btn-success btn-lg btn-block {{ $p->statut == 'en_cours' ? 'en_cours ' : 'disabled' }}" style="border-radius: 50px;">
		<h4>{{ $p->num_fiche }}</h4>
          <small>
          	{{ $p->prenom .' '. $p->nom}}
          	<br>
          	{{ $p->lib}}
          </small>
	</button>
	<br>
	@endforeach
</div>