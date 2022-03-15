<form action="{{ route('admin.products.update', $product) }}" method="POST" role="form">
    @csrf
    @method('PUT')
    <h3 class="tile-title">Product Information</h3>
    <hr>
    <div class="tile-body">
        <div class="form-group">
            <label class="control-label" for="name">Name</label>
            <input
                class="form-control @error('name') is-invalid @enderror"
                type="text"
                placeholder="Enter product name"
                id="name"
                name="name"
                value="{{ old('name', $product->name) }}"
            >
            @error('name')
                <span class="text-danger invalid-feedback">
                    <i class="fa fa-exclamation-circle fa-fw"></i> 
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="sku">SKU</label>
                    <input
                        class="form-control @error('sku') is-invalid @enderror"
                        type="text"
                        placeholder="Enter product sku"
                        id="sku"
                        name="sku"
                        value="{{ old('sku', $product->sku) }}"
                    />
                    @error('sku')
                        <span class="text-danger invalid-feedback">
                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="brand">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                        <option value="0">Select a brand</option>
                        @foreach($brands as $brand)
                            @if ($brand->id === $product->brand_id)
                                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                            @else
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('brand_id')
                        <span class="text-danger invalid-feedback">
                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="categories">Categories</label>
                    <select name="categories[]" id="categories" class="form-control @error('categories[]') is-invalid @enderror" multiple>
                        @foreach ($categories as $category)
                            @php
                                $selected = in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : ''
                            @endphp
                            <option value="{{ $category->id }}" {{ $selected }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories[]')
                        <span class="text-danger invalid-feedback">
                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="price">Price</label>
                    <input
                        class="form-control @error('price') is-invalid @enderror"
                        type="text"
                        placeholder="Enter product price"
                        id="price"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                    >
                    @error('price')
                        <span class="text-danger invalid-feedback">
                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="sale_price">Sale Price</label>
                    <input
                        class="form-control @error('sale_price') is-invalid @enderror"
                        type="text"
                        placeholder="Enter product sale price"
                        id="sale_price"
                        name="sale_price"
                        value="{{ old('sale_price', $product->sale_price) }}"
                    >
                    @error('sale_price')
                        <span class="text-danger invalid-feedback">
                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="quantity">Quantity</label>
                    <input
                        class="form-control @error('quantity') is-invalid @enderror"
                        type="number"
                        placeholder="Enter product quantity"
                        id="quantity"
                        name="quantity"
                        value="{{ old('quantity', $product->quantity) }}"
                    >
                    @error('quantity')
                        <span class="text-danger invalid-feedback">
                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="weight">Weight</label>
                    <input
                        class="form-control @error('weight') is-invalid @enderror"
                        type="text"
                        placeholder="Enter product weight"
                        id="weight"
                        name="weight"
                        value="{{ old('weight', $product->weight) }}"
                    >
                    @error('weight')
                        <span class="text-danger invalid-feedback">
                            <i class="fa fa-exclamation-circle fa-fw"></i> 
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Description</label>
            <textarea 
                name="description" 
                id="description" 
                rows="8" 
                class="form-control"
            >{{ old('description', $product->description) }}</textarea>
            @error('description')
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
                        id="status"
                        name="status"
                        {{ $product->status ? 'checked' : '' }}
                    >
                        Status
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input 
                        class="form-check-input"
                        type="checkbox"
                        id="featured"
                        name="featured"
                        {{ $product->featured ? 'checked' : '' }}
                    >
                        Featured
                </label>
            </div>
        </div>
    </div>
    <div class="tile-footer">
        <div class="row d-print-none mt-2">
            <div class="col-12 text-right">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Product
                </button>
                <a class="btn btn-danger" href="{{ route('admin.products.index') }}">
                    <i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back
                </a>
            </div>
        </div>
    </div>
</form>