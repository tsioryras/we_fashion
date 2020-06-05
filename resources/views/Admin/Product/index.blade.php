@extends('components.dataTable')

@section('onTable')
    <a type="button" class="btn btn-outline-dark" href="{{route('products.create')}}">
        {{ucfirst('ajouter un nouveau produit ')}}<i class="fas fa-plus"></i>
    </a>
@endsection

@section('thead')
    <th>#</th>
    <th>{{strtoupper('nom')}}</th>
    <th>{{strtoupper('categorie')}}</th>
    <th>{{strtoupper('prix')}}</th>
    <th>{{strtoupper('taille')}}</th>
    <th>{{strtoupper('etat')}}</th>
    <th>{{strtoupper('actions')}}</th>
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
                <a class="btn btn-sm btn-outline-dark" href="{{route('products.edit',$product->id)}}">
                    <i class="fas fa-pencil"></i>
                </a>
                <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete{{$product->id}}">
                    <i class="fas fa-trash"></i>
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