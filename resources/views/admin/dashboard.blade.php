@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body" id="dashboard">
                   <h5> {{ __('Welcome to admin dashboard!') }} </h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
