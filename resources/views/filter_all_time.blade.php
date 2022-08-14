@extends('index')
@section('content')
    <form action="{{route('fill_all')}}" method="post" style="width:70%; margin-top: 30px" class="container">
        @csrf
        <div class="form-group">
            <label for="page_id">Page Id</label>
            <input type="number" class="form-control @error('page_id') is-invalid @enderror" id="page_id"
                   name="page_id" value="{{ old('page_id') }}">
            @error('page_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="limit">Limit</label>
            <input type="number" class="form-control @error('limit') is-invalid @enderror" id="limit"
                   name="limit" value="{{ old('limit') }}">
            @error('limit')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="begin_time">Begin Time</label>
            <input type="date" class="form-control @error('begin_time') is-invalid @enderror" id="begin_time"
                   data-date-format="YYYY-MM-DD"
                   name="begin_time" value="{{ old('begin_time') }}">
            @error('begin_time')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="date" class="form-control @error('end_time') is-invalid @enderror" id="end_time"
                   data-date-format="YYYY-MM-DD"
                   name="end_time" value="{{ old('end_time') }}">
            @error('end_time')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button class="btn btn-primary">Search</button>
    </form>
@endsection
