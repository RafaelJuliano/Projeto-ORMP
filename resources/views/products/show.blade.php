@extends('shared.app')

@section('content')
    <section class="body">        

        <nav class="body-nav">
            <a class="body-menu" href=""> <h2>Dados do produtos</h2> </a>
            <a class="back-button" href="
                @if(url()->previous() == url()->current() || url()->previous() == route('itens.edit', $product->id))
                   {{ route('itens.index') }}
                @else
                    {{ url()->previous() }}
                @endif
            ">Voltar</a>                                                          
        </nav>

        <div class="show-itens">
            <p><span class="show-title">ID:</span> {{ $product->id }}</p>

            @if ($product->reference)
                <p><span class="show-title">Código:</span> {{ $product->reference }}</p>
            @endif
            
            <p><span class="show-title">Nome:</span> {{ $product->name }}</p>

            @if ($product->brand)            
                <p><span class="show-title">Marca:</span> <a class="contrast" href="{{ route('marcas.show', $product->brand->id) }}">{{ $product->brand->name }}</a></p>
            @endif

            <p><span class="show-title">Valor:</span> R${{ number_format($product->price, 2, ',', '.') }}</p>
            <p><span class="show-title">Estoque:</span> {{ $product->quantity }}</p>

            @if ($product->description)
                <p><span class="show-title">Descrição:</span> {{ $product->description }}</p>
            @endif

            @if ($product->categories->count() > 0)
                <div class="product-categories">
                    <p class="show-title">Categorias: </p>
                    @foreach ($product->categories as $category)
                        <a class="product-category-link" href="{{ route('categorias.show', $category->id) }}">{{ $category->name }}</a>
                    @endforeach 
                </div>                     
            @endif
            
            <button type="button" class="edit-button" onclick="window.location.href='{{ route('itens.edit', $product->id) }}'">Editar</button>
            <button type="button" class="cancel-button" onclick="window.location.href='{{ route('itens.index') }}'">Cancelar</button>
            

        </div>
        
        

@endsection