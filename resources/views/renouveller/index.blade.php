<div class="table-hover table-responsive m-0">
    <table class="table table-striped table-borderless text-nowrap">
        <thead class="border-bottom">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Spécialité</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($renews as $renew)

            <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{ $renew->demande->stagiaire->nom }} {{ $renew->demande->stagiaire->prenom }}</td>
                <td>{{ $renew->demande->specialite }}</td>
                <td class="text-center">
                    @if ($renew->demande->statut == "accept")
                    <i class="fa fa-check-circle text-success"></i>
                    @elseif ($renew->demande->statut == "refus")
                    <i class="fa fa-times text-danger"></i>
                    @else
                    <i class="fa fa-clock text-warning"></i>
                    @endif
                </td>
                <th>
                    <a href="{{ route('consulter-demande', ['demande'=>$renew->demande->id]) }}"
                        target="_blank">Consulter</a>

                    @if ($renew->demande->statut == "refus")
                    <a href="{{ route('accept-demande', ['demande'=>$renew->demande->id]) }}" class="btn btn-success">
                        Accepter
                    </a>

                    @elseif ($renew->demande->statut == "attente")
                    <a href="#" class="text-danger"
                        onclick="document.getElementById('refus-{{$renew->demande->id}}').submit()">
                        Refuser
                    </a>
                    <br>
                    <a href="{{ route('accept-demande', ['demande'=>$renew->demande->id]) }}" class="btn btn-success">
                        Accepter
                    </a>
                    @endif

                    {{-- Formulaire de refus --}}
                    <form id="refus-{{$renew->demande->id}}"
                        action="{{ route('demande.update', ['demande'=>$renew->demande->id, 'status'=>'refus']) }}"
                        method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>