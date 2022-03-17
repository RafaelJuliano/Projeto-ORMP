@extends('shared.app')

@section('content')
    <section class="body">        

        <nav class="body-nav">
            <a class="body-menu" href=""> <h2>Cadastrar Cliente</h2> </a>
            <a class="back-button" href="
                @if(url()->previous() == url()->current())
                   {{ route('clientes.index') }}
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

        <form class="create-form" method="post" action="{{ route('clientes.store') }}">
            {{ csrf_field() }}

            <div class="form-line">
                <h3>Dados</h3>
            </div> 

            <div class="form-line">

                <div class="form-item form-large">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" placeholder="João da Silva">
                </div>  
                
            </div>  
            
            <div class="form-line">
                
                <div class="form-item form-small">
                    <label for="PForPJ">Tipo</label>
                    <select name="PForPJ" id="PForPJ" onchange="changeType()">
                        <option value="PF">Pessoa Física</option>
                        <option value="PJ">Pessoa Jurídica</option>
                    </select>
                </div>   

                <div class="form-item form-small" id="cpf">
                    <label for="cpf_cnpj">CPF</label>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" maxlength="14" onkeyup="validateCPF()" onblur="validateCPF()" >
                </div>

                <div class="form-item form-small" id="cnpj" style="display: none">
                    <label for="cpf_cnpj">CNPJ</label>
                    <input type="text" name="" id="cpf_cnpj" maxlength="18" onkeyup="validateCNPJ()" onblur="validateCNPJ()" >
                </div>

                <div class="form-item form-small" id="rg">
                    <label for="rg_ie">RG</label>
                    <input type="text" name="rg_ie" id="rg_ie" maxlength="14">
                </div>

                <div class="form-item form-small" id="ie" style="display: none">
                    <label for="rg_ie">Inscrição Estadual</label>
                    <input type="text" name="rg_ie" id="rg_ie" maxlength="14">
                </div>

                <div class="form-item form-small">
                    <label for="gender">Gênero</label>
                    <select name="gender" id="gender">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="B">Não Binário</option>
                    </select>
                </div>

            </div>

            <div class="form-line">
                <div class="form-item form-small">
                    <label for="phone">Telefone</label>
                    <input type="text" name="phone" id="phone" maxlength="15" onkeyup="validatePhone('phone')" onblur="validatePhone('phone')">
                </div>

                <div class="form-item form-small">
                    <label for="cellphone">Celular</label>
                    <input type="text" name="cellphone" id="cellphone" maxlength="15" onkeyup="validatePhone('cellphone')" onblur="validatePhone('cellphone')">
                </div>

                <div class="form-item form-medium">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" maxlength="30">
                </div>
            </div>

            <div class="form-line">
                <h3 style="margin-top: 1%">Endereço</h3>
            </div>       
            
            <div class="form-line">

                <div class="form-item form-small">
                    <label for="zip">CEP</label>
                    <input type="text" name="zip" id="zip" onblur="getCEP()" onkeyup="getCEP()">                    
                </div>

                <div class="form-item form-medium">
                    <label for="address">Endereço</label>
                    <input type="text" name="address" id="address">                    
                </div>

                <div class="form-item form-smaller">
                    <label for="number">Número</label>
                    <input type="text" name="number" id="number">                    
                </div>
            </div>

            <div class="form-line">

                <div class="form-item form-small">
                    <label for="neighborhood">Bairro</label>
                    <input type="text" name="neighborhood" id="neighborhood">                    
                </div>

                <div class="form-item form-small">
                    <label for="state">Estado</label>
                    <select type="text" name="state" id="state" onclick="searchCities()" onfocus="searchUf()">
                    </select>
                </div>

                <div class="form-item form-small">
                    <label for="city">Cidade</label>
                    <select type="text" name="city" id="city" onfocus="searchCities()">
                    </select>    
                </div>

                 <div class="form-item form-small">
                    <label for="country">País</label>
                    <select type="text" name="country" id="country">
                        <option value="BRA" selected>Brasil</option>
                    </select>    
                </div>

            </div>  

            <div class="button-container">
                <button class="save-button" type="submit">Salvar</button>
                <button type="button" class="cancel-button" onclick="window.location.href='@if(url()->previous() == url()->current()){{ route('categorias.index') }}@else{{ url()->previous() }}@endif'">Cancelar</button>
            </div>                            
        </form>

    </section>

@endsection