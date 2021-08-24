@if ($demande->statut == "refus")
<a href="#" class="btn btn-info" onclick="document.getElementById('attente-{{$demande->id}}').hidden = false;">
    Donner un RDV
</a>

@elseif ($demande->statut == "attente")
<a href="#" class="text-danger" onclick="document.getElementById('refus-{{$demande->id}}').submit()">
    Refuser
</a>
<br>
<a href="{{ route('accept-demande', ['demande'=>$demande->id]) }}" class="btn btn-success">
    Accepter
</a>
@else
<a href="#" class="text-danger" onclick="document.getElementById('refus-{{$demande->id}}').submit()">
    Refuser
  </a>
  <br>
  <a href="#" class="btn btn-info"
    onclick="document.getElementById('attente-{{$demande->id}}').hidden = false;">
    Donner un RDV
  </a>
@endif

{{-- Formulaire de Rendez-vous --}}
<form id="attente-{{$demande->id}}" hidden
    action="{{ route('demande.update', ['demande'=>$demande->id, 'status'=>'attente']) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="put">
    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="fas fa-calendar-alt"></i>
          </span>
        </div>
        <input type="date" name="date" id="date" class="" required>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="fas fa-clock"></i>
          </span>
        </div>
        <input type="time" name="heure" id="heure" class="" required>
    </div>
    <button type="submit">RDV</button>
</form>

{{-- Formulaire de refus --}}
<form id="refus-{{$demande->id}}" action="{{ route('demande.update', ['demande'=>$demande->id, 'status'=>'refus']) }}"
    method="post">
    @csrf
    <input type="hidden" name="_method" value="put">
</form>