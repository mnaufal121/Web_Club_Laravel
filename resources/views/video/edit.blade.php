@extends('layouts.master') 
@section('title','Video') 

@section('header') 
<h1>Video</h1> 
@endsection 

@section('breadcrumb') 
<li class="breadcrumb-item">
    <a href="{{URL::to('/video')}}" style="color: #fa6900">Video</a>
</li>
<li class="breadcrumb-item active">Edit Video</li> 
@endsection 

@section('content') 
<div class="container">
    <div class="row justify-conten-center">
        <div class="col-md-12">
            <div class="card-header bg-transparent">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left mb-2">
                            <h2>Update Video</h2>
                        </div>
                    </div>
                </div>
            </div> @if(session('status')) 
            <div class="alert alert-success mb-1 mt-1"> {{ session('status') }} </div> @endif 
            <form action="{{ route('video.update',$video->id) }}" method="POST" enctype="multipart/form-data"> @csrf {{ method_field('PUT') }}
                <style>
                    #select2-id_category-container.select2-selection__rendered {
                        line-height: 20px;
                    }
                </style>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="col-sm-12"> {!!$video->video !!} </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12"> 
                                    <input placeholder="Video" id="video" type="text" name="video" class="form-control"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="form-control searchCategory input_id_category" id="id_category" name="id_category"></select> 
                                </div>
                            </div>
                            <div class="form-group"> 
                                <label for="name" class="col-sm-12 control-label">Judul</label>
                                <div class="col-sm-12"> 
                                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $video->judul }}" required> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent"> 
                    <a href="{{ URL::to('/video') }}" class="btn btn-outline-info">Back</a> 
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
    <?php $category_id = $video->id_category;
    echo "var category_id = '$category_id';";
    $category_name = isset($video->category->category) ? $video->category->category : "";
    echo "var category_name = '$category_name';"; ?>searchCategory = $('.searchCategory');
    var $option = $('<option selected="selected"></option>').val(category_id).text(category_name);
    searchCategory.append($option).trigger('change');
    $(".searchCategory").select2({
        placeholder: "Category",
        ajax: {
            url: "/getCategory_video",
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