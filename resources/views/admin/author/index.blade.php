@extends('layouts.admin')
@section('header', 'author')

@section('content')
               
<!-- /.card-header -->
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th class="text-center">name</th>
                        <th class="text-center">emial</th>
                        <th class="text-center">phone number</th>
                        <th class="text-center">address</th>
                        <th class="text-center">created_at</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $key =>$author)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td> {{$author->name}} </td>
                        <td> {{$author->emial}} </td>
                        <td> {{$author->phone_number}} </td>
                        <td> {{$author->address}} </td>
                        <td> {{$author->created_at}} </td>
                        {{--  <td class="text-center"> {{count ($catalog->books) }} </td>
                        <td class="text-center"> {{$catalog->created_at}}</td>
                        <td class="text-center"> <a href="{{ url ('catalogs/'.$catalog->id. '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action =" {{ url ('catalogs',['id' => $catalog->id]) }} " method="post">
                           <br> <input class="btn btn-danger btn-sm" type="submit" value="Delet" onclick="return confirm('are you sure?')">
                            @method('delete')
                            @csrf
                        </form>  --}}
                        @endforeach
                        </td>
                    </tr>
                    </tbody> 
                </table>
                </div>
@endsection
