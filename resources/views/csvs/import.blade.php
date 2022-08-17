@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} <a class="btn btn-info float-end" href="{{route('home')}}">home</a></div>
                <div class="card-body">
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