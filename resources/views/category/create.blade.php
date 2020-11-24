@extends('layouts.master')
@section('title','Category')

@section('header')
<h1>Category</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{URL::to('/category')}}" style="color: #fa6900">Category</a>
</li>
<li class="breadcrumb-item active">Create Category</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-conten-center">
        <div class="col-md-12">
            <div class="card-header bg-transparent">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left mb-2">
                            <h2>Add Category</h2>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                <div class="card-body"> @if(session('status'))
                    <div class="alert alert-success mb-1 mt-1"> {{ session('status') }} </div> @endif
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Category:</strong>
                                <input type="text" name="category" class="form-control" placeholder="Category"> @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ URL::to('/category') }}" class="btnbtn-outline-info">Back</a>
                    <button type="submit" class="btn float-right" style="background-color: #fa6900; color: #fff"> {{ __('Submit') }} </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection