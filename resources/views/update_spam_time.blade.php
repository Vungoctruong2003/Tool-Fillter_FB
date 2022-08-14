@extends('index')
@section('content')
@if (Session::has('update'))
    <h1 class="text-success">
        <i class="fa fa-check" aria-hidden="true"></i>
        {{ Session::get('update') }}
    </h1>
@endif
<form action="{{route('update_spam_time')}}" method="post" style="width:70%; margin-top: 30px" class="container">
    @csrf
    <div class="form-group">
        <label for="data_user">Data User</label>
        <textarea class="form-control @error('user_data') is-invalid @enderror" id="data_user" rows="12"
                  name="user_data"
                  placeholder="nhập data user vào đây">{{ old('user_data') }}</textarea>
        @error('user_data')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="spam_time">Spam Time</label>
        <input type="date" class="form-control @error('spam_time') is-invalid @enderror" id="spam_time"
               data-date-format="YYYY-MM-DD"
               name="spam_time" value="{{ old('spam_time') }}">
        @error('spam_time')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
