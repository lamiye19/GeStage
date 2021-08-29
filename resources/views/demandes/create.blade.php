@extends('layout.index')

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
                            placeholder="Expert comptable">
                    </div>
                    <div class="form-group">
                        <label for="">Nom</label>
                        <input type="text" class="form-control" required name="nom" placeholder="Votre nom">
                    </div>
                    <div class="form-group">
                        <label for="">Prenom</label>
                        <input type="text" class="form-control" required name="prenom" placeholder="Votre prenom">
                    </div>
                    <div class="form-group">
                        <label for="">Sexe</label><br />
                        <input type="radio" class="" required name="sexe" value="F"> F
                        <input type="radio" class="" required name="sexe" value="M"> M
                    </div>
                    <div class="form-group">
                        <label for="">Ecole / Centre de formation de provenance</label>
                        <input type="text" class="form-control" required name="ecole" placeholder="Votre prenom">
                    </div>
                    <div class="form-group">
                        <label for="">Date de naissance</label>
                        <input type="date" class="form-control" required name="dateNais">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" required name="email"
                            placeholder="Votre email de contact">
                    </div>
                    <div class="form-group">
                        <label for="">Telephone</label>
                        <input type="tel" class="form-control" required name="tel"
                            placeholder="Votre téléphone de contact">
                    </div>
                    <div class="form-group">
                        <label for="">Adresse</label>
                        <input type="text" class="form-control" required name="adr"
                            placeholder="Votre adresse de contact">
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
                                    placeholder="2019" max="2021" min="2019"> &nbsp;
                                <input type="text" class="form-control" required name="pTitre1"
                                    placeholder="Master en Economie">
                            </div>
                            <input type="text" class="form-control mt-1" required name="p1"
                                placeholder="Institut international du marketing">
                        </div>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="number" class="form-control col-4" required name="pDate2"
                                    placeholder="2019" max="2021" min="2019"> &nbsp;
                                <input type="text" class="form-control" required name="pTitre2"
                                    placeholder="Master en Economie">
                            </div>
                            <input type="text" class="form-control mt-1" required name="p2"
                                placeholder="Institut international du marketing">
                        </div>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="number" class="form-control col-4" required name="pDate3"
                                    placeholder="2019" max="2021" min="2019"> &nbsp;
                                <input type="text" class="form-control" required name="pTitre3">
                            </div>
                            <input type="text" class="form-control mt-1" required name="p3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Expériences</label><br>
                        <small class="text-muted">Donnez vos trois dernières expériences</small> <br>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="month" class="form-control col-4" required name="expDate1"
                                    placeholder="juin 2002 - Aout 2004"> &nbsp;
                                <input type="text" class="form-control" required name="expTitre1" placeholder="Poste">
                            </div>
                            <input class="col-12 mt-1" placeholder="Description du poste" name="exp1" required>
                        </div>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="month" class="form-control col-4" required name="expDate2"
                                    placeholder="juin 2002 - Aout 2004"> &nbsp;
                                <input type="text" class="form-control" required name="expTitre2" placeholder="Poste">
                            </div>
                            <input class="col-12 mt-1" placeholder="Description du poste" name="exp2" required>
                        </div>
                        <div class="mt-3">
                            <div class="input-group">
                                <input type="month" class="form-control col-4" required name="expDate3"
                                    placeholder="juin 2002 - Aout 2004"> &nbsp;
                                <input type="text" class="form-control" required name="expTitre3">
                            </div>
                            <input class="col-12 mt-1" name="exp3" required>
                        </div>
                    </div>
                    <small class="text-muted">Veuillez séparer les éléments par des virgules</small> <br>
                    <div class="form-group mt-3">
                        <label for="">Compétences</label>
                        <input type="text" class="form-control" required name="competences"
                            placeholder="Compétence 1, Compétence 2...">
                    </div>
                    <div class="form-group">
                        <label for="">Langues</label>
                        <input type="text" class="form-control" required name="langues"
                            placeholder="Français, Anglais...">
                    </div>
                    <div class="form-group">
                        <label for="">Centres d'interêt</label>
                        <input type="text" class="form-control" required name="hobbies" placeholder="Sport, lecture...">
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