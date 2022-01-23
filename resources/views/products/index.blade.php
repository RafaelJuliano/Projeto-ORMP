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

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            
        @endif

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
                    <th>Nome do Produto</th>
                    <th>Marca</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="td-id" onclick="window.location.href='{{ route('itens.show', $product->id) }}'"><a href="{{ route('itens.show', $product->id) }}">{{ $product->id }}</a></td>
                        <td class="td-reference" onclick="window.location.href='{{ route('itens.show', $product->id) }}'"><a href="{{ route('itens.show', $product->id) }}">{{ $product->reference }}</a></td>
                        <td class="td-name" onclick="window.location.href='{{ route('itens.show', $product->id) }}'">{{ $product->name }}</td>
                        <td class="td-brand"><a href="{{ route('itens.show', $product->id) }}">
                            @if ($product->brand)
                                {{ $product->brand->name }} 
                            @endif
                        </a></td>
                        <td class="td-quantity"><a href="{{ route('itens.show', $product->id) }}">{{ $product->quantity }}</a></td>
                        <td class="td-price"><a href="{{ route('itens.show', $product->id) }}">R${{ number_format($product->price, 2, ',', '.') }}</a></td>
                        <td class="td-actions">
                            <div>
                                <!-- Show buton -->
                                <a class="actions" href="{{ route('itens.show', $product->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path d="M13 10h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2zm8.172 14l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z"/></svg>
                                </a>                                
                                <!-- Edit buton -->
                                <a class="actions" href="{{ route('itens.edit', $product->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path d="M14.078 7.061l2.861 2.862-10.799 10.798-3.584.723.724-3.585 10.798-10.798zm0-2.829l-12.64 12.64-1.438 7.128 7.127-1.438 12.642-12.64-5.691-5.69zm7.105 4.277l2.817-2.82-5.691-5.689-2.816 2.817 5.69 5.692z"/></svg>
                                </a>                                
                                <!-- Delete buton -->
                                <a class="actions" href="{{ route('itens.destroy', $product->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill-rule="evenodd" clip-rule="evenodd"><path d="M5.662 23l-5.369-5.365c-.195-.195-.293-.45-.293-.707 0-.256.098-.512.293-.707l14.929-14.928c.195-.194.451-.293.707-.293.255 0 .512.099.707.293l7.071 7.073c.196.195.293.451.293.708 0 .256-.097.511-.293.707l-11.216 11.219h5.514v2h-12.343zm3.657-2l-5.486-5.486-1.419 1.414 4.076 4.072h2.829zm.456-11.429l-4.528 4.528 5.658 5.659 4.527-4.53-5.657-5.657z"/></svg>
                                </a>                                
                            </div>                            
                        </td>
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

