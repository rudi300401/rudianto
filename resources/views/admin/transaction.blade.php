@extends('layouts.admin')
@section('header', 'transaction')

@section('css')
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div id="controller">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div>
                        <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary pull-right">Create New
                            Transaction</a>
                    </div>
                    <div class="col-md-2" style="left: 85%">
                        <select class="form-control" name="sex" id="sex">
                            <option value="0">semua jenis kelamin</option>
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-laki</option>
                        </select>
                    </div>

                </div>

                <div class="card-body p-0">
                    <table id='datatable' class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th class="text-center">Member ID</th>
                                <th class="text-center">Date Start</th>
                                <th class="text-center">Date End</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">How Many Days</th>
                                <th class="text-center">Total Book</th>
                                <th class="text-center">Total Payment</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Created at</th>
                                <th class="text-center" style="width: 150px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!--Data table-->
    <script src="{{ asset('asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript">
        var actionUrl = '{{ url('transactions') }}';
        var apiUrl = '{{ route('api.transactions') }}';

        var columns = [{
                data: 'DT_RowIndex',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'member_id',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'date_start',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'date_end',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'name',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'how_many_days',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'total_book',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'total_payment',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'status',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'created_at',
                class: 'text-center',
                orderable: true
            },
            {
                render: function(index, row, data, meta) {
                    return `
                        <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">Delete</a>
                    `;
                },
                orderable: false,
                width: '200px',
                class: 'text-center'
            },
        ];

        var controller = new Vue({
            el: '#controller',
            data: {
                datas: [],
                data: {},
                actionUrl,
                apiUrl,
                editstatus: false,
            },
            mounted() {
                this.datatable();
            },
            methods: {
                datatable() {
                    const _this = this;
                    _this.table = $('#datatable').DataTable({
                        ajax: {
                            url: _this.apiUrl,
                            type: 'GET',
                        },
                        columns: columns
                    }).on('xhr', function() {
                        _this.datas = _this.table.ajax.json().data;
                    });
                },
                addData() {
                    this.data = {};
                    /*this.actionUrl = '{{ url('authors') }}';*/
                    this.editstatus = false;
                    $('#modal-default').modal();
                },
                editData(event, row) {
                    this.data = this.datas[row];
                    /*this.actionUrl = '{{ url('authors') }}' + '/' + this.data.id;*/
                    this.editstatus = true;
                    $('#modal-default').modal();
                },
                deleteData(event, id) {
                    /*this.actionUrl = '{{ url('authors') }}';*/
                    if (confirm("Are you sure?")) {
                        $(event.target).parents('tr').remove();
                        axios.post(this.actionUrl + '/' + id, {
                            _method: 'DELETE'
                        }).then(response => {
                            alert('data has been removed');
                        });
                    }
                },
                submitForm(event, id) {
                    event.prevenDefault();
                    const _this = this;
                    var actionUrl = this.editstatus ? this.actionUrl : this.actionUrl + '/' + id;
                    axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
                        $('#modal-default').modal('hide');
                        _this.table.ajax.reload();
                    });
                },
            }
        });
    </script>
@endsection
