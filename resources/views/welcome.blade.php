@extends("layout.master")

@section("titre")

@endsection

@section("contenu")
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                Vous êtes connecté en tant que <strong class="text-success">{{ Auth::user()->name }}</strong>

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
    </div>
</div>
@endsection