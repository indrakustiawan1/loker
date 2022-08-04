@extends('layouts.backend')
@section('title', 'User')
@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <h5 class="breadcrumb-item">DATA USER</h5>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalUser" id="btn-addUser">Tambah</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dtUser">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Info</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formUser">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="js-example-basic-single" style="width: 100%" id="level" name="level">
                            <option value="" disabled selected>pilih</option>
                            @foreach ($roles as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger err" id="level_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="example">
                        <small class="text-danger err" id="name_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="example@email.com">
                        <small class="text-danger err" id="email_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder=".........">
                        <small class="text-danger err" id="password_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password Konfirmasi</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="off" placeholder=".........">
                        <small class="text-danger err" id="password_confirmation_error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary cancel" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        
        var SITEURL = "{{ route('user') }}";
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#dtUser').DataTable({
            responsive: true,
            paging: true,
            bDestroy: true,
            searching: true,
            ordering: false,
            lengthChange: true,
            autoWidth: false,
            aaSorting: [],
            serverSide: true,
            processing: true,

            ajax: {
                type: 'POST',
                url: "{{ route('user-list') }}"
            },

            columns: [{
                    orderable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    width: '20px',
                    className: 'text-center'
                },
                {
                    data: 'info',
                    name: 'info',
                },
                {
                    data: 'level',
                    name: 'level',
                },
                {
                    data: 'action',
                    orderable: false,
                    width: '80px',
                    className: 'text-center'
                },
            ]
        });

        // create
        $('#formUser').submit(function(e) {
            e.preventDefault();
            formData = new FormData($('#formUser')[0]);

            $.ajax({
                type: 'POST',
                url: SITEURL,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.err').empty();
                    $('#btn-save').attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
                },
                success: function(response) {
                    $('#btn-save').attr('disabled', false).html('Simpan');
                    if (response.status == false) {
                        $.each(response.error, function(i, val) {
                            $("#" + i + "_error").html(val[0])
                        });
                    } else {
                        $('#modalUser').modal('hide');
                        $('#dtUser').DataTable().ajax.reload(null, false);
                        reset()
                    }
                }
            });
        });

        // edit
        $(document).on('click', '#btn-editUser', function() {
            id = $(this).data('id')
            $.ajax({
                type: "get",
                url: SITEURL + "/" + id + "/edit",
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        $('#modalUser').modal('show');
                        $('#id').val(response.data.id)
                        $('#name').val(response.data.name)
                        $('#email').val(response.data.email)
                        $('#level').val(response.data.roles[0].id).change()
                    } else {
                        console.error('Data tidak ditemukan.');
                    }
                }
            });
        });
        
        $('#btn-addUser').click(function(e) {
            e.preventDefault();
            $('#userModalLabel').html('Tambah User');
            $('#modalUser').modal('show');
        });
        

        $('.cancel').click(function(e) {
            e.preventDefault();
            reset()
        });

        function reset() {
            $('#formUser').trigger('reset');
            $('.err').empty();
            $('#level').val('').trigger('change');
        }
    });
</script>
@endsection