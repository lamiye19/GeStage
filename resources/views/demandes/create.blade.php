@extends('layout.index')

@section('headTitle')
Demande de stage
@endsection

{{-- <div id="toastsContainerTopRight" class="toasts-top-right fixed">
    <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header"><i class="mr-2 fas fa-envelope fa-lg"></i><strong class="mr-auto">Toast
                Title</strong><small>Subtitle</small><button data-dismiss="toast" type="button" class="ml-2 mb-1 close"
                aria-label="Close"><span aria-hidden="true">×</span></button></div>
        <div class="toast-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</div>
    </div>
</div> --}}


@section('content')
<div class="container">
    <h1 class="text-uppercase h2 text-center mb-2">Formulaire de demande de stage</h1>

    <div class="row d-flex justify-content-end" style="font-size: 0.85em;">
        @if (Session()->has("createSuccess"))
        <div class="card col-md-12">
            <div class="card-header d-flex justify-content-arround">
                <strong class="mr-auto text-success">Création</strong>
                <small class="text-end"> {{ date('H:m:s') }} </small>
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
    <form method='post' action="{{route('demande.create')}}" class="row">
        <div class="col-md-4">
            <div class="card card-primary h-100">
                <div class="card-header">
                    <h5 class="font-weight-bold">A Propos de vous</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Specialite</label>
                        <input type="text" class="form-control" required name="specialite"
                            placeholder="Expert comptable" value="{{ old('specialite') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Nom</label>
                        <input type="text" class="form-control" required name="nom" placeholder="Votre nom"
                        value="{{ old('nom') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Prenom</label>
                        <input type="text" class="form-control" required name="prenom" placeholder="Votre prenom"
                        value="{{ old('prenom') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Sexe</label><br />
                        <input type="radio" class="" required name="sexe" value="F"> F
                        <input type="radio" class="" required name="sexe" value="M"> M
                    </div>
                    <div class="form-group">
                        <label for="">Ecole / Centre de formation de provenance</label>
                        <input type="text" class="form-control" required name="ecole" placeholder="Votre prenom"
                        value="{{ old('ecole') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Date de naissance</label>
                        <input type="date" class="form-control" required max="{{ date('Y',strtotime(now()))-18 }}-12-31" 
                            name="dateNais" value="{{ old('dateNais') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" required name="email" placeholder="Votre email de contact" 
                        pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ex: test@gmail.com" value="{{ old('email') }}">
                        @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>Vous avez déja soummis une demande de stage avec cet email.</strong>
            </span>
            @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Téléphone</label>
                        <input type="tel" class="form-control" required name="tel" placeholder="Ex:90064578" 
                        pattern="[79]{1}[01236789]{1}[0-9]{6}" title="Veuillez entrer un numéro de téléphone valide" value="{{ old('tel') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Adresse</label>
                        <input type="text" class="form-control" required name="adr"
                            placeholder="Votre adresse de contact" value="{{ old('adr') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-fuchsia">
                <div class="card-header">
                    <h5 class="font-weight-bold">Informations Complémentaires</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Parcours</label><br>
                        <small class="text-muted">Donnez vos trois derniers formations ou diplômes</small>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="number" class="form-control col-4" required name="pDate1"
                                    placeholder="2017" max="2021" min="2017" value="{{ old('pDate1') }}"> &nbsp;
                                <input type="text" class="form-control" required name="pTitre1"
                                    placeholder="Master en Economie" value="{{ old('pTitre') }}">
                            </div>
                            <input type="text" class="form-control mt-1" required name="p1"
                                placeholder="Institut international du marketing" value="{{ old('p1') }}">
                        </div>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="number" class="form-control col-4" required name="pDate2"
                                    placeholder="2017" max="2021" min="2017" value="{{ old('pDate2') }}"> &nbsp;
                                <input type="text" class="form-control" required name="pTitre2"
                                    placeholder="Master en Economie" value="{{ old('pTitre2') }}">
                            </div>
                            <input type="text" class="form-control mt-1" required name="p2"
                                placeholder="Institut international du marketing" value="{{ old('p2') }}">
                        </div>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="number" class="form-control col-4" required name="pDate3"
                                    pattern="[79]{1}[01236789]{1}[0-9]{6}" max="2021" min="2017" value="{{ old('pDate3') }}"> &nbsp;
                                <input type="text" class="form-control" required name="pTitre3" value="{{ old('pTitre3') }}">
                            </div>
                            <input type="text" class="form-control mt-1" required name="p3" value="{{ old('p3') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Expériences</label><br>
                        <small class="text-muted">Donnez vos trois dernières expériences</small> <br>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="text" class="form-control col-4" required name="expDate1"
                                    placeholder="juin 2002 - Aout 2004" value="{{ old('expDate1') }}"> &nbsp;
                                <input type="text" class="form-control" required name="expTitre1" placeholder="Poste" value="{{ old('expTitre1') }}">
                            </div>
                            <input class="col-12 mt-1" placeholder="Description du poste" name="exp1" required value="{{ old('exp1') }}">
                        </div>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="text" class="form-control col-4" required name="expDate2"
                                    placeholder="juin 2002 - Aout 2004" value="{{ old('expDate2') }}"> &nbsp;
                                <input type="text" class="form-control" required name="expTitre2" placeholder="Poste" value="{{ old('expTitre2') }}">
                            </div>
                            <input class="col-12 mt-1" placeholder="Description du poste" name="exp2" required value="{{ old('exp2') }}">
                        </div>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="text" class="form-control col-4" required name="expDate3"
                                    placeholder="juin 2002 - Aout 2004" value="{{ old('expDate3') }}"> &nbsp;
                                <input type="text" class="form-control" required name="expTitre3" value="{{ old('expTitre3') }}">
                            </div>
                            <input class="col-12 mt-1" name="exp3" required value="{{ old('exp3') }}">
                        </div>
                    </div>
                    <small class="text-muted">Veuillez séparer les éléments par des virgules</small> <br>
                    <div class="form-group mt-3">
                        <label for="">Compétences</label>
                        <input type="text" class="form-control" required name="competences"
                            placeholder="Compétence 1, Compétence 2..." value="{{ old('competences') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Langues</label>
                        <input type="text" class="form-control" required name="langues"
                            placeholder="Français, Anglais..." value="{{ old('langues') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Centres d'interêt</label>
                        <input type="text" class="form-control" required name="hobbies" 
                            placeholder="Sport, lecture..." value="{{ old('hobbies') }}">
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card -->
        @csrf
        <div class="text-center col-12">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-danger">Annuler</button>
            </div>
            <div class="mt-3">
                <a type="reset" href="{{route('demandes')}}" class="">Retour à la liste des demandes</a>
            </div>
        </div>
    </form>
</div>
</div>
@endsection