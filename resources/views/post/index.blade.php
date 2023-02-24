@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Created By</th>
                                <th width="15%" style="text-align: center;">Aksi</th>
                                
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.modal-delete') {{-- memanggil modal --}}


@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script> --}}
    
    

    <script>

        let userDatatable;

        $(document).ready(function () {
            userDatatable = $('table').DataTable({
                // sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>pr',
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                        "<'row'<'col-sm-12'<'table-responsive'tr>>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",    
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('post.list') }}",
                order: [],
                columns: [
                    { data: 'DT_RowIndex', sortable: false, searchable: false },
                    { data: 'title'},
                    { data: 'created_by'},
                    { data: 'action', sortable: false }    
                ]
                
            });
        });
    </script>
<script src="{{ asset('js/user/delete.js') }}"></script>

@endpush