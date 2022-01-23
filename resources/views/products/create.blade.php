@extends('shared.app')

@section('content')
    <section class="body">        

        <nav class="body-nav">
            <a class="body-menu" href=""> <h2>Cadastrar Produto</h2> </a>
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

        <form class="create-form" method="post" action="{{ route('itens.store') }}">
            {{ csrf_field() }}

            <div class="form-line">

                <div class="form-item form-large">
                    <label for="name">Nome do Produto</label>
                    <input type="text" name="name" id="name">
                </div>
                                

                
            </div>
            
            <div class="form-line">
                <div class="form-item form-small">
                    <label for="price">Valor de venda</label>
                    <input type="number" step='0.01' name="price" id="price" max="99999999" placeholder="10,50">
                </div>

                <div class="form-item form-small">
                    <label for="brand">Marca</label>
                    <select class="" name="brand_id" id="brand">
                        <option value="">Selecione</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>                        
                        @endforeach                    
                    </select>
                </div>

                <div class="form-item form-small">
                    <label for="quantity">Estoque inicial</label>
                    <input type="number" name="quantity" id="quantity" max="999999999" placeholder="10">
                </div>

                <div class="form-item form-small">
                    <label for="reference">Código do produto</label>
                    <input type="text" name="reference" id="reference" placeholder="Ex. CD0001">
                </div>
                
            </div>

            <div class="form-line">
                <div class="form-item form-large">
                    <label for="description">Descrição do produto</label>
                    <textarea type="text" name="description" id="description" placeholder="Detalhes do produto"></textarea>
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
                                <input type="checkbox" name="category_id[]" id="checkbox-{{ $category->id }}" value="{{ $category->id }}" hidden>
                                <label for="category_id[]" onclick="changeCheckbox('checkbox-{{ $category->id }}')">{{ $category->name }}</label>
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