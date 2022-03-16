@extends('shared.app')

@section('content')
    <section class="body">

        <nav class="body-nav">
            <a class="body-menu" href=""> <h2>Clientes</h2> </a>
            <a class="add-button" href="{{ route('clientes.create') }}">Adicionar Clientes</a>            
        </nav>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            
        @endif

        <form class="search-container" method="GET" action="{{ route('clientes.index', 'search') }}">
            <input type="text" name="search" placeholder="Pesquisar cliente...">
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z"/></svg>                 
            </button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CNPJ</th>
                    <th>Nome</th>                    
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td class="td-id" onclick="window.location.href='{{ route('clientes.show', $customer->id) }}'"><a href="{{ route('itens.show', $customer->id) }}">{{ $customer->id }}</a></td>
                        <td class="td-reference" onclick="window.location.href='{{ route('clientes.show', $customer->id) }}'"><a href="{{ route('clientes.show', $customer->id) }}">{{ $customer->cpf_cnpj }}</a></td>
                        <td class="td-name" onclick="window.location.href='{{ route('clientes.show', $customer->id) }}'">{{ $customer->name }}</td>                        
                        <td class="td-actions">
                            <div>
                                <!-- Show buton -->
                                <a class="actions" href="{{ route('clientes.show', $customer->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path d="M13 10h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2zm8.172 14l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z"/></svg>
                                </a>                                
                                <!-- Edit buton -->
                                <a class="actions" href="{{ route('clientes.edit', $customer->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path d="M14.078 7.061l2.861 2.862-10.799 10.798-3.584.723.724-3.585 10.798-10.798zm0-2.829l-12.64 12.64-1.438 7.128 7.127-1.438 12.642-12.64-5.691-5.69zm7.105 4.277l2.817-2.82-5.691-5.689-2.816 2.817 5.69 5.692z"/></svg>
                                </a>                                
                                <!-- Delete buton -->
                                <form action="{{ route('clientes.destroy', $customer->id) }}" method="POST" class="method-form">
                                    @method('DELETE')
                                    {{ csrf_field() }}
                                    <button type="submit" class="actions" onclick="return confirm('Deseja remover o cliente {{ $customer->name }}?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill-rule="evenodd" clip-rule="evenodd"><path d="M5.662 23l-5.369-5.365c-.195-.195-.293-.45-.293-.707 0-.256.098-.512.293-.707l14.929-14.928c.195-.194.451-.293.707-.293.255 0 .512.099.707.293l7.071 7.073c.196.195.293.451.293.708 0 .256-.097.511-.293.707l-11.216 11.219h5.514v2h-12.343zm3.657-2l-5.486-5.486-1.419 1.414 4.076 4.072h2.829zm.456-11.429l-4.528 4.528 5.658 5.659 4.527-4.53-5.657-5.657z"/></svg>
                                    </button> 
                                </form>                               
                            </div>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
        <div class="table-footer">
            <span class="paginate-info">
                Mostrando clientes de {{ $customers->firstItem() }} a {{ $customers->lastItem() }}.
            </span>

            <div class="paginate-container">
                <!-- Pagination Previos and First-->
            
                <a href="{{ $customers->url(1) }}" class="paginate-button @if ($customers->previousPageUrl() < 1) disabled @endif">
                    Primeiro                        
                </a>
                <a href="{{ $customers->previousPageUrl() }}" class="paginate-button @if ($customers->previousPageUrl() < 1) disabled @endif">
                    <
                </a>                            
            

                <!-- Pagination Page Numbers-->

                @if ($customers->currentPage() > 2)
                    <a class="paginate-button" href="{{ $customers->url($customers->currentPage() - 2)}}">{{ $customers->currentPage() - 2}}</a>
                @endif
                @if ($customers->currentPage() > 1)
                    <a class="paginate-button" href="{{ $customers->url($customers->currentPage() - 1)}}">{{ $customers->currentPage() - 1}}</a>
                @endif                        
                
                <a class="paginate-current ">{{ $customers->currentPage() }}</a>

                @if ($customers->currentPage() < $customers->lastPage())
                    <a class="paginate-button" href="{{ $customers->url($customers->currentPage() + 1)}}">{{ $customers->currentPage() + 1}}</a>
                @endif
                @if ($customers->currentPage() < $customers->lastPage() - 1)
                    <a class="paginate-button" href="{{ $customers->url($customers->currentPage() + 2)}}">{{ $customers->currentPage() + 2}}</a>
                @endif                        

                <!-- Pagination Next and Last-->
            
                <a href="{{ $customers->nextPageUrl() }}" class="paginate-button @if ($customers->currentPage() == $customers->lastPage()) disabled @endif">
                    >
                </a>
                <a href="{{ $customers->url($customers->lastPage()) }}" class="paginate-button @if ($customers->currentPage() == $customers->lastPage()) disabled @endif">
                    Último
                </a>                            
            
            </div>
            
            <span class="paginate-info">
                Total de {{ $customers->total() }} registros encontrados.
            </span>
                
        </div>
    </section>
    
@endsection

