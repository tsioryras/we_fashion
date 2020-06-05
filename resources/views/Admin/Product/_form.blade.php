@extends('layouts.app')

@section('content')
    @php
        $edit = false;
        $status = ['published','unpublished'];
        $sizes = ['XS','S','M','L','XL'];
        $codes = ['standard','onSale'];
    @endphp
    <h2>
        @if(Route::is('products.create'))
            {{ucfirst('ajout d\'un nouveau produit')}}
        @endif
        @if(Route::is('products.edit'))
            {{ucfirst('modification du produit '.strtoupper($product->name))}}
            @php $edit = true @endphp
        @endif
    </h2><br>
    <form action="@if($edit){{route('products.update',$product->id)}} @else {{route('products.store')}} @endif"
          enctype="multipart/form-data" method="POST">
        @if($edit)
            {{method_field('PUT')}}
        @endif
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-6">

                <!--NAME-->
                <div class="form-group">
                    <label for="name">{{ucfirst('nom du produit')}}</label>
                    @if($errors->has('name'))
                        <small class="alert-warning">{{$errors->first('name')}}</small>
                    @endif
                    <input type="text" class="form-control" id="name"
                           aria-describedby="titleHelp" name="name"
                           value="@if($edit && isset($product)){{$product->name}}@else{{old('name')}}@endif"
                           placeholder="nom du produit" required/>
                </div>

                <!--REFERENCE-->
                <div class="form-group">
                    <label for="reference">{{ucfirst('référence du produit')}}</label>
                    @if($errors->has('reference'))
                        <small class="alert-warning">{{$errors->first('reference')}}</small>
                    @endif
                    <input type="text" class="form-control" id="reference"
                           aria-describedby="titleHelp" name="reference"
                           value="@if($edit && isset($product)){{$product->reference}}@else{{old('reference')}}@endif"
                           placeholder="réference du produit" required/>
                </div>

                <!--DESCRIPTION-->
                <div class="form-group">
                    <label for="description">Description</label>
                    @if($errors->has('description'))
                        <small class="alert-warning">{{$errors->first('description')}}</small>
                    @endif
                    <textarea class="form-control" name="description" id="description"
                              placeholder="Déscription du produit"
                              required>@if($edit && isset($product)){{trim($product->description)}}@else{{old('description')}}@endif</textarea>
                </div>

                <!--CATEGORY-->
                <div class="form-group">
                    <label for="category">{{ucfirst('catégorie')}}</label>
                    @if($errors->has('category'))
                        <small class="alert-warning">{{$errors->first('category')}}</small>
                    @endif
                    <select id="category" name="category" class="form-control">
                        @forelse($categories as $category)
                            <option @if($edit && isset($product) && ($product->category_id == $category->id || old('category')==$category->id))
                                    selected
                                    @endif
                                    @if(!$edit && old('category') == $category->id)
                                    selected
                                    @endif
                                    value="{{$category->id}}">
                                {{$category->name}}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <!--SIZE-->
                <div class="form-group">
                    <label>{{ucfirst('choisissez la(les) taille(s) disponible pour le produit')}}</label>
                    @if($errors->has('size'))
                        <small class="alert-warning">{{$errors->first('size')}}</small>
                    @endif
                    <br>
                    @forelse($sizes as $size)
                        <div class="form-check-inline">
                            <input class="form-check-input"
                                   @if(($edit && isset($product) && in_array(strtoupper($size),$product->size)) || (is_array(old('size')) && in_array($size,old('size'))))
                                   checked
                                   @endif
                                   name="size[]"
                                   type="checkbox"
                                   value="{{$size}}"
                                   id="{{strtolower($size)}}">
                            <label class="control-label" for="{{strtolower($size)}}">
                                {{$size}}
                            </label>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

            <!--PICTURE-->
            <div class="col-md-6">
                <div class="form-group">
                    @if($errors->has('product_picture'))
                        <small class="alert-warning">{{$errors->first('product_picture')}}</small>
                    @endif
                    <div id="picture_preview_card"
                         @if(($edit && !isset($product->picture)) || !$edit)class="d-none"@endif>
                        <input type="hidden" name="picture_src" id="picture_src" value="">
                        <img id="picture_preview"
                             src="@if($edit && isset($product) && isset($product->picture)){{asset('storage/img/products/'.$product->category->name.'/'.$product->picture->link)}}@endif"
                             alt="picture">
                    </div>
                    {{old('product_picture')}}
                    <h6 class="hint_picture">{{ucfirst('Ajoutez une image au produit')}}</h6>
                    <input type="file" class="custom-file-input d-none"
                           name="product_picture" id="product_picture"/>
                    <label class="btn btn-outline-secondary file-label"
                           for="product_picture">{{ucfirst('choisir')}}</label>
                    @if($errors->has('product_picture'))
                        <br>
                        <small class="alert-warning">{{$errors->first('product_picture')}}</small>
                    @endif
                </div>

                <!--STATUS-->
                <div class="form-group">
                    @if($errors->has('status'))
                        <small class="alert-warning">{{$errors->first('status')}}</small>
                    @endif
                    <h6>{{ucfirst('etat')}}</h6>
                    @forelse($status as $state)
                        <div class="form-check">
                            <input class="form-check-input"
                                   @if(($edit && isset($product) && strtolower($product->status)==strtolower($state)) || old('status')== $state)
                                   checked
                                   @endif
                                   name="status"
                                   type="radio"
                                   value="{{$state}}"
                                   id="{{$state}}"/>
                            <label class="control-label" for="{{$state}}">
                                {{$state}}
                            </label>
                        </div>
                    @empty
                    @endforelse
                </div>

                <!--CODE-->
                <div class="form-group">
                    @if($errors->has('code'))
                        <small class="alert-warning">{{$errors->first('code')}}</small>
                    @endif
                    <h6>{{ucfirst('code')}}</h6>
                    @forelse($codes as $code)
                        <div class="form-check">
                            <input class="form-check-input"
                                   @if(($edit && isset($product) && strtolower($product->code)==strtolower($code)) || old('code')== $code)
                                   checked
                                   @endif
                                   name="code"
                                   type="radio"
                                   value="{{$code}}"
                                   id="{{$code}}"/>
                            <label class="control-label" for="{{$code}}">
                                {{$code}}
                            </label>
                        </div>
                    @empty
                    @endforelse
                </div>

                <!--PRICE-->
                <div class="form-group">
                    <label class="control-label" for="price">{{ucfirst('prix (€)')}}</label>
                    @if($errors->has('price'))
                        <small class="alert-warning">{{$errors->first('price')}}</small>
                    @endif
                    <input class="form-control" name="price" id="price"
                           value="@if($edit && $product->price!=null) {{$product->price}} @else {{old('price')}} @endif"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ucfirst('enregistrer')}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('#picture_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            if ($('#picture_preview').attr('src') != '') {
                $('#picture_src').val($('#picture_preview').attr('src'));
                $('#picture_preview_card').removeClass('d-none');
                $('.hint_picture').html('Changer l\'image');
            }

            $.trim($('#description').val());

            $('#product_picture').change(function () {
                readURL(this);
                $('#picture_preview_card').removeClass('d-none');
                $('.hint_picture').html('Changer l\'image');
            });
        });
    </script>
@endsection
