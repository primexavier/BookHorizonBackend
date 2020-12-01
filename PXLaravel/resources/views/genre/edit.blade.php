@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Genre Edit</div>
                <div class="card-body">
                    <form method="POST" action="{{route('backend.genre.update',$genre->id)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Parent Genre</label>
                                <input type="number" class="form-control" name="parentGenre" value="{{$genre->parent_id}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="genre" value="{{$genre->genre}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush