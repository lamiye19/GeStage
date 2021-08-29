@extends("layout.master")

@section("titre")
Liste des stagiaires
@endsection

@section("contenu")
<div class="card">
    <div class="card-header">
        <div class="row justify-content-between d-flex">
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
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
                    <th class="text-blue">({{ count($demandes) }}) </th>
                    <th>Nom et Prénoms</th>
                    <th>Sexe</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Date de Naissance</th>
                    <th>Ecole</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demandes as $demande)
                <tr>
                    <td>
                        <img class="img-sm img-circle bg-white"
                            src="/users-icons/{{$demande->stagiaire->sexe}}.jpeg"
                            alt="Icone">
                    </td>
                    <td>{{ $demande->stagiaire->nom }} {{ $demande->stagiaire->prenom }}</td>
                    <td>{{ $demande->stagiaire->sexe }}</td>
                    <td>{{ $demande->stagiaire->tel }}</td>
                    <td>{{ $demande->stagiaire->email }}</td>
                    <td>{{ date('d - m - Y', strtotime($demande->stagiaire->dateNais))}}</td>
                    <td>{{ $demande->stagiaire->adr }}</td>
                    <td>{{ $demande->stagiaire->ecole }}</td>
                    <th>
                        <a href="{{ route('consulter-demande', ['demande'=>$demande->id]) }}" target="_blank">CV</a>
                    </th>
                </tr>
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