@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="offset-10">
            <button type="button" class="btn-outline-success btn notif">
                {{ucfirst('sélection de ').$count.' produits ' .strtoupper($slug)}}
            </button>
        </div>

    </div>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-header">
                        <a href="{{route('product',['id'=>$product->id])}}">
                            <img src="{{asset('storage/img/products/'.$product->category->name.'/'.$product->picture->link)}}"
                                 class="img-thumbnail">
                            <p class="text-secondary">
                                <small>{{ucfirst('prix :')}}</small>
                                <small>{{$product->price}} €</small>
                            </p>
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$product->name}}</h4>
                        <div class="description">
                            {{ Str::limit($product->description, 50, $end='...') }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h3>{{ucfirst('aucun produit trouvé')}}</h3>
        @endforelse
    </div>
    @if(count($products)>0)
        <div class="row text-center">
            <div class="col-md-4 col-md-offset-4">
                {{$products->links()}}
            </div>
        </div>
    @endif
@endsection