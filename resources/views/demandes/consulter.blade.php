<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{mix("css/app.css")}}">
    @livewireStyles

</head>

<body>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row justify-content-between m-2">
                <h1 class="font-weight-bold">CV Générique</h1>
                <div class="h-0 m-2">
                    @include('demandes.responseLink')
                    <div class="">
                        <a href="{{route('demandes')}}" class="mt-2">Retour à la liste des demandes</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="/users-icons/{{$demande->stagiaire->sexe}}.jpeg"
                                    alt="{{$demande->stagiaire->sexe}}">

                            </div>

                            <h3 class="profile-username text-center">{{$demande->stagiaire->nom}} {{$demande->stagiaire->prenom}}</h3>

                            <p class="text-muted text-center">{{$demande->specialite}}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">A propos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="">
                                <strong><i class="fas fa-birthday-cake mr-1"></i></strong>  {{ date('d - m - Y', strtotime($demande->stagiaire->dateNais))}}
                            </p>
                            <p class="">
                                <strong><i class="fas fa-phone mr-1"></i></strong> <a href="">{{$demande->stagiaire->tel}}</a>
                            </p>
                            <p class="">
                                <strong><i class="far fa-envelope mr-1"></i></strong> <a href="">{{$demande->stagiaire->email}}</a>
                            </p>
                            <hr>

                            <strong><i class="fas fa-university mr-1"></i> Centre de formation</strong>
                            <p class="text-muted">{{$demande->stagiaire->ecole}}</p>
                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Adresse</strong>
                            <p class="text-muted">{{$demande->stagiaire->adr}}</p>
                            <hr>

                            <strong><i class="fas fa-language mr-1"></i> Langues</strong>
                            <p class="text-muted">{{$demande->langues}}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-gradient-success">
                                        <i class="fas fa-briefcase mr-2"></i> Expériences professionnelle
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                @for ($i = 1; $i < 4; $i++)
                                    <!-- timeline item -->
                                    <div>
                                        @php
                                        $a="expDate".$i;
                                        $b="expTitre".$i;
                                        $c="exp".$i;
                                        @endphp
                                        <i class="fas border-secondary"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="">{{$demande->$a}}</a>
                                                {{$demande->$b}}</h3>
                                            <div class="timeline-body">
                                                {{$demande->$c}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                @endfor
                            </div>

                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-fuchsia">
                                        <i class="fas fa-book mr-1"></i> Formations et Etudes
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                
                                @for ($i = 1; $i < 4; $i++)
                                <!-- timeline item -->
                                <div>
                                    @php
                                    $a="pDate".$i;
                                    $b="pTitre".$i;
                                    $c="p".$i;
                                    @endphp
                                    <i class="fas border-secondary"></i>

                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">{{$demande->$a}}</a> {{$demande->$b}}</h3>

                                        <div class="timeline-body">
                                            {{$demande->$c}}
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                            <!-- END timeline item -->

                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-gradient-info">
                                        <i class="fas fa-pencil-ruler mr-2"></i> Compétences
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas border-secondary"></i>
                                    <div class="timeline-item">
                                        <div class="timeline-body">
                                            <p class="text-muted">
                                                {{$demande->competences}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-gradient-secondary">
                                        <i class="fas fa-heartbeat mr-2"></i> Centre d'intérêt
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas border-secondary"></i>
                                    <div class="timeline-item">
                                        <div class="timeline-body">
                                            <p>{{$demande->hobbies}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                        </div><!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <div class="card-footer text-center">
        
    </div>
    <script src="{{mix('js/app.js')}}"></script>

</body>

</html>

{{-- @extends("layout.master")

@section("contenu")
  <livewire:counter/>
@endsection --}}