@extends('template.admin')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Master {{ $title }}</h4>
                <div class="text-end">
                    <a href="#" class="btn btn-sm icon icon-left btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalInsert"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-edit">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg> Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Short Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('modal')
    <form class="form form-vertical">
        <div class="form-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group has-icon-left">
                        <label for="first-name-icon">Category Name</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" name="name" placeholder="Category name"
                                id="first-name-icon">
                            <div class="form-control-icon">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group has-icon-left">
                        <label for="email-id-icon">Short Name</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" name="short_name" placeholder="Short name category"
                                id="email-id-icon">
                            <div class="form-control-icon">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group has-icon-left">
                        <label for="password-id-icon">Description</label>
                        <div class="position-relative">
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <div class="form-control-icon">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endpush

@push('scripts')
    <script>
        let idKey = null;
        $('#insertFormModal').on('submit', function(e) {
            let data = new FormData(this);
            if (idKey) {
                data.append('id', idKey);
            }
            e.preventDefault();
            $.ajax({
                url: idKey ? '/api/v1/master/category/update' : '/api/v1/master/category',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: res => {
                    let table = $('#table').DataTable();
                    $('#modalInsert').modal('hide')
                    table.ajax.reload(null, true);
                },
                error: err => {
                    console.error(err);
                }
            })
        })

        function get() {
            $('#table').DataTable().destroy();
            $(`#table`).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/api/v1/master/category',
                    type: "GET",
                },
                language: {
                    search: "Search Data:",
                    searchPlaceholder: "Search",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'short_name',
                        name: 'short_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });
        }

        function getById(id) {
            $.ajax({
                url: '/api/v1/master/category/' + id,
                success: res => {
                    $('form input[name="name"]').val(res.data.name)
                    $('form input[name="short_name"]').val(res.data.short_name)
                    $('form input[name="description"]').val(res.data.description)
                    idKey = res.data.id
                    $('#modalInsert').modal('show')
                },
                error: err => {
                    console.error(err);
                }
            })
        }

        $('#table').on('click', '.Edit', function() {
            let id = $(this).data('value')
            $('#modalInsertPoint').text('Update data category')
            getById(id);
        })
        get();
    </script>
@endpush
