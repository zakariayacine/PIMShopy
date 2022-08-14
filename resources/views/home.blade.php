@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} <a class="btn btn-success float-end" href="{{route('import')}}">Import</a></div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($csv as $csvOne)
                            <tr>
                                <th scope="row">{{$csvOne->id}}</th>
                                <td>{{$csvOne->Handle}}</td>
                                <td>{{$csvOne->Title}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a class="btn btn-success mr-3" href="/edit/{{$csvOne->id}}">Modify</a>
                                        </div>
                                        @if($csvOne->ImageSrc === 'somthing')
                                        <div class="col-md-9">
                                            <form action="{{route('ImageUpload', $csvOne->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <div class="row">
                                                <div class="col-md-6">
                                                <input class="form-control" type="file"  name="image">
                                                </div>
                                                <div class="col-md-6">
                                                <button class="btn btn-success">upload image file</button>
                                                </div>
                                            </form>
                                        </div>
                                        @else
                                        <div class="col-md-9">
                                            <img src="{{$csvOne->ImageSrc}}" height="50" width="50">
                                        </div>
                                        @endif
                                    </div>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end">
                        {{ $csv->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection