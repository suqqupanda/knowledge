@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
@endpush

@section('content')
    <div class="container ">        
        <ul class="list-group">
            @forelse($posts as $post)
                    <div class="d-flex align-items-center mb-2">
                        <img id="icon-image" src="{{ asset('storage/profileIcons/' . basename($post->user->icon)) }}">
                        <div>
                            <strong>{{ $post->user->name }}</strong>
                            <li class="list-group-item mb-4 rounded title-container">
                                {{ $post->title }}
                            </li>
                        </div>
                    </div>

            @empty
                <div class="mb-4 text-center">
                    <li class="list-group-item rounded">投稿は存在しません</li>
                </div>
            @endforelse
        </ul>
        <div class="d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
