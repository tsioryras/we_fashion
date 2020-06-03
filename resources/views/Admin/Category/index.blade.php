@extends('components.dataTable')

@section('onTable')
    <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal"
            data-target="#create">{{ucfirst('nouvelle catégorie')}}
    </button>
    <div class="modal fade" id="create" role="dialog">
        <div class="modal-dialog modal-sm">
            <form action="{{route('categories.store')}}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <small class="modal-title">Nouvelle catégorie</small>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">{{ucfirst('nom de la catégorie')}}</label>
                            @if($errors->has('name'))
                                <small class="alert-warning">{{$errors->first('name')}}</small>
                            @endif
                            <input type="text" class="form-control" id="name"
                                   aria-describedby="titleHelp" name="name"
                                   value="{{old('name')}}"
                                   placeholder="ex:enfant" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-secondary">Créer</button>
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('thead')
    <th>{{strtoupper('nom')}}</th>
    <th>{{strtoupper('action')}}</th>
@endsection
@section('tbody')
    @forelse($categories as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#edit">
                    {{ucfirst('edit')}}
                </button>
                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete">
                    {{ucfirst('delete')}}
                </button>
            </td>
        </tr>
        <!-- Modal de création et d'édition-->
        <div class="modal fade" id="edit" role="dialog">
            <div class="modal-dialog modal-sm">
                <form action="{{route('categories.update',$category->id)}}" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <small class="modal-title">Modification catégorie</small>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">{{ucfirst('nom de la catégorie')}}</label>
                                @if($errors->has('name'))
                                    <small class="alert-warning">{{$errors->first('name')}}</small>
                                @endif
                                <input type="text" class="form-control" id="name"
                                       aria-describedby="titleHelp" name="name"
                                       value="@if(isset($category)){{$category->name}}@else{{old('name')}}@endif"
                                       placeholder="Edit category name" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-secondary">Enregistrer</button>
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal de suppression-->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog"
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
                        Voulez-vous vraiment supprimer cette catégorie?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            {{ucfirst('annuler')}}
                        </button>
                        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <input type="submit" class="btn btn-outline-danger" value="Oui"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <tr class="text-center">
            {{strtoupper('aucune catégorie')}}
        </tr>
    @endforelse
@endsection
