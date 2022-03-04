@extends('admin.app')
@section('title', $pageTitle)
@section('content')
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-briefcase"></i> {{ $pageTitle }}
            </h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.brands.update', $brand) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">
                                Name <span class="m-l-5 text-danger"> *</span>
                            </label>
                            <input 
                                class="form-control @error('name') is-invalid @enderror" 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $brand->name) }}"
                            >
                            @error('name')
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                @if ($brand->image)
                                    <div class="col-md-2">
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ $brand->image_path }}" alt="{{ $brand->title }}" class="img-fluid">
                                        </figure>
                                    </div>
                                @endif
                                <div class="col-md-10">
                                    <label class="control-label">Brand Logo</label>
                                    <input 
                                        type="file" 
                                        name="image" 
                                        id="image" 
                                        class="form-control @error('image') is-invalid @enderror"
                                    >
                                    @error('image')
                                        <span class="text-danger invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Brand
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.brands.index') }}">
                            <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection