@extends('layouts.admin')
@section('header', 'author')

@push('css')
    <style type="text/css">

    </style>
@endpush


@section('css')

@endsection


@section('content')
    <div id="controller">
        <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Create New
            Author</a>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th class="text-center">name</th>
                        <th class="text-center">emial</th>
                        <th class="text-center">phone number</th>
                        <th class="text-center">address</th>
                        <th class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($authors as $key => $author)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td> {{ $author->name }} </td>
                            <td> {{ $author->email }} </td>
                            <td> {{ $author->phone_number }} </td>
                            <td> {{ $author->address }} </td>
                            <td class="text-right">
                                <a href="#" @click="editData({{ $author }})"
                                    class="btn btn-warning btn-sm">edit</a>
                                <a href="#" @click="deleteData({{ $author->id }})"
                                    class="btn btn-danger btn-sm">delet</a>
                            </td>
                    @endforeach

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" :action="actionUrl" autocomplete="off">
                        <div class="modal-header">
                            <h4 class="modal-title">Author</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                            <div class="form-group">
                                <label>name</label>
                                <input type="text" class="form-control" name='name' :value="data.name"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input type="text" class="form-control" name='email' :value="data.email"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>phone number</label>
                                <input type="text" class="form-control" name='phone_number' :value="data.phone_number"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>address</label>
                                <input type="text" class="form-control" name='address' :value="data.address"
                                    required="">
                            </div>




                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        var controller = new Vue({
            el: '#controller',
            data: {
                data: {},
                actionUrl: '{{ url('authors') }}',
                editStatus: false
            },
            methods: {
                addData() {
                    this.data = {};
                    this.editStatus = false,
                        this.actionUrl = '{{ url('authors') }}';

                    $('#modal-default').modal('show');
                },
                editData(data) {
                    this.data = data;
                    this.editStatus = true,
                        this.actionUrl = '{{ url('authors') }}' + '/' + data.id;
                    $('#modal-default').modal('show');
                },
                deleteData(id) {
                    this.actionUrl = '{{ url('authors') }}' + '/' + id;
                    if (confirm("Are you sure?")) {
                        axios.post(this.actionUrl, {
                            _method: 'DELETE'
                        }).then(response => {
                            location.reload();
                        });
                    }
                }
            }
        });
    </script>

@endsection
