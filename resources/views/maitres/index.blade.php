@extends("layout.master")

@section("titre")
Liste des maitres de stage <span class="text-primary">( {{ count($maitres) }} )</span>
@endsection

@section("contenu")
<div class="row d-flex justify-content-end" style="font-size: 0.85em;">
    @if(session()->has("deleteSuccess"))
    <div class="card col-md-5">
        <div class="card-header d-flex justify-content-arround">
            <strong class="mr-auto text-danger">Suppression</strong>
            <small class="text-end"> {{ date('H:m:s') }} </small>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body m-0">
            {{Session()->get("deleteSuccess")}}
        </div>
    </div>
    @endif
</div>

<div class="card ">
    <div class="card-header">
        <div class="row justify-content-between d-flex">
            <div class="card-tools">
                <form action="{{ route('maitres')}} " method="get" role="search" id="research">
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
            <a href="{{route('ajouter-maitre')}}">
                <div class="btn btn-primary">Ajouter</div>
            </a>
        </div>
    </div>
    <div class="card card-solid mb-1">
        <div class="card-body pb-0">
            <div class="row">
                @foreach ($maitres as $maitre)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted text-green border-bottom-0">
                            {{ $maitre->poste }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ $maitre->nom }} {{ $maitre->prenom }}</b></h2>
                                    <p class="text-muted text-sm">
                                        <b>Date de naissance: </b> {{ date('d/m/Y', strtotime($maitre->dateNais))}}
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small">
                                            <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                            Adresse: {{ $maitre->adr }}
                                        </li>
                                        <li class="small mt-1">
                                            <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Téléphone: {{ $maitre->tel }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="/users-icons/{{$maitre->sexe}}.jpeg" alt="avatar"
                                        class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                @if (count($maitre->stage) !=0)
                                <a href="{{ route('show-maitre', ['maitre' => $maitre->id]) }}" class="btn btn-sm btn-outline-secondary">
                                    @else
                                <a class="btn btn-sm btn-outline-secondary">
                                @endif
                                    ({{ count($maitre->stage) }} )
                                    <i class="fas fa-folder"></i>
                                </a>
                                <a href="mailto:{{ $maitre->email }}" class="btn btn-sm bg-teal">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="{{ route('maitre.update', ['maitre'=>$maitre->id]) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="far fa-edit"></i> Modifier
                                </a>
                                {{-- <a href="" onclick="if(confirm('Voulez-vous vraiment supprimer ce maitre? Les informations liés aux stages seront supprimées avec.')){
                                document.getElementById('form-{{$maitre->id}}').submit()}"
                                    class="btn btn-sm btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                <form id="form-{{$maitre->id}}"
                                    action="{{route('maitre.delete', ['maitre'=>$maitre->id])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


{{-- Utiliser un tableau --}}
{{-- <div class="card-body table-hover table-responsive p-0" style="height: 300px;">
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
<td>{{ $m    @endif
aitre->email }}</td>
<td>{{ $maitre->poste }}</td>
<td>{{ date('d/m/Y', strtotime($maitre->dateNais))}}</td>
<td>{{ $maitre->adr }}</td>
<th>
    <a href="{{ route('maitre.update', ['maitre'=>$maitre->id]) }} "><i class="far fa-edit"></i></a>
    <a href="" onclick="if(confirm('Voulez-vous vraiment supprimer ce maitre?')){
                            document.getElementById('form-{{$maitre->id}}').submit()}">
        <i class="far fa-trash-alt text-danger"></i>
    </a>
    <form id="form-{{$maitre->id}}" action="{{route('maitre.delete', ['maitre'=>$maitre->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="delete">
    </form>
</th>
</tr>
@endforeach
</tbody>
</table>
</div> --}}

<!-- /.card -->
@endsection
