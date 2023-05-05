@extends('layouts.app')

@section('content')
   <div class="row pb-0">
        <div class="col-sm-12">
            <div class="card">
                <languagem-select></languagem-select>
            </div>
        </div>
    </div>
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
