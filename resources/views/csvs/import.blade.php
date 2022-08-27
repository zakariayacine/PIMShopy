@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Importé des produits <a class="btn btn-info float-end" target="__blank" href="/exemple.xlsx">Telecharger fichier exemple</a></div>
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page"> importé une liste de produit excel</li>
                        </ol>
                      </nav>
                      <hr>
                        <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="formFile" class="form-label">File excel</label>
                            <input class="form-control" type="file" id="formFile" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <button class="btn btn-success btn-block mt-3 float-end">Upload</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection