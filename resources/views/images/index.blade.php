@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header"><b>Tableau des images :</b><a class="btn btn-success float-end btn-sm" href="{{route('images.import')}}">import images</a>
        </div>
        <div class="card-body">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Images</li>
                    </ol>
                  </nav>
                  
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Affichage : </span>
                    <select class="form-control" id="taille" onchange="taillee()">
                        <option>Selection</option>
                        <option value="2">Petite image</option>
                        <option value="3">Moyenne image</option>
                        <option value="4">Grande image</option>
                        <option value="5">Tres grande image</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <input type="hidden" value="{{count($images)}}" id="imageCount">
                @foreach($images as $key => $image)
                <div class="col-md-3" id="col-md-{{ ++$key }}">
                    <div class="card m-2 p-3">
                        <p><b>{{str_replace("converted/", "", $image->localUrl)}}</b></p>
                        <hr style="margin-top: -10px !important;">
                        <img class="img-fluid mb-2 rounded mx-auto" src="{{$image->localUrl}}">
                        <form action="{{route('image.delete')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <hr style="margin-top: -3px !important;">
                                    <div class="d-grid gap-2">
                                        <input type="hidden" value="{{$image->id}}" name="imageid">
                                        <button class="btn btn-danger btn-block">Supprimer !</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function(){
   window.location.reload(1);
}, 10000);
    function taillee() {
        var select = document.getElementById('taille');
        var value = select.options[select.selectedIndex].value;
        var imageCount = document.getElementById('imageCount').value;
        switch (String(value)) {
            case "2":
                console.log('1');
                for (let index = 1; index <= imageCount; index++) {
                    var col = document.getElementById('col-md-' + index).className = 'col-md-2';
                }

                break;
            case "3":
                console.log('2');
                for (let index = 1; index <= imageCount; index++) {
                    var col = document.getElementById('col-md-' + index).className = 'col-md-3';
                }
                break;
            case "4":
                console.log('3');
                for (let index = 1; index <= imageCount; index++) {
                    var col = document.getElementById('col-md-' + index).className = 'col-md-6';
                }
                break;
            case "5":
                console.log('3');
                for (let index = 1; index <= imageCount; index++) {
                    var col = document.getElementById('col-md-' + index).className = 'col-md-12';
                }
                break;
            default:
                break;
        }

    }
</script>
@endsection