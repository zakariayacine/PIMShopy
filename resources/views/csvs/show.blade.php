@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 card">
            <div class="card-body">
                @if(!$csv->ImageSrc)
                <div class="jumbotron">
                    <h1 class="display-4">Pas d'image!</h1>
                    <p class="lead">Ceci est un message qui apparaît lorsque aucune photo n'est liée à votre produit, pour visualiser l'image veuillez uploader une image dans le menu <b>bibliothèque d'image</b> ou bien choisir une image dans : <b>produit !</b> </p>
                    <hr class="my-4">
                    <p>Il est possible d'accéder à ces deux menus via ces deux raccourcis.</p>
                    <a class="btn btn-secondary btn-lg" href="{{route('images.import')}}" role="button">Ajoutez des images</a>
                    <a class="btn btn-primary btn-lg" href="{{route('edit',$csv->id)}}" role="button">Modifier le produit !</a>
                  </div>
                @else
                <!-- Photos -->
                  <div class="row">
                    <div class="col-md-6 card">
                        <b class="mt-2"> Position : {{$csv->ImagePosition}} <hr style="margin-top:-1px ;"></b>
                        <div class="card-body">
                            <img src="{{$csv->ImageSrc}}" class="img-fluid" alt="{{$csv->ImageAltText}}">
                        </div>
                    </div>
                    @foreach ($images as $image)
                    <div class="col-md-6 card">
                        <b class="mt-2"> Position : {{$image->ImagePosition}} <hr style="margin-top:-1px ;"></b>
                        <div class="card-body">
                            <img src="{{$image->ImageSrc}}" class="img-fluid" alt="{{$image->ImageAltText}}">
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-6 card">
            <div class="card-body">
                <p><b>Titre du produit :</b> {{$csv->Handle}}</p>
                <div class="row">
                    <div class="col-md-12">
                        <p class="card p-3"
                            style="background-color: rgba(0, 0, 0, 0.726) !important; color:aliceblue !important; text-align: center !important">
                            {{$csv->BodyHTML}}</p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <b>Handle :</b> {{$csv->Handle}}<br>
                            <b>Title :</b> {{$csv->Title}}<br>
                            <b>Vendor :</b> {{$csv->Vendor}}<br>
                            <b>Standardized Product Type :</b> {{$csv->StandardizedProductType}}<br>
                            <b>Custom Product Type :</b> {{$csv->CustomProductType}}<br>
                            <b>Tags :</b> {{$csv->Tags}}<br>
                            <b>Published :</b> {{$csv->Published}}<br>
                            <b>Price International :</b> {{$csv->PriceInternational}}<br>
                            <b>Compare At Price International :</b> {{$csv->CompareAtPriceInternational}}<br>
                            <b>Option1 Name :</b> {{$csv->Option1Name}}<br>
                            <b>Option1 Value :</b> {{$csv->Option1Value}}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <b>Variant Grams :</b> {{$csv->VariantGrams}}<br>
                            <b>Variant Fulfillment Service :</b> {{$csv->VariantFulfillmentService}}<br>
                            <b>Variant Price :</b> {{$csv->VariantPrice}}<br>
                            <b>Variant Requires Shipping :</b> {{$csv->VariantRequiresShipping}}<br>
                            <b>Variant Taxable :</b> {{$csv->VariantTaxable}}<br>
                            <b>Variant Weight Unit :</b> {{$csv->VariantWeightUnit}}<br>
                            <b>Status :</b> {{$csv->Status}}
                        </p>
                        <a href="{{route('edit',$csv->id)}}" class="btn btn-dark"><i class="fa-regular fa-pen-to-square"></i> Modifier !</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection