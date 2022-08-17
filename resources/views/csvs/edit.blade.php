@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
           <b>Modification du produit: {{$csv->Title}} </b> 
        </div>
        <div class="card-body">
            <nav aria-label="breadcrumb" class="float-end">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Modification du produit: {{$csv->Title}}</li>
                </ol>
              </nav>
              
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
                        @foreach($defaultinputs as $input)
                        <div class="col-md-4">
                            <label class="col-form-label text-md-end"><b>{{ucwords(implode('
                                    ',preg_split('/(?=[A-Z])/',$input)))}}</b></label>
                            <textarea class="form-control" name="{{$input}}" id="" cols="10"
                                rows="2">{{$csv->$input}}</textarea>
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
                        @foreach($OptionInputs as $input)
                        <div class="col-md-4">
                            <label class="col-form-label text-md-end"><b>{{ucwords(implode('
                                    ',preg_split('/(?=[A-Z])/',$input)))}}</b></label>
                            <textarea class="form-control" name="{{$input}}" id="" cols="10"
                                rows="2">{{$csv->$input}}</textarea>
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
                        @foreach($SEOInputs as $input)
                        <div class="col-md-4">
                            <label class="col-form-label text-md-end"><b>{{ucwords(implode('
                                    ',preg_split('/(?=[A-Z])/',$input)))}}</b></label>
                            <textarea class="form-control" name="{{$input}}" id="" cols="10"
                                rows="2">{{$csv->$input}}</textarea>
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
                    @if($csv->ImageSrc === "somthing")
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
                    <div class="col-md-4">

                        <form action="" method="POST">
                            <label class="col-form-label text-md-end"><b>Titre de l'image: {{str_replace("/converted/",
                                    "", $csv->ImageSrc)}}</b></label>
                            <hr>
                            <img src="{{$csv->ImageSrc}}" class="img-fluid">
                            <hr>
                            <label class="col-form-label text-md-end"><b>La description de l'image du
                                    produit</b></label>
                            <input type="text" class="form-control" name="{{$input}}" value="{{$csv->ImageAltText}}">
                            <label class="col-form-label text-md-end"><b>Position de l'image</b></label>
                            <input type="number" class="form-control" name="{{$input}}" value="{{$csv->ImagePosition}}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success float-end mt-3">Update</button>
                            </div>
                        </form>

                    </div>
                    @endIf
                    <div class="col-md-12">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Change the inputs and make the process of asign picture to a product -->
<script>
    function searchFor(){
        var data = document.getElementById('searchFor').value;
        let form = {
          "imageName" : data
        };
        console.log(data);
       var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.post("{{route('images.api.post')}}",
            form,{ headers: {'X-CSRF-TOKEN' : laravelToken} }).then(function (response) {
            // handle success
            $var = [];
            for (let index = 0; index < response.data.images.length; index++) {
                $var +=  '<div class="col-md-3">'
             + '<div class="card p-3">'
                +'<img src="'+response.data.images[index].cloudUrl+ '" class="img-fluid mt-2 mb-2">'
                +'<select class="form-select mb-2" aria-label="Default select example">'
                    +'<option selected>Choisir l\'ordre de l\'image</option>'
                    +'<option value="1">Première position </option>'
                    +'<option value="2">Deuxième position </option>'
                   +'<option value="3">Troisième position </option>'
                   +'<option value="3">QuatrièmeOne position </option>'
                +'</select>'
                +'<input class="form-control mb-2" name="description" placeholder="Une courte description">'
                +'<button class="btn btn-success">Ajouter</button>'
                +'</div>'
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