@extends("layout.master")

@section("titre")
Liste des stagiaires
@endsection

@section("contenu")
<div class="card">
    <div class="card-header">
        <div class="row justify-content-between d-flex">
            <div class="card-tools">
                @if (Auth::user()->is_admin)
                <form action="{{ route('stagiaires')}} " method="get" role="search" id="research">
                @else
                <form action="{{ route('mes-stagiaires', ['user'=>Auth::user()])}} " method="get" role="search" id="research">
                @endif
                    <div class="input-group" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search"
                    id="search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>    
                </div>

                    </form>
            </div>
            {{-- <a href="{{route('ajouter-stagiaire')}}">
            <div class="btn btn-primary">Ajouter</div>
            </a> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-hover table-responsive p-0" style="height: 300px;">
        <table class="table table-head-fixed text-nowrap text-center">
            <thead>
                <tr>
                    <th class="text-blue">({{ count($stagiaires) }}) </th>
                    <th>Nom et Prénoms</th>
                    <th>Sexe</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Date de Naissance</th>
                    <th>Adresse</th>
                    <th>Ecole</th>
                    @if (Auth::user()->is_admin)
                    <th>Nbre Stage</th>
                    @endif
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stagiaires as $stagiaire)
                @if ($stagiaire->demande->statut == 'accept')
                    
                <tr>
                    <td>
                        <img class="img-sm img-circle bg-white" src="/users-icons/{{$stagiaire->sexe}}.jpeg"
                            alt="Icone">
                    </td>
                    <td>{{ $stagiaire->nom }} {{ $stagiaire->prenom }}</td>
                    <td>{{ $stagiaire->sexe }}</td>
                    <td>{{ $stagiaire->tel }}</td>
                    <td>{{ $stagiaire->email }}</td>
                    <td>{{ date('d - m - Y', strtotime($stagiaire->dateNais))}}</td>
                    <td>{{ $stagiaire->adr }}</td>
                    <td>{{ $stagiaire->ecole }}</td>
                    @if (Auth::user()->is_admin)
                    <td>
                        {{ count($stagiaire->demande->stage) }}
                        @if (count($stagiaire->demande->stage) != 0)
                        <a href="{{ route('show-stagiaire', ['demande' => $stagiaire->demande->id]) }}"> - Voir</a>
                        @endif
                    </td>
                    @endif
                    <th>
                        <a href="{{ route('consulter-demande', ['demande'=>$stagiaire->demande->id]) }}" target="_blank">CV</a>
                    </th>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <div>
            @foreach ($errors->all() as $err)
            {{$err}}
            @endforeach
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection