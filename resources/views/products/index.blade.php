@extends('shared.app')

@section('content')
    <section class="body">

        <nav class="body-nav">
            <a class="body-menu" href=""> <h2>Produtos</h2> </a>
            <span class="contrast">|</span>
            <a class="body-menu" href="">Marcas</a>
            <a class="body-menu" href="">Categorias</a>
            <a class="add-button" href="{{ route('itens.create') }}">Adicionar Produto</a>
        </nav>

        <form class="search-container" method="GET" action="{{ route('itens.index', 'search') }}">
            <input type="text" name="search" placeholder="Pesquisar produto...">
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z"/></svg>                 
            </button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><a href="{{ route('itens.show', $product->id) }}">{{ $product->id }}</a></td>
                        <td><a href="{{ route('itens.show', $product->id) }}">{{ $product->reference }}</a></td>
                        <td><a href="{{ route('itens.show', $product->id) }}">{{ $product->name }}</a></td>
                        <td><a href="{{ route('itens.show', $product->id) }}">
                            @if ($product->brand)
                                {{ $product->brand->name }} 
                            @endif
                        </a></td>
                        <td><a href="{{ route('itens.show', $product->id) }}">{{ $product->quantity }}</a></td>
                        <td><a href="{{ route('itens.show', $product->id) }}">R${{ number_format($product->price, 2, ',', '.') }}</a></td>
                        <td>^</td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
        <div class="table-footer">
            <span class="paginate-info">
                Mostrando produtos de {{ $products->firstItem() }} a {{ $products->lastItem() }}.
            </span>

            <div class="paginate-container">
                <!-- Pagination Previos and First-->
            
                <a href="{{ $products->url(1) }}" class="paginate-button @if ($products->previousPageUrl() < 1) disabled @endif">
                    Primeiro                        
                </a>
                <a href="{{ $products->previousPageUrl() }}" class="paginate-button @if ($products->previousPageUrl() < 1) disabled @endif">
                    <
                </a>                            
            

                <!-- Pagination Page Numbers-->

                @if ($products->currentPage() > 2)
                    <a class="paginate-button" href="{{ $products->url($products->currentPage() - 2)}}">{{ $products->currentPage() - 2}}</a>
                @endif
                @if ($products->currentPage() > 1)
                    <a class="paginate-button" href="{{ $products->url($products->currentPage() - 1)}}">{{ $products->currentPage() - 1}}</a>
                @endif                        
                
                <a class="paginate-current ">{{ $products->currentPage() }}</a>

                @if ($products->currentPage() < $products->lastPage())
                    <a class="paginate-button" href="{{ $products->url($products->currentPage() + 1)}}">{{ $products->currentPage() + 1}}</a>
                @endif
                @if ($products->currentPage() < $products->lastPage() - 1)
                    <a class="paginate-button" href="{{ $products->url($products->currentPage() + 2)}}">{{ $products->currentPage() + 2}}</a>
                @endif                        

                <!-- Pagination Next and Last-->
            
                <a href="{{ $products->nextPageUrl() }}" class="paginate-button @if ($products->currentPage() == $products->lastPage()) disabled @endif">
                    >
                </a>
                <a href="{{ $products->url($products->lastPage()) }}" class="paginate-button @if ($products->currentPage() == $products->lastPage()) disabled @endif">
                    Último
                </a>                            
            
            </div>
            
            <span class="paginate-info">
                Total de {{ $products->total() }} registros encontrados.
            </span>
                
        </div>
    </section>
    
@endsection

