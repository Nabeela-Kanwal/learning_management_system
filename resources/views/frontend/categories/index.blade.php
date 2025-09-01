@extends('layout.frontapp')
@section('content')
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">All Category</h2>
                </div>
                <ul
                    class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="index.html">Home</a></li>
                    <li>All Category</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="category-area section--padding">
        <div class="container">
            @include('components.category.category')
        </div>
    </section>
@endsection
