<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customers\Contact;
use App\Models\customers\Customer;
use Illuminate\Validation\Rule;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::where('name', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%")
            ->orWhere('cpf_cnpj', 'like', "%{$search}%")
            ->paginate(20);
        
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:130',
            'cpf_cnpj' => Rule::unique('customers', 'cpf_cnpj'),
            'rg_ie' => 'max:14',
            'email' => 'max:255',
            'phone' => 'max:15',
            'cellphone' => 'max:15',
            'address' => 'max:255',
            'number' => 'max:10',
            'city' => 'max:30',
            'state' => 'max:2',
            'zip' => 'max:10',
            'complement' => 'max:10'
        ]);    
        

        // if (isset(Customer::where('cpf_cnpj', $request->cpf_cnpj)->first()->id)) {
        //     return redirect()->route('clientes.create')->with('error', 'CPF ou CNPJ já cadastrado!');
        // }        
      
        $data = $request->all();

        $customer = Customer::create($data);
        $customer = Customer::find($customer->id);

        if(isset($data['contact'])){
            foreach($data['contact'] as $contact){ 
                $newContact = new Contact();
                $newContact->name = $contact['name'];
                $newContact->email = $contact['email'];  
                $newContact->phone = $contact['phone'];         
                
                $customer->contacts()->save($newContact);
            }           
        }

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('test', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:130',
            'cpf_cnpj' => 'required|max:18',
            'rg_ie' => 'max:14',
            'email' => 'max:255',
            'phone' => 'max:14',
            'address' => 'max:255',
            'number' => 'max:10',
            'city' => 'max:30',
            'state' => 'max:2',
            'zip' => 'max:10',
            'complement' => 'max:10'
        ]);



        $data = $request->all();
        $customer = Customer::find($id);
        $customer->update($data);

        if(isset($data['contacts'])){
            foreach($data['contacts'] as $contact){
                if(isset($contact['id'])){                    
                    Contact::find($contact['id'])->update($contact);
                }else{
                    $contact['customer_id'] = $customer->id;
                    Contact::create($contact);
                }
            }
        }
        return redirect()->route('customers.show', $customer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
