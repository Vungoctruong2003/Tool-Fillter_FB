@extends('index')
@section('content')
@if (Session::has('import'))
    <h1 class="text-success">
        <i class="fa fa-check" aria-hidden="true"></i>
        {{ Session::get('import') }}
    </h1>
@endif
<form action="{{route('import')}}" method="post" style="width:70%; margin-top: 30px" class="container">
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
        <label for="page_id">Page Id</label>
        <input type="number" class="form-control @error('page_id') is-invalid @enderror" id="page_id"
               placeholder="nhập page id vào đây" name="page_id" value="{{ old('page_id') }}">
        @error('page_id')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button class="btn btn-primary">Import</button>
</form>

@endsection
