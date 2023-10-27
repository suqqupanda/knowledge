@extends('layouts.app')

@push('style')
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/register.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ユーザー新規登録') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="icon" class="col-md-4 col-form-label text-md-end">アイコン</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="icon" name="icon" accept="image/*"
                                                class="cutom-file-input">
                                        </div>
                                    </div>
                                    <div class="icon-preview-wrapper">
                                        <img id="icon-preview" src="#" alt="アイコンのプレビュー"
                                            style="display: none; max-width: 100px; max-height: 100px;">
                                    </div>
                                </div>

                                @error('icon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('ユーザー名') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="textPassword"
                                    class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                                <div class="col-md-6">
                                    <div class="password-wrapper">
                                        <input id ="textPassword" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                        <span id="buttonEye" class="fa fa-eye"></span>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <button type="submit" class="btn btn-light btn-outline-dark rounded-pill">
                                        新規登録
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

@push('body-script')
    <script src="{{ asset('/js/register.js') }}"></script>
@endpush
