<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <base href="{{ config('app.url') }}" />

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="keywords" content="@yield('keywords')" />
        <meta name="description" content="@yield('description')" />

        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
        <meta http-equiv="Cache-Control" content="no-transform"/>
        <meta http-equiv="Cache-Control" content="no-siteapp"/>
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
        <link rel="icon" sizes="32x32" href="{{ asset('favicon.ico') }}">
        <link rel="Bookmark" href="{{ asset('favicon.ico') }}" />

        <link rel="stylesheet" href="{{ mix('/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ mix('/css/bootstrap-bbs.css') }}">
        @yield('top.script')
    </head>

    <body>
        @include('layouts.header')

        <main id="body">
            <div class="container">
                @yield('content')
            </div>
        </main>

        @include('layouts.footer')
        
        @yield('tail.script')
    </body>
</html>