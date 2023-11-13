@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Updata Post') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post.update', ['id' => $post->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2">
                                <label for="post">{{ __('タイトル') }}</label>
                                <textarea id="title" class="form-control @error('title') is-invalid @enderror" name="title" rows="1" required>{{ $post->title }}</textarea>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2">
                                <label for="post">{{ __('投稿内容') }}</label>
                                <textarea id="post" class="form-control @error('post') is-invalid @enderror" name="post" rows="10" required>{{ $post->post }}</textarea>

                                @error('post')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 justify-content-center">
                            <div class="col-md-2">
                            <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="btn btn-light btn-outline-dark rounded-pill">
                                {{ __('キャンセル') }}
                            </a>
                            </div>

                            <div class="col-md-2">
                            <button type="submit" class="btn btn-light btn-outline-dark rounded-pill">
                                {{ __('編集完了する') }}
                            </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
