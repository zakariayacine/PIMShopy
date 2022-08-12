@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Edit product {{$csv->Title}} <a class="btn btn-info float-end" href="{{route('home')}}">home</a>
        </div>
        <div class="card-body">
        <form action="" method="POST">
            <div class="row">
                
                
                @foreach($inputs as $input)
                <div class="col-md-4">
                    <label class="col-form-label text-md-end"><b>{{ucwords(implode(' ',preg_split('/(?=[A-Z])/',$input)))}}</b></label>
                    <input type="text" class="form-control" name="{{$input}}" value="{{$csv->$input}}">
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
    </div>
</div>
@endsection