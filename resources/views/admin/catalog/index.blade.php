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
                <h3 class="card-title">Catalog</h3>
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
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($catalogs as $key => $catalog)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td> {{$catalog->name}} </td>
                        <td class="text-center"> {{count ($catalog->books) }} </td>
                        <td class="text-center"> {{$catalog->created_at}} </td>
                        @endforeach
                    </tbody>
                </table>
                </div>
    @endsection
