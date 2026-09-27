@extends('layouts.student')

@section('title', "login.blade.php")

@section('content')
@extends('layouts.app')

@section('title', 'Student Login')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-center">Student Login</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('student.login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Phone No</label>
                            <div class="input-group">
                                <select name="country" class="form-select" style="max-width: 95px">
                                    <option value="+88">+88</option>
                                    <option value="+91">+91</option>
                                    <option value="+977">+977</option>
                                    <option value="+966">+966</option>
                                    <option value="+971">+971</option>
                                </select>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@endsection
