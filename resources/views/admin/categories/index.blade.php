@extends('admin.app')

@section('title', $pageTitle)

@section('content')
<div class="app-title">
    <div>
      <h1>
          <i class="app-menu__icon fa fa-tags"></i> {{ $pageTitle }}
        </h1>
        <p>{{ $subTitle }}</p>
    </div>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary pull-right">Create Category</a>

  </div>

  @include('admin.partials._messages')

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th> Name </th>
                <th> Slug </th>
                <th class="text-center"> Parent </th>
                <th class="text-center"> Featured </th>
                <th class="text-center"> Menu </th>
                <th class="text-center"> Order </th>
                <th style="width:100px; min-width:100px;" class="text-center text-danger">
                    <i class="fa fa-bolt"> </i>
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse ($categories as $category)
                @if ($category->id != 1)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->parent->name }}</td>
                        <td class="text-center">
                            @if ($category->featured == 1)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($category->menu == 1)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{ $category->order }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-info mr-3">
                              <i class="fa fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('admin.categories.delete', $category) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                                <i class="fa fa-trash"></i>
                              </button>
                            </form>
                        </td>
                    </tr>
                @endif
              @empty
                  <p>There is no categories yet!!!</p>
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