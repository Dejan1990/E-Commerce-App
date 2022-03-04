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
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary pull-right">Create Brand</a>
    </div>

    @include('admin.partials._messages')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Slug </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger">
                                <i class="fa fa-bolt"> </i>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.brands.delete', $brand) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <p>There is no brands yet!!!</p>
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