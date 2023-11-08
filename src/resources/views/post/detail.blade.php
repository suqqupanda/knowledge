@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/detail.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Post Details') }}</div>

                    <div class="card-body">
                        <img id="icon-image" src="{{ asset('storage/profileIcons/' . basename($post->user->icon)) }}">
                        <div class="post-group">
                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2">
                                    <label for="title">{{ __('タイトル') }}</label>
                                    <textarea id="title" class="form-control" name="title" rows="1" readonly>{{ $post->title }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="post-group">
                            <div class="row mb-4">
                                <div class="col-md-8 offset-md-2">
                                    <label for="post">{{ __('投稿内容') }}</label>
                                    <textarea id="post" class="form-control" name="post" rows="10" readonly>{{ $post->post }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4 justify-content-center">
                            <div class="col-md-4 d-flex justify-content-center">
                                <a href="{{ route('post.index') }}" class="btn btn-light btn-outline-dark rounded-pill">
                                    {{ __('戻る') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="date-container">
        {{ $post->created_at->format('Y年m月d日') }}
    </div>
@endsection
