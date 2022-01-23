@extends('shared.app')

@section('content')
    <section class="body">        

        <nav class="body-nav">
            <a class="body-menu" href=""> <h2>Editar marca</h2> </a>
            <a class="back-button" href="
                @if(url()->previous() == url()->current())
                   {{ route('marcas.index') }}
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

        <form class="create-form" method="post" action="{{ route('marcas.update', $brand->id) }}">
            @method('PUT')
            {{ csrf_field() }}

            <div class="form-line">

                <div class="form-item form-large">
                    <label for="name">Nome da marca</label>
                    <input type="text" name="name" id="name" value="{{ $brand->name }}">
                </div>   
            </div>         

            <div class="button-container">
                <button class="save-button" type="submit">Salvar</button>
                <button type="button" class="cancel-button" onclick="window.location.href='@if(url()->previous() == url()->current()){{ route('marcas.index') }}@else{{ url()->previous() }}@endif'">Cancelar</button>
            </div>            
        </form>

    </section>

@endsection