@extends('layouts.app')

@section('content')
    <h1></h1>
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
                        <h5 class="card-title">{{$product->name}}</h5>
                        <div class="description">
                            {{ Str::limit($product->description, 100, $end='...') }}
                            <a href="{{route('product',['id'=>$product->id])}}">[Lire la suite]</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h3>{{ucfirst('aucun produit trouvé')}}</h3>
        @endforelse
    </div>
    @if(count($products)>0)
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                {{$products->links()}}
            </div>
        </div>
    @endif
@endsection