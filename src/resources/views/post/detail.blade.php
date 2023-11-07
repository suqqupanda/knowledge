@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/detail.css') }}?v={{ date('YmdHis') }}">
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

                        {{-- ログインしているユーザーが投稿の持ち主であれば --}}
                        @if ($post->user->id === Auth::id())
                            <div class="row mb-4 justify-content-center">
                                <div class="col-md-6 d-flex justify-content-between">
                                    <a href="{{ route('post.index') }}" class="btn btn-light btn-outline-dark rounded-pill">
                                        {{ __('戻る') }}
                                    </a>
                                    <a href="{{ route('post.showUpdate', ['id' => $post->id]) }}"
                                        class="btn btn-light btn-outline-dark rounded-pill">
                                        {{ __('編集') }}
                                    </a>

                                    <button type="button" class="btn btn-light btn-outline-dark rounded-pill"
                                        data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">
                                        {{ __('削除') }}
                                    </button>

                                </div>
                            </div>
                        @else
                            <div class="row mb-4 justify-content-center">
                                <div class="col-md-4 d-flex justify-content-center">
                                    <a href="{{ route('post.index') }}"
                                        class="btn btn-light btn-outline-dark rounded-pill">
                                        {{ __('戻る') }}
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="date-container">
        {{ $post->created_at->format('Y年m月d日') }}
    </div>
@endsection

{{-- 削除確認モーダル --}}
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center modal-large-text">
                {{ __('本当に削除してもよろしいですか？') }}
            </div>
            <div class="modal-footer no-border d-flex flex-column align-items-center">
                <form method="POST" action="{{ route('post.delete', $post->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-light btn-outline-dark rounded-pill btn-delete-text">{{ __('削除') }}</button>
                </form>
                <button type="button" class="btn btn-light btn-outline-dark rounded-pill mb-2">{{ __('キャンセル') }}</button>
            </div>
        </div>
    </div>
</div>
