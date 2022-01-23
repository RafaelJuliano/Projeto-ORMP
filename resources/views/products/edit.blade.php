@extends('shared.app')

@section('content')
    <section class="body">        

        <nav class="body-nav">
            <a class="body-menu" href=""> <h2>Editar Produto</h2> </a>
            <a class="back-button" href="
                @if(url()->previous() == url()->current())
                   {{ route('itens.index') }}
                @else
                    {{ url()->previous() }}
                @endif
            ">Voltar</a>                                                          
        </nav>

        @if($errors->any())
            <div class="error alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form class="create-form" method="post" action="{{ route('itens.update', $product->id) }}">
            @method('PUT')
            {{ csrf_field() }}

            <div class="form-line">

                <div class="form-item form-large">
                    <label for="name">Nome do Produto</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}">
                </div>

            </div>
            
            <div class="form-line">
                <div class="form-item form-small">
                    <label for="price">Valor de venda</label>
                    <input type="number" step='0.01' name="price" id="price" max="99999999" value="{{ $product->price }}">
                </div>

                <div class="form-item form-small">
                    <label for="brand">Marca</label>
                    <select class="" name="brand_id" id="brand">
                        <option value="">Selecione</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                            {{ isset($product->brand_id) && $product->brand_id == $brand->id ? 'selected' : '' }} }}    
                                >{{ $brand->name }}</option>                        
                        @endforeach                    
                    </select>
                </div>

                <div class="form-item form-small">
                    <label for="quantity">Estoque inicial</label>
                    <input type="number" name="quantity" id="quantity" max="999999999" value="{{ $product->quantity }}">
                </div>

                <div class="form-item form-small">
                    <label for="reference">Código do produto</label>
                    <input type="text" name="reference" id="reference" value="{{ $product->reference }}">
                </div>
                
            </div>

            <div class="form-line">
                <div class="form-item form-large">
                    <label for="description">Descrição do produto</label>
                    <textarea type="text" name="description" id="description" placeholder="Descrição do produto">{{ $product->description }}</textarea>
                </div>
            </div>

            <hr>

            <div class="form-line">
                <div class="form-item form-medium">
                    <label for="category_id">Categoria do produto</label>
                    <input class="form-selection-box" type="checkbox" name="category-options" id="category-options" hidden >
                    <div class="form-selection-itens">
                            <label class="form-selection-item" for="category-options">Selecionar
                                <svg class="select-svg" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M12 21l-12-18h24z"/></svg>
                            </label>
                        @foreach($categories as $category)
                            <div class="form-selection-item">
                                @if ($product->categories->count() > 0)
                                    <input type="checkbox" name="category_id[]" id="checkbox-{{ $category->id }}" value="{{ $category->id }}" hidden
                                    @foreach ($product->categories as $c )
                                         {{ $category->id == $c->id ? 'checked' : '' }}
                                    @endforeach
                                    >
                                    <label for="category_id[]" onclick="changeCheckbox('checkbox-{{ $category->id }}')">{{ $category->name }}</label> 
                                @else
                                    <input type="checkbox" name="category_id[]" id="checkbox-{{ $category->id }}" value="{{ $category->id }}" hidden>
                                    <label for="category_id[]" onclick="changeCheckbox('checkbox-{{ $category->id }}')">{{ $category->name }}</label>
                                @endif
                                
                            </div>                            
                        @endforeach
                    </div>  
                </div>     
            </div>

            <div class="button-container">
                <button class="save-button" type="submit">Salvar</button>
                <button type="button" class="cancel-button" onclick="window.location.href='@if(url()->previous() == url()->current()){{ route('itens.index') }}@else{{ url()->previous() }}@endif'">Cancelar</button>
            </div>            
        </form>

    </section>

@endsection