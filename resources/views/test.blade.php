


@foreach ( $customer->contacts as $contact)
    <p>{{ $contact->name }} </p>  
    <p>{{ $contact->phone }} </p> 
    <p>-----------------</p>
@endforeach

