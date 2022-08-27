@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <a class="btn btn-success float-end" href="{{route('images')}}">Retour</a></div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @foreach(Session::get('images') as $image)
                    <img src="images/{{ $image['name'] }}" width="300px">
                    @endforeach
                    @endif
                    <form action="{{ route('ImageUpload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="inputImage">Select Images:</label>
                            <input type="file" name="images[]" id="inputImage" multiple class="form-control @error('images') is-invalid @enderror" accept="image/*">
                            @error('images')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection