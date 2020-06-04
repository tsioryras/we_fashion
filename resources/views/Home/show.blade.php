@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="col-md-4 offset-md-2">
            <img src="{{asset('storage/img/products/'.$product->category->name.'/'.$product->picture->link)}}"
                 class="img-thumbnail">
        </div>
        <div class="col-md-4 offset-md-1 text-left">
            <h3>{{strtoupper($product->name)}}</h3>
            <ul class="list-group product-info">
                <li class="list-group-item">{{ucfirst('réference: ').$product->reference}}</li>
                <li class="list-group-item">{{ucfirst('catégorie: ').ucfirst($product->category->name)}}</li>
                <li class="list-group-item code">
                    @if($product->code=='onSale')
                        {{strtoupper('en solde -').random_int(5,90).'%' }}
                    @endif
                </li>
                <li class="list-group-item">
                    <select class="custom-select">
                        <option>choissisez votre taille</option>
                        @forelse($product->size as $size)
                            <option value="{{$size}}">{{$size}}</option>
                        @empty
                        @endforelse
                    </select>
                </li>
                <li class="list-group-item">{{ucfirst($product->description)}}</li>
                <li class="list-group-item">
                    <button type="button" class="btn btn-success">{{'acheter'}}</button>
                </li>
            </ul>
        </div>
    </div>
@endsection