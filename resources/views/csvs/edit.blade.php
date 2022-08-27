@extends('layouts.app')

@section('content')
<style>
    .hidden {
        display: none !important;
    }

    .activated {
        display: block;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            Edit product {{$csv->Title}} <a class="btn btn-info float-end" href="{{route('home')}}">home</a>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    @if ($errors->has('position'))
                        <li  id="alertImage">Veuillez choisir la bonne position de l'image</li>
                    @endif
                    @if ($errors->has('description'))
                        <li  id="alertImage">Veuillez ajouter une description valide</li>
                    @endif
                    @if ($errors->has('cvsid'))
                        <li  id="alertImage">Une erreur a était détécté veuillez réessayer merci !</li>
                    @endif
                    @if ($errors->has('imgUrl'))
                        <li  id="alertImage">L'image que vous avez selectionnée n'est plus valide !</li>
                    @endif
                        
                    @endforeach
                </ul>
            </div>
        @endif
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="navInfo" style="cursor: pointer !important;" aria-current="page" onclick="information()">Information
                        importante</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navOps" href="#" onclick="optional()">Optionnel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navSeo" href="#" onclick="seo()">SEO Google</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navImg" href="#" onclick="image()">Image du produit</a>
                </li>
            </ul>
            <div id="important">
                <form action="" method="POST">
                    <div class="row">
                        @foreach($default as $input)
                        <div class="col-md-4">
                            {!!$input!!}
                        </div>
                        @endforeach
                        <div class="col-md-12">
                            <input type="hidden" name="_method" value="PUT">
                            <button class="btn btn-success btn-lg float-end mt-3">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="optional" class="hidden">
                <form action="" method="POST">
                    <div class="row">
                        @foreach($optional as $input)
                        <div class="col-md-4">
                            {!!$input!!}
                        </div>
                        @endforeach
                        <div class="col-md-12">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success float-end mt-3">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="seo" class="hidden">
                <form action="" method="POST">
                    <div class="row">
                        @foreach($seo as $input)
                        <div class="col-md-4">
                            {!!$input!!}
                        </div>
                        @endforeach
                        <div class="col-md-12">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success float-end mt-3">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="image" class="hidden">
                <div class="row">
                    <input type="hidden" value="{{$csv->id}}" id="id">
                    @if($csv->ImageSrc === "")
                    <div class="col-md-12" align="center">
                        <div class="d-flex">
                            <div class="input-group mb-3 mt-2">
                                <span class="input-group-text" id="basic-addon3"> Rechercher l'image du produit </span>
                                <input class="form-control me-2" id="searchFor" type="search" placeholder="Search" oninput="searchFor()">
                              </div>
                        </div>
                        <div class="row" id="imageFinded">

                        </div>
                    </div>
                    @else
                    <div class="col-md-6">
                        <div class="col-md-12" align="center">
                            <div class="d-flex">
                                <div class="input-group mb-3 mt-2">
                                    <span class="input-group-text" id="basic-addon3"> Rechercher l'image du produit </span>
                                    <input class="form-control me-2" id="searchFor" type="search" placeholder="Search" oninput="searchFor()">
                                  </div>
                            </div>
                            <hr>
                            <div class="row" id="imageFinded">
    
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <h5> Images du produit </h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 card" style="margin-right: 10px !imporant;">
                                <div class="py-2 pb-3 mr-3 mb-2">
                                <form action="" method="POST">
                                    <img src="{{$csv->ImageSrc}}" class="img-fluid">
                                    <hr>
                                    <label class="col-form-label"><b>La description de l'image du
                                            produit</b></label>
                                    <input type="text" class="form-control" name="description" value="{{$csv->ImageAltText}}">
                                    <label class="col-form-label"><b>Position de l'image</b></label>
                                    <input type="number" class="form-control" name="position" value="{{$csv->ImagePosition}}">
                                    <input type="hidden" value="{{$csv->id}}" name="cvsid">
                                    <input type="hidden" value="{{$csv->ImageSrc}}" name="imgUrl">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success float-end mt-3">Update</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            @foreach ($images as $image)
                            <div class="col-md-6 card" style="margin-right: 10px !imporant;">
                                <div class="py-2 pb-3 mr-3 mb-2">
                                <form action="" method="POST">
                                    <img src="{{$image->ImageSrc}}" class="img-fluid">
                                    <hr>
                                    <label class="col-form-label"><b>La description de l'image du
                                            produit</b></label>
                                    <input type="text" class="form-control" name="description" value="{{$image->ImageAltText}}">
                                    <label class="col-form-label"><b>Position de l'image</b></label>
                                    <input type="number" class="form-control" name="position" value="{{$image->ImagePosition}}">
                                    <input type="hidden" value="{{$csv->id}}" name="cvsId">
                                    <input type="hidden" value="{{$image->ImageSrc}}" name="imgUrl">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success float-end mt-3">Update</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                            @endforeach
                        </div>
                </div>
                    @endIf
                    <div class="col-md-12">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    try {
        imageAlert = document.getElementById('alertImage').value;
        if(imageAlert == 0){
        image();
    }
    } catch (error) {
        
    }
    function searchFor(){
        var data = document.getElementById('searchFor').value;
        var csvId = document.getElementById('id').value;
        var csrf = document.querySelector('meta[name="csrf-token"]').content;

            console.log(csrf,csvId);
        let form = {
          "imageName" : data
        };
       var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.post("{{route('images.api.post')}}",
            form,{ headers: {'X-CSRF-TOKEN' : laravelToken} }).then(function (response) {
            // handle success
            $var = [];
            for (let index = 0; index < response.data.images.length; index++) {
                $var +=  '<div class="col-md-6 mb-2 mr-2">'
                +'<form method="post" action="/csvs/image">'
                +'<div class="card p-3">'
                +'<input type="hidden" name="_token" value="'+csrf+'" />'
                +'<img src="'+response.data.images[index].cloudUrl+ '" class="img-fluid mt-2 mb-2">'
                +'<select class="form-select mb-2" aria-label="order" name="position">'
                    +'<option selected>Choisir l\'ordre de l\'image</option>'
                    +'<option value="1">Première position </option>'
                    +'<option value="2">Deuxième position </option>'
                   +'<option value="3">Troisième position </option>'
                   +'<option value="3">QuatrièmeOne position </option>'
                +'</select>'
                +'<input class="form-control mb-2" name="description" placeholder="Une courte description">'
                +'<input type="hidden" name="cvsid" value="'+csvId+'" />'
                +'<input type="hidden" name="imgUrl" value="'+response.data.images[index].cloudUrl+'" />'
                +'<button class="btn btn-success">Ajouter</button>'
                +'</div>'
                +'</form>'
                +'</div>'
            }
            document.getElementById('imageFinded').innerHTML = $var;
          //  console.log(response);
        })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
    }

    function information() {
        //to hide
        document.getElementById('important').className = 'activated';
        document.getElementById('optional').className = 'hidden';
        document.getElementById('seo').className = 'hidden';
        document.getElementById('image').className = 'hidden';
        //add active
        document.getElementById('navInfo').className = 'nav-link active';
        document.getElementById('navOps').className = 'nav-link';
        document.getElementById('navSeo').className = 'nav-link';
        document.getElementById('navImg').className = 'nav-link';

    }
    function optional() {
        document.getElementById('important').className = 'hidden';
        document.getElementById('optional').className = 'activated';
        document.getElementById('seo').className = 'hidden';
        document.getElementById('image').className = 'hidden';
        //add active
        document.getElementById('navInfo').className = 'nav-link';
        document.getElementById('navOps').className = 'nav-link  active';
        document.getElementById('navSeo').className = 'nav-link';
        document.getElementById('navImg').className = 'nav-link';
    }
    function seo() {
        document.getElementById('important').className = 'hidden';
        document.getElementById('optional').className = 'hidden';
        document.getElementById('seo').className = 'activated';
        document.getElementById('image').className = 'hidden';
        //add active
        document.getElementById('navInfo').className = 'nav-link ';
        document.getElementById('navOps').className = 'nav-link';
        document.getElementById('navSeo').className = 'nav-link active';
        document.getElementById('navImg').className = 'nav-link';
    }
    function image() {
        document.getElementById('important').className = 'hidden';
        document.getElementById('optional').className = 'hidden';
        document.getElementById('seo').className = 'hidden';
        document.getElementById('image').className = 'activated';
        //add active
        document.getElementById('navInfo').className = 'nav-link';
        document.getElementById('navOps').className = 'nav-link';
        document.getElementById('navSeo').className = 'nav-link';
        document.getElementById('navImg').className = 'nav-link  active';
    }
</script>
@endsection