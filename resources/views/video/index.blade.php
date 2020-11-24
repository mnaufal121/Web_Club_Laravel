@extends('layouts.master')
@section('title','Resep')

@section('header')
<h1>Resep</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Video</li>
@endsection

@section('content') <div class="card" style="border-top: 3px solid #ff5a0b">

    <body>
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Data Video</h2>
                    </div>
                    <div class="pull-right mb-2">
                        <a class="btn" style="background-color: #fa6900; color: #fff" href="{{ route('video.create') }}"> Create Video</a>
                    </div>
                </div>
            </div> @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> @endif <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable-crud">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Category</th>
                                <th>Judul</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </body>
</div>
<script src="http://code.jquery.com/jquery-2.0.0.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#datatable-crud').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('video.index') }}",
                type: 'GET'
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            }, {
                data: 'category',
                name: 'category'
            }, {
                data: 'judul',
                name: 'judul'
            }, {
                data: 'action',
                name: 'action'
            }, ],
            order: [
                [0, 'asc']
            ]
        });
        $('body').on('click', '.delete', function() {
            if (confirm("Delete Video?") == true) {
                var id = $(this).data('id');
                // ajax 
                $.ajax({
                    type: "POST",
                    url: "{{ url('delete-video') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#datatable-crud').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    });
</script>
@endsection