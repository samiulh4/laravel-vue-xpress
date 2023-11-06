@extends('layouts.admin')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
@endsection
@section('content')


    <a class="btn btn-sm btn-outline-dark mb-2" style="float: right!important;" href="{{ url('admin/user/create') }}">Add</a>

    <input type="text" name="email" class="form-control mb-2 searchEmail" placeholder="Search for Email Only...">
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="usersTable">
            <thead>
            <tr>
                <th>SN</th>
                <th>Type</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#usersTable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                ajax: {
                    url: "{{ route('admin.user.index') }}",
                    data: function (d) {
                        d.email = $('.searchEmail').val(),
                        d.search = $('input[type="search"]').val()
                    }
                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'user_type_id', name: 'user_type_id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $(".searchEmail").keyup(function () {
                table.draw();
            });
        });

        function openViewModal(row) {
            $('#adminViewModal').modal('show');
        }
    </script>
@endsection
