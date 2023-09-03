{{--  @extends('layouts.admin')
@section('header', 'publisher')

@section('content')
<!-- Main content -->
   
<a href="{{ url ('publishers/create') }}" class="btn btn-sm btn-primary pull-right">Create New publisher</a>
<!-- /.card-header -->
<div class="card-body">
<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th class="text-center">name</th>
        <th class="text-center">email</th>
        <th class="text-center">phone number</th>
        <th class="text-center">address</th>
        <th class="text-center">created_at</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($publishers as $key => $publisher)
    <tr>
        <td class="text-center">{{$key+1}}</td>
        <td> {{$publisher->Name}} </td>
        <td> {{$publisher->Email}} </td>
        <td> {{$publisher->Phone_number}} </td>
        <td> {{$publisher->Address}} </td>
        <td> {{$publisher->created_at}} </td> 
        <td class="text-center"> <a href="{{ url ('publishers/'.$publisher->id. '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        
            <form action =" {{ url ('publishers',['id' => $publisher->id]) }} " method="post">
               <br> <input class="btn btn-danger btn-sm" type="submit" value="Delet" onclick="return confirm('are you sure?')">
                @method('delete')
                @csrf
            </form>
        
         @endforeach 
    </tr>
    </tbody>
</table>
</div>
@endsection  --}}
