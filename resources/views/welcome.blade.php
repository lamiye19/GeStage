@extends("layout.master")

@section("titre")

@endsection

@section("contenu")
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Témoin</div>
            <div class="card-body">
                Vous êtes connecté en tant que <strong class="text-success">
                    @if(Auth::user()->is_admin)
                    Administrateur
                    @else
                    Maitre de stage
                    @endif
                </strong>

                <p class="mt-3 d-flex justify-content-end">
                    Déconnectez vous en cliquant ce &nbsp;
                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        lien
                    </a>
                </p>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        @if (Auth::user()->is_admin)
        <div class="card">
            <div class="card-header">Statistiques</div>

            <div class="card-body">
                Pour cette plateforme, les statistiques réalisés sont:
                <ul>
                    <li>
                        La liste des stages effectués par un stagiaire =>
                        <a href="{{ route('stagiaires') }}"> gestion des stagiaires</a>
                    </li>
                    <li>
                        La liste des stages effectués dans un service =>
                        <a href="{{ route('services') }}"> gestion des services</a>
                    </li>
                    <li>
                        La liste des stages suivi par un maitre de stage =>
                        <a href="{{ route('maitres') }}"> gestion des maitres </a> <br>
                        <p class="small"> Référez vous à :&nbsp;
                            <a class="btn-outline-secondary btn btn-sm"> (1)<i class="fa fa-folder"></a></i>
                        </p>
                    </li>
                </ul>
                <p>Autres statistiques : </p>
                <ul>
                    <li>
                        La liste des stagiaires pour maitre de stage&nbsp;
                        <a href="#maitres" class="small text-secondary">
                            <i class="fa fa-user-graduate"></i> ->
                            <i class="fa fa-users text-primary"></i>
                        </a>
                    </li>
                    <li>
                        La liste des stagiaires pour maitre de stage dans un service donné&nbsp;
                        <a href="#maitres" class="small text-secondary">
                            <i class="fa fa-user-graduate"></i> ->
                            <i class="fa fa-building"></i>(
                            <i class="fa fa-users text-primary"></i> )
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Paramètres pour les autres statistiques</div>
            <div class="card-body">
                <ul>
                    <li>
                        La liste des stagiaires pour maitre de stage&nbsp;
                        <a href="#maitres" class="small text-secondary">
                            <i class="fa fa-user-graduate"></i> ->
                            <i class="fa fa-users text-primary"></i>
                        </a>

                        <form class="mt-3" action="{{ route('maitre-stagiaire')}}" method="post" class="">
                            @csrf
                            <div class="form-group">
                                <label for="">Maitre de Stage</label>
                                <select class="form-control" id="" name="maitre_id">
                                    <option value=""></option>
                                    @foreach ($maitres as $maitre)
                                    <option value="{{$maitre->id}}">{{$maitre->nom}} {{$maitre->prenom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn border">Consulter</button>
                            </div>
                        </form>
                        @if (Session()->has('message'))
                        <p class="text-center">
                            <i class="far fa-frown"></i>
                            {{ Session()->get('message') }}
                        </p>
                        @endif
                    </li>
                    <li>
                        La liste des stagiaires pour maitre de stage dans un service donné&nbsp;
                        <a href="#maitres" class="small text-secondary">
                            <i class="fa fa-user-graduate"></i> ->
                            <i class="fa fa-building"></i>(
                            <i class="fa fa-users text-primary"></i> )
                        </a>
                        <form class="mt-3" action="{{ route('maitre-service-stagiaire')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Maitre de Stage</label>
                                    <select class="form-control" id="" name="maitre_id">
                                        <option value=""></option>
                                        @foreach ($maitres as $maitre)
                                        <option value="{{$maitre->id}}">{{$maitre->nom}} {{$maitre->prenom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Service</label>
                                    <select class="form-control" id="" name="service_id">
                                        <option value=""></option>
                                        @foreach ($services as $sce)
                                        <option value="{{$sce->id}}">{{$sce->lib}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn border">Consulter</button>
                            </div>
                        </form>
                        @if (Session()->has('messageService'))
                        <p class="text-center">
                            <i class="far fa-frown"></i>
                            {{ Session()->get('messageService') }}
                        </p>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-header">Mes Statistiques</div>
            <div class="card-body">
                <ul>
                    <li>
                        La liste de mes stagiaires&nbsp;
                        <a href="#maitres" class="small text-secondary">
                            <i class="fa fa-user-graduate"></i> ->
                            <i class="fa fa-users text-primary"></i>
                        </a>
                        <form class="mt-3" action="{{ route('maitre-stagiaire')}}" method="post">
                            @csrf
                            <input type="hidden" name="maitre_id"
                                value="{{$maitres->where('email',Auth::user()->email)->first()->id}}">
                            <div class="form-group text-center mt-2">
                                <button type="submit" class="btn border">Consulter</button>
                            </div>
                        </form>
                        @if (Session()->has('message'))
                        <p class="text-center">
                            <i class="far fa-frown"></i>
                            {{ Session()->get('message') }}
                        </p>
                        @endif
                    </li>
                    <li>
                        La liste de mes stagiaires dans un service donné&nbsp;
                        <a href="#maitres" class="small text-secondary">
                            <i class="fa fa-user-graduate"></i> ->
                            <i class="fa fa-building"></i>(
                            <i class="fa fa-users text-primary"></i> )
                        </a>
                        <form class="mt-3" action="{{ route('maitre-service-stagiaire')}}" method="post">
                            @csrf
                            <input type="hidden" name="maitre_id"
                                value="{{$maitres->where('email',Auth::user()->email)->first()->id}}">
                            <div class="form-group">
                                <label for="">Service</label>
                                <select class="form-control" id="" name="service_id">
                                    <option value=""></option>
                                    @foreach ($services as $sce)
                                    <option value="{{$sce->id}}">{{$sce->lib}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn border">Consulter</button>
                            </div>
                        </form>
                        @if (Session()->has('messageService'))
                        <p class="text-center">
                            <i class="far fa-frown"></i>
                            {{ Session()->get('messageService') }}
                        </p>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        @endif


    </div>
</div>
@endsection