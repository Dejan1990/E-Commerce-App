@extends('admin.app')

@section('title', $pageTitle)

@section('content')
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-th"></i> {{ $pageTitle }}
            </h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary pull-right">Create Attribute</a>
    </div>

    @include('admin.partials._messages')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> Code </th>
                                <th> Name </th>
                                <th class="text-center"> Frontend Type </th>
                                <th class="text-center"> Filterable </th>
                                <th class="text-center"> Required </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger">
                                    <i class="fa fa-bolt"> </i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->code }}</td>
                                    <td>{{ $attribute->name }}</td>
                                    <td class="text-center">{{ $attribute->frontend_type }}</td>
                                    <td class="text-center">
                                        @if ($attribute->is_filterable == 1)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($attribute->is_required == 1)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.attributes.edit', $attribute) }}" class="btn btn-sm btn-info mr-3">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.attributes.delete', $attribute) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <p>No Attributes Yet!!!</p>
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