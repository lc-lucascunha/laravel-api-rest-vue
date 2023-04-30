@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <category-list></category-list>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <product-list></product-list>
            </div>
        </div>
    </div>
@endsection
