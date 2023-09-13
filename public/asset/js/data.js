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