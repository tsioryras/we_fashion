@extends('layouts.app')

@section('content')
    <div class="row">
<<<<<<< HEAD
        <div class="col-md-2"> {{strtoupper($slug)}}</div>
        <div class="offset-8">
            <button type="button" class="btn-outline-success btn notif">
                {{$count.' produits '}}
=======
        <div class="offset-10">
            <button type="button" class="btn-outline-success btn notif">
                {{ucfirst('sélection de ').$count.' produits ' .strtoupper($slug)}}
>>>>>>> 899309a567efdb0f40d3ba74b8b99c79af40a590
            </button>
        </div>

    </div>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4">
                <a class="article" href="{{route('product',['id'=>$product->id])}}">
                    <div class="card bg-light mb-3 img-thumbnail">
                        <div class="card-header text-center">
                            <img src="{{asset('storage/img/products/'.$product->category->name.'/'.$product->picture->link)}}">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{$product->name}}</h4>
                            <div class="description">
                                {{ Str::limit($product->description, 50, $end='...') }}
                            </div>
                            <p class="text-secondary">
                                <small>{{ucfirst('prix :')}}</small>
                                <small>{{$product->price}} €</small>
                            </p>
                        </div>
                    </div>
                </a>
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