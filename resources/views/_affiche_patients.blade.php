<script type="text/javascript">
      function ajax_link(links){
          $.ajax({
              type: 'get',
              url: links,
              success: function(data) {
                  getPage(location.href);
                  
              },
              error:function(data) {
                  var errors = data.responseJSON.errors;
                    $.each(errors, function (key, value) {
                      document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
                      $('#msgErrors').removeAttr('hidden');
                  });
              }
        });
      }
    
    </script>
<div class=" text-center card-footer" style="margin-top: -20px">
  ({{ $patients->count() }}) Patients en attente ...
</div>
@foreach($patients as $p)
  
  <div class="card bg-dark">
      <div class="card-body row">
          <div class="col-8">
            <table class="table table-striped">
            <tbody>
              <tr>
                <th scope="row">N° FICHE</th>
                <td>{{ $p->num_fiche }}</td>
              </tr>
              <tr>
                <th scope="row">Nom</th>
                <td>{{ $p->nom }}</td>
              </tr>
              {{-- <tr>
                <th scope="row">Postom</th>
                <td>{{ $p->postnom }}</td>
              </tr> --}}
              <tr>
                <th scope="row">Prenom</th>
                <td>{{ $p->prenom }}</td>
              </tr>
              <tr>
                <th scope="row">Heure</th>
                <td>{{ $p->created_at }}</td>
              </tr>
          </table>
          </div>
          @php
                $btn_traiter = '<a href="'.route('traiter_patient',$p->idpatients).'" class="btn-a btn btn-success btn-block" onclick="event.preventDefault(); ajax_link(this.href)" >TRAITER</a>';
                $btn_appeler = '<a href="'.route('appeler_patient',$p->idpatients).'" class="btn-a btn btn-primary btn-block" onclick="event.preventDefault(); ajax_link(this.href)" >APPELER</a>';
                $btn_rappeler = '<button id="rappeler_btn"class="btn-rappeler btn btn-primary btn-block">RAPPELER</button>';
                $btn_passer = '<a href="'.route('passer_patient',$p->idpatients).'" class="btn-a btn btn-danger btn-block" onclick="event.preventDefault(); ajax_link(this.href)">PASSER</a>';
                @endphp
          <div class="col-4 ">
              <div class="justify-content-center">
                
                  @if($p->statut == "en_cours")
                  {!! $btn_traiter !!}
                  {!! $btn_rappeler !!}
                  {!! $btn_passer !!}
                  @else
                  {!! $btn_appeler !!}
                  {!! $btn_passer !!}
                  @endif
                  
              </div>        
          </div>
      </div>
  </div>
  <br>
  @endforeach
