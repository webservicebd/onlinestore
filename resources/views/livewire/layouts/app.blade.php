<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <link href="{{ asset('public/build/assets/myapp-AbCGPt4U.css') }}" rel="stylesheet">
        <link href="{{ asset('resources/css/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg mb-4">
            <div class="container">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/larajetb/dashboard" wire:navigate>Menu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                </ul>
                <ul class="nav navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('public/storage/'.auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="rounded-circle" style="width:40px; height:40px;"/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ url('user/profile') }}" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
              </div>
            </div>
        </nav>

        {{ $slot }}

        <script type="module" src="{{ asset('public/build/assets/app-zphQx2iv.js ') }}"></script>
    </body>
</html>
