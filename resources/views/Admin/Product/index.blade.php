@extends('components.dataTable')

@section('onTable')

    <div class="row">
        <div class="col-md-6">
            <a type="button" title="créer" class="btn btn-outline-dark" href="{{route('products.create')}}">
                {{ucfirst('ajouter un nouveau produit ')}}<i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-6 text-right">
            <span class="btn btn-outline-dark">
            {{ucfirst('Liste des produits')}}
            </span>
        </div>
    </div>
@endsection

@section('thead')
    <th>#</th>
    <th>{{ucfirst('nom')}}</th>
    <th>{{ucfirst('categorie')}}</th>
    <th>{{ucfirst('prix')}}</th>
    <th>{{ucfirst('taille')}}</th>
    <th>{{ucfirst('etat')}}</th>
    <th>{{ucfirst('actions')}}</th>
@endsection

@section('tbody')
    @forelse($products as $product)
        <tr>
            <td>{{$product->reference}}</td>
            <td>{{ucfirst($product->name)}}</td>
            <td>{{ucfirst($product->category->name)}}</td>
            <td>{{ucfirst($product->price)}}</td>
            <td>
                @forelse($product->size as $key =>$size)
                    {{strtoupper($size)}}
                    @if($key!=array_key_last($product->size))
                        /
                    @endif
                @empty
                @endforelse
            </td>
            <td>{{ucfirst($product->status)}}</td>
            <td>
                <a class="btn btn-sm btn-outline-dark" title="modifier" href="{{route('products.edit',$product->id)}}">
                    <i class="fa fa-pencil"></i>
                </a>
                <button class="btn btn-sm btn-outline-danger" title="supprimer" data-toggle="modal"
                        data-target="#delete{{$product->id}}">
                    <i class="fa fa-trash"></i>
                </button>
                <!-- Modal de suppression-->
                <div class="modal fade" id="delete{{$product->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <small class="modal-title" id="exampleModalLongTitle">Confirmez la suppression</small>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer le produit {{strtoupper($product->name)}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                    {{ucfirst('annuler')}}
                                </button>
                                <form action="{{route('products.destroy',$product->id)}}" method="POST">
                                    {{method_field('DELETE')}}
                                    {{csrf_field()}}
                                    <input type="submit" class="btn btn-outline-danger" value="Oui"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @empty
    @endforelse
@endsection