@extends('admin.app')
@section('title', $pageTitle)
@section('content')
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-tags"></i> {{ $pageTitle }}
            </h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" role="form" enctype="multipart/form-data">
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
                                value="{{ old('name', $category->name) }}"
                            >
                            @error('name') 
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                rows="4" 
                                name="description" 
                                id="description"
                            >{{ old('description', $category->description) }}
                            </textarea>
                            @error('description')
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="parent">
                                Parent Category <span class="m-l-5 text-danger"> *</span>
                            </label>
                            <select 
                                id=parent 
                                class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror" name="parent_id"
                            >
                                <option value="0">Select a parent category</option>
                                @foreach($categories as $cat)
                                    @if ($category->parent_id == $cat->id)
                                        <option value="{{ $cat->id }}" selected> {{ $cat->name }} </option>
                                    @else
                                        <option value="{{ $cat->id }}"> {{ $cat->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('parent_id')
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="featured" 
                                        name="featured"
                                        {{ $category->featured == 1 ? 'checked' : '' }}
                                    >
                                        Featured Category
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="menu" 
                                        name="menu"
                                        {{ $category->menu == 1 ? 'checked' : '' }}
                                    >
                                        Show in Menu
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                @if ($category->image)
                                <div class="col-md-2">
                                    <figure class="mt-2" style="width: 80px; height: auto;">
                                        <img src="{{ asset('storage/'.$category->image) }}" id="categoryImage" class="img-fluid" alt="img">
                                    </figure>
                                </div>
                            @endif
                            <div class="col-md-10">
                                <label class="control-label">Category Image</label>
                                <input 
                                    class="form-control @error('image') is-invalid @enderror" 
                                    type="file" 
                                    id="image" 
                                    name="image"
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
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Category
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">
                            <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection