@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @if(Auth::user()->hasAnyRole('admin|manager|receptionists'))
                            <p>Go to admin dashboard
                                <i class="fas fa-arrow-right">
                                    <a href="{{ route('admin.dashboard') }}" style="left: 20px;">Dashboard</a>
                                </i>
                            </p>
                    @endif
                    @if(Auth::user()->hasAnyRole('client'))
                            <p>Go to Home page
                                <i class="fas fa-arrow-right">
                                    <a href="{{ route('welcome') }}" style="left: 20px;">Home</a>
                                </i>
                            </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
