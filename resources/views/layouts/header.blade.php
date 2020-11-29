<header class="navbar navbar-expand-lg navbar-dark bg-dark" id="header">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="navbar_collapse" aria-expanded="false" aria-label="@lang('app.toggler_menu')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand text-truncate" href="{{ config('app.url') }}">
            <img src="/logo.png" class="logo-2">
            <span class="hidden-lg">{{ config('app.name') }}</span>
        </a>

        <?php if (empty($uid)) { ?>
            <a class="navbar-brand hidden-lg" href="<?php echo url('user-login'); ?>" aria-label="@lang('app.login')"> <i class="icon-user icon"></i></a>
        <?php } else { ?>
            <a class="navbar-brand hidden-lg" href="<?php echo url("thread-create-$fid"); ?>" aria-label="@lang('app.thread_create')"><i class="icon-edit icon"></i></a>
        <?php } ?>

        <div class="collapse navbar-collapse" id="nav">
            <!-- 左侧：版块 -->
            <ul class="navbar-nav mr-auto">
                <!--{hook header_nav_forum_start.htm}-->
                <li class="nav-item home" fid="0" data-active="fid-0"><a class="nav-link" href="."><i class="icon-home d-md-none"></i> @lang('app.index_page')</a></li>
                <!--{hook header_nav_home_link_after.htm}-->
                <?php foreach ($forumlist_show as $_forum) { ?>
                    <!--{hook header_nav_forumlist_loop_start.htm}-->
                    <li class="nav-item" fid="<?php echo $_forum['fid']; ?>" data-active="fid-<?php echo $_forum['fid']; ?>">
                        <a class="nav-link" href="<?php echo url("forum-$_forum[fid]"); ?>"><i class="icon-circle-o d-md-none"></i> <?php echo $_forum['name']; ?></a>
                    </li>
                    <!--{hook header_nav_forumlist_loop_end.htm}-->
                <?php } ?>
                <!--{hook header_nav_forum_end.htm}-->
            </ul>
            <!-- 右侧：用户 -->
            <ul class="navbar-nav">
                <!--{hook header_nav_user_start.htm}-->
                <?php if (empty($uid)) { ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo url('user-login'); ?>"><i class="icon-user"></i> @lang('app.login')</a></li>
                    <!--<li class="nav-item"><a class="nav-link" href="<?php echo url('user-create'); ?>">@lang('app.register')</a></li>-->
                <?php } else { ?>
                    <li class="nav-item username"><a class="nav-link" href="<?php echo url('my'); ?>"><img class="avatar-1" src="<?php echo $user['avatar_url']; ?>"> <?php echo $user['username']; ?></a></li>
                    <!-- 管理员 -->
                    <?php if ($gid == 1) { ?>
                        <li class="nav-item"><a class="nav-link" href="admin/"><i class="icon-home"></i> @lang('app.admin_page')</a></li>
                    <?php } ?>
                    <!--{hook header_nav_admin_page_after.htm}-->
                    <li class="nav-item"><a class="nav-link" href="<?php echo url('user-logout'); ?>"><i class="icon-sign-out"></i> @lang('app.logout')</a></li>
                    <?php } ?>
                <!--{hook header_nav_user_end.htm}-->
            </ul>
        </div>
    </div>
</header>