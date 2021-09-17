@extends('layout.index')

@section('content')
<div class="container">
    <u>
    <h3 class="text-uppercase h3 text-center mb-5">Soumettre son rapport de stage ou faire un renouvellement</h3>
    </u>
    <div class="row d-flex justify-content-end" style="font-size: 0.85em;">
        @if (Session()->has("updateSuccess"))
        <div class="card col-md-12">
            <div class="card-header d-flex justify-content-arround">
                <strong class="mr-auto text-success">Soumission</strong>
                <small class="text-end"> {{ date('h:m:s') }} </small>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body m-0">
                {{Session()->get("updateSuccess")}}
            </div>
        </div>
        @endif
    </div>
    <div class="row d-flex justify-content-end" style="font-size: 0.85em;">
        @if (Session()->has("createSuccess"))
        <div class="card col-md-12">
            <div class="card-header d-flex justify-content-arround">
                <strong class="mr-auto text-success">Soumission</strong>
                <small class="text-end"> {{ date('h:m:s') }} </small>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body m-0">
                {{Session()->get("createSuccess")}}
            </div>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-8">
        @empty($stage)
        @if (Session()->has("update"))
                <p class="text-danger text-center">
                    {{ Session()->get("stageFalse") }}
                </p>
                @endif
            <form method='post' action="{{route('stage.verification')}}">
                <h4 class="text-center text-primary"><u>Renseignements</u></h4>
                <div class="card-body">
                  @csrf
                 <div class="form-group">
                    <label for="">Votre email d'enregistrement</label>
                    <input type="email" name="email" class="form-control" required>
                  </div>  
                <div class="form-group">
                    <label for="">Votre maitre de Stage</label>
                    <select class="form-control" id="" name="maitre_id" required>
                      <option value=""></option>
                      @foreach ($maitres as $maitre)
                      <option value="{{$maitre->id}}">{{$maitre->nom}} {{$maitre->prenom}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Service</label>
                    <select class="form-control" id="" name="service_id" required>
                      <option value=""></option>
                      @foreach ($services as $sce)
                      <option value="{{$sce->id}}">{{$sce->lib}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                @if (Session()->has("stageFalse"))
                <p class="text-danger text-center">
                    {{ Session()->get("stageFalse") }}
                </p>
                @endif
                <div class="card-footer text-center">
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                    <button type="reset" class="btn btn-danger">Annuler</button>
                  </div>
                </div>
              </form>
        </div>
        @else
            <div class="text-center">
                @if ($stage->fin < date(now()))
            <p class="text-danger font-weight-bold my-5">
                Vous n'êtes pas encore autorisé à effectuer ces actions
            </p>
            @else
            <u><h4>Résultat</h4></u>
            <ul class="text-justify">
                <li>
                    <strong>Nom :</strong> {{$stage->demande->stagiaire->nom}} {{$stage->demande->stagiaire->nom}}
                </li>
                <li>
                    <strong>Thème de stage :</strong> {{$stage->theme}} 
                </li>
                <li>
                    <strong>Poste occupé :</strong> {{$stage->titreStage}} 
                </li>
            </ul>
            <div id="link">
            <p>Il s'agit bien de vos informations?</p>
            
                <a href="{{ route('rendu-stage') }}" class="btn btn-danger">Non</a>
                <a class="btn bg-teal" onclick="document.getElementById('link').hidden = true;
                    document.getElementById('continue').hidden = false;">
                    Oui, continuer
                </a>
            </div>
            <div id="continue" hidden>
                @if ($stage->renduDoc == null)
                    <form method='post' action="{{route('stage.rendre')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="stage" value="{{$stage->id}} ">
                        <div class="form-group">
                            <label for="" class="">Votre rapport de stage</label>
                        <input type="file" name="renduDoc" id="fic" class="form-control" required>
                    </div>
                        <input type="submit" class="btn border" value="Soumettre">
                    </form>
                @else
                    <form action="{{route('renouveler.create')}}" method="post">
                        @csrf
                        <input type="hidden" name="stagiaire_id" value="{{$stage->demande->stagiaire_id}}">
                        <input type="hidden" name="demande_id" value="{{$stage->demande_id}}">
                        <button type="submit" class="bg-teal btn"> Renouvellez votre demande</button>
                    </form>
                @endif
                <a href="{{ route('rendu-stage') }}" class="btn btn-danger mt-3">Annuler</a>
            </div>
            @endif
            </div>
        @endempty
    </div>
</div>
</div>
@endsection