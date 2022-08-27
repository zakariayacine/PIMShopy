@extends('layouts.app')

@section('content')
<style>
    .hidden {
        display: none !importation;
    }

    .activated {
        display: block;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fa-solid fa-gear"></i> Paramètres</h5>
                </div>
                <div class="card-body table-responsive">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="navutilisateur" href="#" onclick="utilisateur()">Utilisateur</a>
                        </li>
                       <!-- <li class="nav-item">
                            <a class="nav-link " id="navimportation" aria-current="page" onclick="importation()"  style="cursor: pointer !importation;">Importation</a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" id="navTinypng" href="#" onclick="tinypng()">Tinypng API</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="navcloud" href="#" onclick="cloud()">Cloud storage</a>
                        </li> --}}
                    </ul>
                    <span class="mb-2">
                    {{-- <div class="card" id="importation">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nom de la boutique</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="vendor" placeholder="shopify" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Unité de mesure pour les poids</label>
                                <input type="text" class="form-control" name="weight" placeholder="ex : KG" disabled>
                            </div>
                            <button class="btn btn-success float-end mt-3" @disabled(true)>Enregister</button>
                        </form>
                    </div> --}}
                    <div class="card" id="utilisateur">
                        <div class="card-body">
                            <form method="POST" action="{{ route('utilisateur.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="old_password" class="form-label text-md-end">{{ __('Old password') }}</label>
                                        <input id="old_password" type="password" class="form-control mb-2 @error('old_password') is-invalid @enderror" name="old_password">
                                        @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <label for="password" class="form-label text-md-end">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror                            
                                    <label for="password-confirm" class="form-label text-md-end">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control mb-2" name="password_confirmation" autocomplete="new-password">   
                                </div>
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" placeholder="{{ Auth()->user()->name }}" autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <label for="email" class="form-label text-md-end">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control mb-2 @error('email') is-invalid @enderror" name="email" placeholder="{{ Auth()->user()->email }}" autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <button type="submit" class="btn btn-success mt-3 float-end">
                                            {{ __('Modifier les informations') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card" id="tinypng">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5>Liste des API's <button class="btn btn-success float-end mt-n1" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-plus"></i> Ajouter un API</button></h5> 
                                        <hr>
                                    <ul class="list-group">
                                        @foreach ($apis as $item)
                                            <li class="list-group-item">- {{$item->API}}<br> - Consomation : {{$item->Number}}/500 Images traité</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-7"  style="margin-top: -100px !important; z-index : 999 !important">
                                    <div class="h-100 p-5 text-bg-dark rounded-3">
                                        <h2>TinyPng Service API</h2>
                                        <p>Ceci est un service qui compresse vos image uploader et les recardre d'une façon inteligente, pour l'utiliser il vous faut un API que vous allez récupéré du site officiel de Tinypng</p>
                                        <hr>
                                        <p>Le service gratuit vous offre 500 images/mois, l'astuce est de crée plusieurs comptes et notre service pivotera automatiquement une fois que vous aurez épuisé la gratuité d'un api</p>
                                        <a href="https://tinypng.com/developers" target="__blank" class="btn btn-outline-light" type="button">Pour plus d'informations consulté le site de TinyPng  !</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    {{-- <div class="card" id="cloud">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">L'API pour la sauvegarde cloud</label>
                                <input type="text" class="form-control mt-2" id="exampleFormControlInput1" placeholder="Cloud storage API"> 
                            </div>
                            <button class="btn btn-success float-end mt-3" @disabled(true)>Enregister</button>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
 
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ajouter un nouvelle API TinyPNG</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('api.tinypng')}}" id="tiny-form" method="post">
                <div class="form-group">
                    @csrf
                    <label for="exampleFormControlInput1">L'API</label>
                    <input type="text" class="form-control mt-2" id="exampleFormControlInput1" name="tinyapi">
                    <label for="exampleFormControlInput1">Date de création</label>
                    <input type="date" class="form-control mt-2" id="exampleFormControlInput1" name="date">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" form="tiny-form">Understood</button>
        </div>
      </div>
    </div>
  </div>
  
<script>

// try {
//     Alert = document.getElementById('alert').value;
//     if(Alert == 0){
//     onglet();
// }
// } catch (error) {
    
// }
//to hide

    //document.getElementById('importation').className = 'hidden';
    document.getElementById('utilisateur').className = 'activated';
    document.getElementById('tinypng').className = 'hidden';
  //  document.getElementById('cloud').className = 'hidden';

//     function importation() {
//     //to hide
//     document.getElementById('importation').className = 'activated';
//     document.getElementById('utilisateur').className = 'hidden';
//     document.getElementById('tinypng').className = 'hidden';
//     document.getElementById('cloud').className = 'hidden';
//     //add active
//     document.getElementById('navimportation').className = 'nav-link active';
//     document.getElementById('navutilisateur').className = 'nav-link';
//     document.getElementById('navTinypng').className = 'nav-link';
//     document.getElementById('navcloud').className = 'nav-link';

// }
function utilisateur() {
   // document.getElementById('importation').className = 'hidden';
    document.getElementById('utilisateur').className = 'activated';
    document.getElementById('tinypng').className = 'hidden';
   // document.getElementById('cloud').className = 'hidden';
    //add active
   // document.getElementById('navimportation').className = 'nav-link';
    document.getElementById('navutilisateur').className = 'nav-link  active';
    document.getElementById('navTinypng').className = 'nav-link';
    //document.getElementById('navcloud').className = 'nav-link';
}
function tinypng() {
  //  document.getElementById('importation').className = 'hidden';
    document.getElementById('utilisateur').className = 'hidden';
    document.getElementById('tinypng').className = 'activated';
   // document.getElementById('cloud').className = 'hidden';
    //add active
   // document.getElementById('navimportation').className = 'nav-link ';
    document.getElementById('navutilisateur').className = 'nav-link';
    document.getElementById('navTinypng').className = 'nav-link active';
   // document.getElementById('navcloud').className = 'nav-link';
}
// function cloud() {
//   //  document.getElementById('importation').className = 'hidden';
//     document.getElementById('utilisateur').className = 'hidden';
//     document.getElementById('tinypng').className = 'hidden';
//     document.getElementById('cloud').className = 'activated';
//     //add active
//  //   document.getElementById('navimportation').className = 'nav-link';
//     document.getElementById('navutilisateur').className = 'nav-link';
//     document.getElementById('navTinypng').className = 'nav-link';
//     document.getElementById('navcloud').className = 'nav-link  active';
// }
</script>
@endsection