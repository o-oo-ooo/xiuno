<header class="navbar navbar-expand-lg navbar-dark bg-dark" id="header">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="navbar_collapse" aria-expanded="false" aria-label="@lang('app.toggler_menu')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand text-truncate" href="{{ config('app.url') }}">
            <img src="{{ asset('logo.png') }}" class="logo-2">
            <span class="hidden-lg">{{ config('app.name') }}</span>
        </a>
        
        @guest
        <a class="navbar-brand hidden-lg" href="{{ route('login') }}" aria-label="@lang('app.login')"> <i class="icon-user icon"></i></a>
        @else
        <a class="navbar-brand hidden-lg" href="<?php echo url("thread-create-$fid"); ?>" aria-label="@lang('app.thread_create')"><i class="icon-edit icon"></i></a>
        @endguest

        <div class="collapse navbar-collapse" id="nav">
            <!-- 左侧：版块 -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item home" fid="0" data-active="fid-0"><a class="nav-link" href="."><i class="icon-home d-md-none"></i> @lang('app.index_page')</a></li>
                @foreach($forumlist as $forum)
                <li class="nav-item" fid="{{ $forum->id }}" data-active="fid-{{ $forum->id }}">
                    <a class="nav-link" href="<?php echo url("forum-$forum[fid]"); ?>"><i class="icon-circle-o d-md-none"></i> {{ $forum->name }}</a>
                </li>
                @endforeach
            </ul>
            <!-- 右侧：用户 -->
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="icon-user"></i> @lang('app.login')</a></li>
                    <!--<li class="nav-item"><a class="nav-link" href="{{ route('user.create') }}">@lang('app.register')</a></li>-->
                @else
                    <li class="nav-item username"><a class="nav-link" href="<?php echo url('my'); ?>"><img class="avatar-1" src="<?php echo $user['avatar_url']; ?>"> <?php echo $user['username']; ?></a></li>
                    <!-- 管理员 -->
                    @if(Auth::id() == 1)
                        <li class="nav-item"><a class="nav-link" href="admin/"><i class="icon-home"></i> @lang('app.admin_page')</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="<?php echo url('user-logout'); ?>"><i class="icon-sign-out"></i> @lang('app.logout')</a></li>
                @endguest
            </ul>
        </div>
    </div>
</header>