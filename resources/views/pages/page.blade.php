@extends('layouts.app')

@section('title', ($page->meta_title ?: $page->title))

@section('content')
    <div class="sisf-page-section section pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="mb-4">{{ $page->title }}</h1>

                    @if($page->content)
                        <div class="sisf-e-text">
                            {!! $page->content !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
