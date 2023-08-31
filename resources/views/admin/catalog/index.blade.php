    @extends('layouts.admin')
    @section('header', 'catalog')

    @section('content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <a href="{{ url ('catalogs/create') }}" class="btn btn-sm btn-primary pull-right">Create New Catalog</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Total buku</th>
                        <th>created_at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($catalogs as $key => $catalog)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td> {{$catalog->Name}} </td>
                        <td class="text-center"> {{count ($catalog->books) }} </td>
                        <td class="text-center"> {{$catalog->created_at}}</td>
                        <td class="text-center"> <a href="{{ url ('catalogs/'.$catalog->id. '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action =" {{ url ('catalogs',['id' => $catalog->id]) }} " method="post">
                           <br> <input class="btn btn-danger btn-sm" type="submit" value="Delet" onclick="return confirm('are you sure?')">
                            @method('delete')
                            @csrf
                        </form>
                        @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
    @endsection
