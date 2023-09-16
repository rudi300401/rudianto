@extends('layouts.admin')
@section('header', 'Book')

@section('content')
    <div id="controller">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" autocomplete="off" placeholder="search from title"
                        v-model="search">

                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" @click="addData">Create New Book</button>
            </div>
        </div>

        <hr>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" :action="actionUrl" autocomplete="off">
                        {{--  <form method="post" action="{{ route('books.store') }}" autocomplete="off">  --}}
                        <div class="modal-header">
                            <h4 class="modal-title">Book</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf

                            <input type="hidden" name="_method" value="PUT" v-if="editstatus">

                            <div class="form-group">
                                <label>ISBN</label>
                                <input type="number" class="form-control" name="isbn" required v-model="book.isbn">
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" required v-model="book.title">
                            </div>

                            <div class="form-group">
                                <label>Year</label>
                                <input type="number" class="form-control" name="year" required v-model="book.year">
                            </div>

                            <div class="form-group">
                                <label>Publisher</label>
                                <select name="publisher_id" class="form-control" v-model="book.publisher_id">
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Author</label>
                                <select name="author_id" class="form-control" v-model="book.author_id">
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Catalog</label>
                                <select name="catalog_id" class="form-control" v-model="book.catalog_id">
                                    @foreach ($catalogs as $catalog)
                                        <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Qty Stock</label>
                                <input type="number" class="form-control" name="qty" required v-model="book.qty">
                            </div>

                            <div class="form-group">
                                <label>Harga pinjam</label>
                                <input type="number" class="form-control" name="price" required v-model="book.price">
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default bg-danger" v-if="editstatus"
                                    v-on:click="deleteData(book.id)">Delete</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12" v-for="book in filteredList">
                <div class="info-box" v-on:click="editData(book)">
                    <div class="info-box-content">
                        <span class="info-box-text h3">@{{ book.title }} (@{{ book.qty }})</span>
                        <span class="info-box-number">Rp. @{{ numberWithSpaces(book.price) }},- <small></small></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var actionUrl = '{{ url('books') }}';
        var apiUrl = '{{ url('api/books') }}';

        var app = new Vue({
            el: '#controller',
            data: {
                books: [],
                search: '',
                book: {},
                editstatus: false
            },
            mounted: function() {
                this.get_books();
            },
            methods: {
                get_books() {
                    const _this = this;
                    $.ajax({
                        url: apiUrl,
                        method: 'GET',
                        success: function(data) {
                            _this.books = JSON.parse(data);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                },
                addData() {
                    this.book = {}; // Reset the book object when adding new data
                    this.editstatus = false;
                    $('#modal-default').modal();
                },
                editData(book) {
                    this.book = Object.assign({}, book); // Use Object.assign to create a copy of the book
                    this.editstatus = true;
                    $('#modal-default').modal();
                },
                deleteData(id) {
                    console.log(id);
                },
                numberWithSpaces(x) {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
            },
            computed: {
                filteredList() {
                    return this.books.filter(book => {
                        return book.title.toLowerCase().includes(this.search.toLowerCase());
                    });
                }
            }
        });
    </script>
@endsection
