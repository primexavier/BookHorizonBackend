@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Genre Member</div>

                <div class="card-body">
                    Name : {{$genre->genre}}<br> 
                    <br>                    
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Book Id</th>
                                <th scope="col">Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($bookGenres->count() > 0)
                                @foreach($bookGenres as $bookGenre)
                                    <tr>
                                        <th scope="row">{{$bookGenre->book_id}}</th>
                                        <td>{{$bookGenre->book()->title}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="2" scope="row">No Book</th>
                                </tr>                            
                            @endif
                        </tbody>
                    </table>                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
