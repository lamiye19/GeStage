@extends("layout.master")

@section("titre")
Liste des maitres
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
            <a href="{{route('ajouter-maitre')}}">
                <div class="btn btn-primary">Ajouter</div>
            </a>
        </div>
    </div>
    @if(session()->has("deleteSuccess"))
    <div class="text-center alert-success py-1 h4">
        {{Session()->get("deleteSuccess")}}
    </div>
    @endif
    <!-- /.card-header -->
    <div class="card-body table-hover table-responsive p-0" style="height: 300px;">
        <table class="table table-head-fixed text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom et Prénoms</th>
                    <th>Sexe</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Poste</th>
                    <th>Date de Naissance</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maitres as $maitre)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $maitre->nom }} {{ $maitre->prenom }}</td>
                    <td>{{ $maitre->sexe }}</td>
                    <td>{{ $maitre->tel }}</td>
                    <td>{{ $maitre->email }}</td>
                    <td>{{ $maitre->poste }}</td>
                    <td>{{ $maitre->dateNais }}</td>
                    <td>{{ $maitre->adr }}</td>
                    <th>
                        <a href="{{ route('maitre.update', ['maitre'=>$maitre->id]) }} "><i class="far fa-edit"></i></a>
                        <a href="" onclick="if(confirm('Voulez-vous vraiment supprimer ce maitre?')){
                            document.getElementById('form-{{$maitre->id}}').submit()}">
                            <i class="far fa-trash-alt text-danger"></i>
                        </a>
                        <form id="form-{{$maitre->id}}" action="{{route('maitre.delete', ['maitre'=>$maitre->id])}}"
                            method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection