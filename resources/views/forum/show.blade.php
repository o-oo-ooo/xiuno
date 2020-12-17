@extends('layouts.app')

@section('title', $forum->name .'-' . config('app.name'))

@section('content')
<div class="row">
    <div class="col-lg-9 main">
        <?php if (empty($hide_breadcrumb)) { ?>
            <ol class="breadcrumb d-none d-md-flex">
                <li class="breadcrumb-item"><a href="./"><i class="icon-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item active"><a href="{{ route('forum.show', $forum->id) }}">{{ $forum->name }}</a></li>
            </ol>
        <?php } ?>

        <div class="card card-threadlist">
            <div class="card-header d-flex justify-content-between">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link <?php //echo $active == 'default' ? 'active' : ''; ?>" href="{{ route('forum.show', $forum->id) }}">@lang('app.new_thread')</a>
                    </li>
                </ul>
                <div class="text-right text-small pt-1 card-header-dropdown">
                    <div class="btn-toolbar" role="toolbar">
                        <span class="text-muted">@lang('app.orderby')：</span>
                        <div class="dropdown btn-group">
                            <a href="#" class="dropdown-toggle" id="ordery_dropdown_menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php //echo $orderby == 'tid' ? lang('thread_create_date') : lang('post_create_date'); ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ordery_dropdown_menu">
                                <a class="dropdown-item" href="<?php //echo url("forum-$fid-1", array('orderby' => 'tid') + $extra); ?>"><i class="icon text-primary <?php //echo $orderby == 'tid' ? 'icon-check' : ''; ?>"></i>&nbsp; @lang('app.thread_create_date')</a>
                                <a class="dropdown-item" href="<?php //echo url("forum-$fid-1", array('orderby' => 'lastpid') + $extra); ?>"><i class="icon text-primary <?php //echo $orderby == 'lastpid' ? 'icon-check' : ''; ?>"></i>&nbsp; @lang('app.post_create_date')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled threadlist mb-0">
                    @include('section.thread-list')
                </ul>
            </div>
        </div>

        @include('section.thread-list-mod')

        <nav class="my-3"><ul class="pagination justify-content-center flex-wrap">{{ $threadlist->links('section.paginator') }}<?php //echo $pagination; ?></ul></nav>
    </div>
    <div class="col-lg-3 d-none d-lg-block aside">

        <a role="button" class="btn btn-primary btn-block mb-3" href="{{ route('thread.create') }}">@lang('app.thread_create_new')</a>

        <div class="card card-forum-info">
            <div class="card-body text-center">
                <img class="logo-5 mb-2" src="{{ $forum->icon }}">
                <h5>{{ $forum->name }}</h5>
                <div class="text-left line-height-2">{{ $forum->brief }}</div>
            </div>
            <div class="card-footer p-2">
                <table class="w-100 small">
                    <tr align="center">
                        <td>
                            <span class="text-muted">@lang('app.threads')</span><br>
                            <b>{{ $forum->threads }}</b>
                        </td>
                        <td>
                            <span class="text-muted">@lang('app.today_posts')</span><br>
                            <b>{{ $forum->today_posts }}</b>
                        </td>
                        <td>
                            <span class="text-muted">@lang('app.today_threads')</span><br>
                            <b>{{ $forum->today_threads }}</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if ($forum['announcement'] || $forum['modlist']) { ?>
            <div class="card card-mod-info">
                <div class="card-body">
                    <?php if ($forum['announcement']) { ?>
                        <h6 class="card-title">@lang('app.forum_anouncement')：</h6>
                        <p class="small">
                            <?php echo $forum['announcement']; ?>
                        </p>
                    <?php } ?>

                    <?php if ($forum['modlist']) { ?>
                        <h6 class="card-title">@lang('app.forum_moderator')：</h6>
                        <div class="row">
                            <?php foreach ($forum['modlist'] as $mod) { ?>
                                <div class="col-3 mb-1 text-center">
                                    <a href="#"><img src="<?php echo $conf['view_url']; ?>img/avatar.png" alt="..." width="32" height="32" class="img-circle"></a><br>
                                    <a href="<?php echo url("user-$mod[uid]"); ?>" class="small text-muted text-nowrap"><?php echo $mod['username']; ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
@endsection

@section('tail.script')
<script>
    $('li[data-active="fid-{{ $forum->id }}"]').addClass('active');
</script>
@endsection