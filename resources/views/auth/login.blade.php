@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col">

                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary" href="{{ url('/login/google') }}">
                        Login with Google
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
