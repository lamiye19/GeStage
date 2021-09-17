
@if ($demande->statut == "refus")

{{-- Formulaire de Rendez-vous --}}
<form id="attente-{{$demande->id}}"
  action="{{ route('demande.update', ['demande'=>$demande->id, 'status'=>'attente']) }}" method="post">
  @csrf
  <input type="hidden" name="_method" value="put">
  <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="fas fa-calendar-alt"></i>
        </span>
      </div>
      <input type="datetime-local" name="dateHeure" value="{{now()}}" class="" required>
  </div>
@foreach ($errors->all() as $error)
<small class="text-danger"> {{ $error }} </small>
@endforeach
  <button type="submit" class="btn btn-info">Donner un RDV</button>
</form>

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
{{-- Formulaire de Rendez-vous --}}
<form id="attente-{{$demande->id}}"
    action="{{ route('demande.update', ['demande'=>$demande->id, 'status'=>'attente']) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="put">
    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="fas fa-calendar-alt"></i>
          </span>
        </div>
        <input type="datetime-local" name="dateHeure" value="{{now()}}" class="" required>
    </div>
    <button type="submit" class="btn btn-info">Donner un RDV</button>
</form>
@endif
{{-- @isset($errors)
  @php
    echo "<script>alert('$errors->first')</script>";
  @endphp
@endisset --}}
  

{{-- Formulaire de refus --}}
<form id="refus-{{$demande->id}}" action="{{ route('demande.update', ['demande'=>$demande->id, 'status'=>'refus']) }}"
    method="post">
    @csrf
    <input type="hidden" name="_method" value="put">
</form>