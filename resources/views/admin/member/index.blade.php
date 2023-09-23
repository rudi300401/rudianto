@extends('layouts.admin')
@section('header', 'member')

@section('css')
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div id="controller">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">add member</a>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="sex" id="sex">
                            <option value="0">semua jenis kelamin</option>
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-laki</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body"></div>
        </div>
    </div>
    <div class="modal fade" id="modal-default"></div>
@endsection

@push('js')
    <script src="{{ asset('asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('ja/data.js') }}"></script>
    <script type="text/javascript">
        var actionUrl = '{{ url('data/member') }}';
        var columns = [{
                data: 'name',
                className: 'text-center',
                orderable: true
            },
            {
                data: 'sex',
                className: 'text-center',
                orderable: true
            },
            {
                data: 'phone',
                className: 'text-center',
                orderable: true
            },
            {
                data: 'address',
                className: 'text-center',
                orderable: true
            },
            {
                data: 'email',
                className: 'text-center',
                orderable: true
            },
            {
                render: function(data, type, row) {
                    return `
                        <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${row.id})">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${row.id})">Delete</a>
                    `;
                },
                orderable: false,
                width: '100px',
                className: 'text-center'
            },
        ];
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var sex = $('#sex');
            var controller = {
                table: null,
                editData: function(event, id) {
                    //
                },
                deleteData: function(event, id) {
                    //
                }
            };

            controller.table = $('#controller').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: actionUrl,
                    data: function(d) {
                        d.sex = sex.val();
                    }
                },
                columns: columns,
            });

            sex.on('change', function() {
                controller.table.ajax.reload();
            });
        });
    </script>
@endpush
