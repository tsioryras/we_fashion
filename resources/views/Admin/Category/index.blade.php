@extends('components.dataTable')

@section('onTable')
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                    data-target="#create">{{ucfirst('nouvelle catégorie ')}}
                <i class="fa fa-plus"></i>
            </button>
        </div>
        <div class="col-md-6 text-right">
            <span class="btn btn-outline-dark">
            {{ucfirst('Liste des catégories')}}
            </span>
        </div>
    </div>
    <div class="modal fade" id="create" role="dialog">
        <div class="modal-dialog modal-sm">
            <form action="{{route('categories.store')}}" method="POST">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header">
                        <small class="modal-title">Nouvelle catégorie</small>
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
    <th>#</th>
    <th>{{ucfirst('nom')}}</th>
    <th>{{ucfirst('action')}}</th>
@endsection
@section('tbody')
    @forelse($categories as $category)
        <tr>
            <td>{{ucfirst($category->id)}}</td>
            <td>{{ucfirst($category->name)}}</td>
            <td>
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#edit{{$category->id}}">
                    <i class="fa fa-pencil"></i>
                </button>
                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delete{{$category->id}}">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        <!-- Modal de création et d'édition-->
        <div class="modal fade" id="edit{{$category->id}}" role="dialog">
            <div class="modal-dialog modal-sm">
                <form action="{{route('categories.update',$category->id)}}" method="POST">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="modal-content">
                        <div class="modal-header">
                            <small class="modal-title">Modification catégorie</small>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">{{ucfirst('nom de la catégorie')}}</label>
                                @if($errors->has('name'))
                                    <small class="alert-warning">{{$errors->first('name')}}</small>
                                @endif
                                <input type="text" class="form-control" id="name"
                                       aria-describedby="titleHelp" name="name"
                                       value="{{$category->name}}"
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
        <div class="modal fade" id="delete{{$category->id}}" tabindex="-1" role="dialog"
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
                        Voulez-vous vraiment supprimer la catégorie {{strtoupper($category->name)}}?
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
