const root = document.documentElement;
 
document.addEventListener('mousemove', evt => {
    let x = evt.clientX / innerWidth;
    let y = evt.clientY / innerHeight;
 
    root.style.setProperty('--mouse-x', x);
    root.style.setProperty('--mouse-y', y);
});

function changeCheckbox(id){        
    var checkbox = document.getElementById(id);
    if(checkbox.checked == true){
        checkbox.checked = false;
    }else{
        checkbox.checked = true;
    }
}

function validateCPF(){   
    var cpf_cnpj=document.getElementById("cpf").children[1].value; 
    var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}))$/;     
    if (cpfValido.test(cpf_cnpj) == false)    {  
       cpf_cnpj = cpf_cnpj.replace(/[^\d]+/g,'');
       document.getElementById("cpf").children[1].value = cpf_cnpj.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    }   
}

function validateCNPJ(){    
    var cpf_cnpj=document.getElementById("cnpj").children[1].value;  
    var cpfValido = /^(([0-9]{2}.[0-9]{3}.[0-9]{3}[\/][0-9]{4}-[0-9]{2}))$/;     
    if (cpfValido.test(cpf_cnpj) == false)    {  
       cpf_cnpj = cpf_cnpj.replace(/[^\d]+/g,'');        
       document.getElementById("cnpj").children[1].value = cpf_cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
    }   
}

function validatePhone(type){
    console.log(type);
    var phone = document.getElementById(type).value;
    var phoneValido1 = /^(([\(][0-9]{2}[\)][ ][0-9]{4}[\-][0-9]{4}))$/;
    var phoneValido2 = /^(([\(][0-9]{2}[\)][ ][0-9]{5}[\-][0-9]{4}))$/;
    if (phoneValido1.test(phone) == false || phoneValido2.test(phone) == false){  
        phone = phone.replace(/[^\d]+/g,'');
        if (phone.length == 10){
            document.getElementById(type).value = phone.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
        }else if (phone.length == 11){
            document.getElementById(type).value = phone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
        }
    }
}

function changeType(){
    document.querySelectorAll('#cpf_cnpj').forEach(function(item){
        item.value = '';
    });

    document.querySelectorAll('#rg_ie').forEach(function(item){
        item.value = '';
    });

    var type = document.getElementById("PForPJ").value;  

    var cpf = document.getElementById("cpf");
    var cnpj = document.getElementById("cnpj");
    var rg = document.getElementById("rg");
    var ie = document.getElementById("ie");

    if (type == "PJ"){
        cpf.style.display = "none";
        cnpj.style.display = "flex";
        rg.style.display = "none";
        ie.style.display = "flex";

        cpf.children[1].required = false;
        cnpj.children[1].required = true;

        cpf.children[1].name = 'trash';
        cnpj.children[1].name = 'cpf_cnpj';

        rg.children[1].name = 'trash';
        ie.children[1].name = 'rg_ie';
    }else{
        cpf.style.display = "flex";
        cnpj.style.display = "none";
        rg.style.display = "flex";
        ie.style.display = "none";

        cpf.children[1].name = 'cpf_cnpj';
        cnpj.children[1].name = 'trash';

        cpf.children[1].required = true;
        cnpj.children[1].required = false;

        rg.children[1].name = 'rg_ie';
        ie.children[1].name = 'trash';
    }


    // document.querySelectorAll("#cpf").forEach(function(item){
    //     if(type == "PF"){
    //         item.style.display = "flex";            
    //     } else if (type == "PJ"){
    //         item.style.display = "none";            
    //     }
    // });
    // document.querySelectorAll("#cnpj").forEach(function(item){
    //     if(type == "PJ"){
    //         item.style.display = "flex";           
    //     } else if (type == "PF"){
    //         item.style.display = "none";           
    //     }
    // });    
}

function searchUf(){
    var url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
    fetch(url)
    .then(response => response.json())
    .then(data => {
        var select = document.getElementById("state");
        select.innerHTML = "";
        data.forEach(element => {
            var option = document.createElement("option");
            option.text = element.nome;
            option.value = element.sigla;
            select.add(option);
        });
    });
}

function searchCities(){
    var uf = document.getElementById("state").value;
    var url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/"+uf+"/municipios";
    fetch(url)
    .then(response => response.json())
    .then(data => {
        var select = document.getElementById("city");
        select.innerHTML = "";
        data.forEach(element => {
            var option = document.createElement("option");
            option.text = element.nome;
            option.value = element.nome;
            select.add(option);
        });
    });
}

function getCEP(){
    var cep = document.getElementById("zip").value;
    if (cep.length >= 8){
        var url = "https://viacep.com.br/ws/"+cep+"/json/";
        fetch(url)
        .then(response => response.json())
        .then(data => {          
            if (data.erro != true){         
                document.getElementById("address").value = data.logradouro;
                document.getElementById("neighborhood").value = data.bairro;
                document.getElementById("city").innerHTML = "<option value='"+data.localidade+"' selected>"+data.localidade+"</option>";
                document.getElementById("state").innerHTML = "<option value='"+data.uf+"' selected>"+data.uf+"</option>";
            }       
        });
    }   
}


