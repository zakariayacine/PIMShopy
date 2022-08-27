@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page"> Liste des produits</li>
                        </ol>
                      </nav>
                      <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Title</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($csv as $csvOne)
                            <tr>
                                <th scope="row">{{$csvOne->id}}</th>
                                <td>{{$csvOne->Handle}}</td>
                                <td>{{$csvOne->Title}}</td>
                                <td>
                                    <div class="btn-group float-end" role="group" aria-label="Basic example">
                                        <a class="btn btn-info mr-3" href="{{route('csv.show',$csvOne->id)}}"><i class="fa-solid fa-eye"></i></a>
                                        <a class="btn btn-success mr-3" href="/edit/{{$csvOne->id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-danger mr-3" href="/edit/{{$csvOne->id}}"><i class="fa-solid fa-trash-can"></i></a>
                                      </div>
                                    <!-- adding delete and show product and make change the table to data table-->
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