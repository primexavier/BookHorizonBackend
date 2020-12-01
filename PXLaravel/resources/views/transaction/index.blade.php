@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transaction Index</div>
                <div class="card-body">       
                    {{$dataTable->table()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    {{$dataTable->scripts()}}
@endpush