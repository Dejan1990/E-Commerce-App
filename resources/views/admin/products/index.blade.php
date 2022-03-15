@extends('admin.app')

@section('title', $pageTitle)

@section('content')
  <div class="app-title">
        <div>
            <h1>
                <i class="app-menu__icon fa fa-shopping-bag"></i> {{ $pageTitle }}
            </h1>
            <p>{{ $subTitle }}</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary pull-right">Create Product</a>

  </div>

  @include('admin.partials._messages')

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th> SKU </th>
                <th> Name </th>
                <th class="text-center"> Brand </th>
                <th class="text-center"> Categories </th>
                <th class="text-center"> Price </th>
                <th class="text-center"> Status </th>
                <th class="text-center"> Featured </th>
                <th style="width:100px; min-width:100px;" class="text-center text-danger">
                    <i class="fa fa-bolt"> </i>
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="text-center">{{ $product->brand->name }}</td>
                    <td class="text-center">
                        @foreach ($product->categories as $category)
                            <span class="badge badge-info">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td class="text-center">{{ config('settings.currency_symbol') }}{{ $product->price }}</td>
                    <td class="text-center">
                        @if ($product->status)
                           <span class="badge badge-success">Active</span> 
                        @else
                            <span class="badge badge-danger">Not Active</span> 
                        @endif
                    </td>
                    <td class="text-center">
                      @if ($product->featured)
                          <span class="badge badge-success">Yes</span>
                      @else
                          <span class="badge badge-danger">No</span> 
                      @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.products.delete', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
              @empty
                  <p>There is no product yet!!!</p>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush