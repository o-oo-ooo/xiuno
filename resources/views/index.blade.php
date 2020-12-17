@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
<div class="row">
    <div class="col-lg-9 main">
        <div class="card card-threadlist">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link @if(Route::current()->uri() == '/') active @endif" href="/">@lang('app.new_thread')</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <ul class="list-unstyled threadlist mb-0">
                    @include('section.thread-list')
                </ul>
            </div>
        </div>

        @include('section.thread-list-mod')

        <nav class="my-3"><ul class="pagination justify-content-center flex-wrap">{{ $threadlist->links('section.paginator') }}</ul></nav>
    </div>
    <div class="col-lg-3 d-none d-lg-block aside">
        <a role="button" class="btn btn-primary btn-block mb-3" href="{{ route('thread.create') }}">@lang('app.thread_create_new')</a>
        <div class="card card-site-info">
            <div class="m-3">
                <h5 class="text-center">{{ config('app.name') }}</h5>
                <div class="small line-height-3">{{ config('app.brief') }}</div>
            </div>
            <div class="card-footer p-2">
                <table class="w-100 small">
                    <tr align="center">
                        <td>
                            <span class="text-muted">@lang('app.threads')</span><br>
                            <b>{{ $siteStatistics['threads'] }}</b>
                        </td>
                        <td>
                            <span class="text-muted">@lang('app.posts')</span><br>
                            <b>{{ $siteStatistics['posts'] }}</b>
                        </td>
                        <td>
                            <span class="text-muted">@lang('app.users')</span><br>
                            <b>{{ $siteStatistics['users'] }}</b>
                        </td>
                        @if($siteStatistics['onlines'])
                            <td>
                                <span class="text-muted">@lang('app.online')</span><br>
                                <b>{{ $siteStatistics['onlines'] }}</b>
                            </td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tail.script')
<script>
    $('li[data-active="fid-0"]').addClass('active');
</script>
@endsection