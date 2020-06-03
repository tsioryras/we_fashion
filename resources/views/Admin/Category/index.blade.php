@extends('components.dataTable')

@section('onTable')
    <a class="btn btn-outline-dark" href="{{route('category.create')}}">{{ucfirst('nouvelle catégorie')}}</a>
@endsection
@section('thead')
    <th>{{strtoupper('nom')}}</th>
    <th>{{strtoupper('action')}}</th>
@endsection
@section('tbody')
    @forelse($categories as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td><a class="btn btn-outline-secondary" href="{{route('category.edit')}}">{{ucfirst('edit')}}</a></td>
        </tr>
    @empty

    @endforelse
@endsection