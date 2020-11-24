@extends('layouts.master')
@section('title','Resep')

@section('header')
<h1>Resep</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{URL::to('/resep')}}" style="color: #fa6900">Resep</a>
</li>
<li class="breadcrumb-item active">Create Resep</li>
@endsection

@section('content') <div class="container">
    <div class="row justify-conten-center">
        <div class="col-md-12">
            <div class="card-header bg-transparent">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left mb-2">
                            <h2>Add Resep</h2>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('resep.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                <div class="card-body"> @if(session('status'))
                    <div class="alert alert-success mb-1 mt-1"> {{ session('status') }} </div> @endif
                    <style>
                        #select2-id_category-container.select2-selection__rendered {
                            line-height: 20px;
                        }
                    </style>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group"> <label for="name" class="col-sm-12 control-label">Gambar</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" name="gambar" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Category</label>
                                <div class="col-sm-12">
                                    <select class="form-control searchCategory input_id_category" id="id_category" name="id_category" style="width: 100%;" required></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Judul</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="judul" name="judul" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">resep</label>
                                <div class="col-sm-12">
                                    <textarea id="resep" name="resep" rows="5" cols="100"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ URL::to('/resep') }}" class="btn btn-outline-info">Back</a>
                    <button type="submit" class="btn float-right" style="background-color: #fa6900; color: #fff"> {{ __('Submit') }} </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-2.0.0.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(".searchCategory").select2({
        placeholder: "Category",
        ajax: {
            url: "/getCategory",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        item_text = item.category;
                        return {
                            text: item_text,
                            id: item.id
                        };
                    })
                };
            },
            cache: false
        }
    }).on('change', function(e) {});
</script>
@endsection