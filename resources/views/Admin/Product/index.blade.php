@extends('components.dataTable')

@section('onTable')
    <a type="button" class="btn btn-outline-dark" href="{{route('products.create')}}">
        {{ucfirst('ajouter un nouveau produit ')}}<i class="fas fa-plus"></i>
    </a>
@endsection

@section('thead')
@endsection

@section('tbody')
@endsection