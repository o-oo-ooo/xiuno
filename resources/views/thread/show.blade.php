@extends('layouts.app')

@section('title', $thread->subject . '-' . $thread->forum->name . '-' . config('app.name'))

@section('content')
<div class="row">
    <div class="col-lg-9 main">
            <ol class="breadcrumb d-none d-md-flex">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" aria-label="@lang('app.index_page')"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('forum.show', $thread->forum->id) }}">{{ $thread->forum->name }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('thread.show', $thread->id) }}" title="@lang('app.index_page')返回主题第一页">{{ $thread->subject }}</a></li>
            </ol>

        <div class="card card-thread">
            <div class="card-body">
                <div class="media">
                    <a href="{{ route('user.show', $thread->user->id) }}" tabindex="-1">
                        <img class="avatar-3 mr-3" src="{{ $thread->user->avatar }}">
                    </a>
                    <div class="media-body">
                        <h4 class="break-all">
                            {{ $thread->subject }}
                        </h4>
                        <div class="d-flex justify-content-between small">
                            <div>
                                <span class="username">
                                    <a href="{{ route('user.show', $thread->user->id) }}" class="text-muted font-weight-bold">{{ $thread->user->name }}</a>
                                </span>
                                <span class="date text-grey ml-2">{{ $thread->created_at->diffForHumans() }}</span>
                                <span class="text-grey ml-2"><i class="icon-eye"></i> {{ $thread->views }}</span>
                            </div>
                            <div>
                                <?php //if ($allowupdate || $first['allowupdate']) { ?>
                                <a href="{{ route('post.update', $thread->first_pid) }}" class="text-grey mr-2 post_update"><i class="icon-edit"></i> @lang('app.edit')</a>
                                <?php //} ?>

                                <?php //if ($allowdelete || $first['allowdelete']) { ?>
                                    <a data-href="{{ route('post.destroy', $thread->first_pid) }}" href="javascript:void(0);" class="text-grey post_delete" isfirst="1"><i class="icon-remove"></i> @lang('app.delete')</a>
                                <?php //} ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="message break-all" isfirst="1">
                    <?php //if (0&&$page == 1) { ?>

                    {{ $thread->post->find($thread->first_pid)->message_format }}

                    @if($firstPost->attach->count())
                        <fieldset class="fieldset">
                        <legend>上传的附件：</legend>
                        <ul class="attachlist">
                        @foreach ($firstPost->attach as $attach)
                            <li aid="{{ $attach->id }}">
                                <a href="{{ route('attach.show', $attach->id) }}" target="_blank">
                                    <i class="icon filetype {{ $attach->filetype }}"></i>
                                    {{ $attach->orgfilename }}
                                </a>
                                <a href="javascript:void(0)" class="delete ml-3"><i class="icon-remove"></i> @lang('app.delete')</a>
                            </li>
                        @endforeach
                    @endif
                    

                    <?php //} else { ?>

<!--                        <p><a href="<?php// echo url("thread-$tid"); ?>">@lang('app.view_thread_message')</a></p>-->

                    <?php //} ?>
                </div>

                <div class="plugin d-flex justify-content-center mt-3">
                </div>

            </div>
        </div>

        <div class="card card-postlist">
            <div class="card-body">
                <div class="card-title">
                    <div class="d-flex justify-content-between">
                        <div>
                            <b>@lang('app.new_post')</b> (<span class="posts">{{ $thread->posts }}</span>)
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                <ul class="list-unstyled postlist">
                    @include('section.post-list')

                    @auth
                        <li class="post newpost media">
                            <a href="{{ route('user.show', Auth::user()->id) }}" class="mr-3" tabindex="-1">
                                <img class="avatar-3" src="{{ Auth::user()->avatar }}">
                            </a>
                            <div class="media-body">
                                <div class="d-flex justify-content-between small text-muted">
                                    <div>
                                        <div>{{ Auth::user()->name }}</div>
                                    </div>
                                    <div>
                                        <span class="floor" id="newfloor">{{ $thread->posts + 2 }}</span>@lang('app.floor')
                                    </div>
                                </div>
                                <div>
                                    <form action="{{ route('post.store') }}" method="POST" id="quick_reply_form" class="d-block">	
                                        <input type="hidden" name="doctype" value="1" />
                                        <input type="hidden" name="return_html" value="1" />
                                        <input type="hidden" name="quotepid" value="0" />
                                        <input type="hidden" name="threadid" value="{{ $thread->id }}" />
                                        <div class="message mt-1">
                                            <textarea class="form-control" placeholder="@lang('app.message')" name="message" id="message"></textarea>
                                        </div>
                                        <div class="text-muted mt-2 small">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <button type="submit" class="btn btn-sm btn-secondary" id="submit" data-loading-text="@lang('app.submiting')..."> @lang('app.post_create') </button>
                                                </div>
                                                <div>
                                                    <a class="icon-mail-forward text-muted" href="{{ route('post.create') }}" id="advanced_reply"> @lang('app.advanced_reply')</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endauth
                </ul>
            </div>
        </div>

        <div class="d-none threadlist"><input type="checkbox" name="modtid" value="{{ $thread->id }}" checked /></div>
        <?php //include _include(APP_PATH . 'view/htm/thread_list_mod.inc.htm'); ?>

        <?php if (0&&$pagination) { ?>
        @if(0)
            <nav><ul class="pagination my-4 justify-content-center flex-wrap"><?php echo $pagination; ?></ul></nav>
        @endif
        <?php } ?>

        <a role="button" class="btn btn-secondary btn-block xn-back col-lg-6 mx-auto mb-3" href="javascript:history.back();">@lang('app.back')</a>

    </div>
    <div class="col-lg-3 d-none d-lg-block aside">

        <a role="button" class="btn btn-primary btn-block mb-3" href="{{ route('thread.create') }}">@lang('app.thread_create_new')</a>

        <div class="card card-user-info">
            <div class="m-3 text-center">
                <a href="{{ route('user.show', $thread->user->id) }}" tabindex="-1">
                    <img class="avatar-5" src="{{ $thread->user->avatar }}">
                </a>
                <h5><a href="{{ route('user.show', $thread->user->id) }}">{{ $thread->user->name }}</a></h5>
            </div>
            <div class="card-footer p-2">
                <table class="w-100 small">
                    <tr align="center">
                        <td>
                            <span class="text-muted">@lang('app.threads')</span><br>
                            <b>{{ $thread->user->threads }}</b>
                        </td>
                        <td>
                            <span class="text-muted">@lang('app.posts')</span><br>
                            <b>{{ $thread->user->posts }}</b>
                        </td>
                        <td>
                            <span class="text-muted">@lang('app.create_rank')</span><br>
                            <b>{{ $thread->user->id }}</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tail.script')
<script>
    var jform = $('#quick_reply_form');
    var jsubmit = $('#submit');
    jform.on('submit', function () {
        jform.reset();
        jsubmit.button('loading');
        var postdata = jform.serialize();
        $.xpost(jform.attr('action'), postdata, function (code, message) {
            if (code == 0) {
                var s = '<ul>' + message + '</ul>';
                var jli = $(s).find('li');
                jli.insertBefore($('.postlist > .post').last());
                jsubmit.button('reset');
                $('#message').val('');

                // 楼层 +1
                var jfloor = $('#newfloor');
                jfloor.html(xn.intval(jfloor.html()) + 1);

                // 回复数 +1
                var jposts = $('.posts');
                jposts.html(xn.intval(jposts.html()) + 1);

            } else if (code < 0) {
                $.alert(message);
                jsubmit.button('reset');
            } else {
                jform.find('[name="' + code + '"]').alert(message).focus();
                jsubmit.button('reset');
            }
        });
        return false;
    });


// 缩放图片，适应屏幕大小。
    function resize_image() {
        var jmessagelist = $('div.message');
        var first_width = jmessagelist.width(); // 815 : 746; //  734 746
        jmessagelist.each(function () {
            var jdiv = $(this);
            var maxwidth = jdiv.attr('isfirst') ? first_width : jdiv.width(); //  734 746
            var jmessage_width = Math.min(jdiv.width(), maxwidth);
            jdiv.find('img, embed, iframe, video').each(function () {
                var jimg = $(this);
                var img_width = this.org_width;
                var img_height = this.org_height;
                if (!img_width) {
                    var img_width = jimg.attr('width');
                    var img_height = jimg.attr('height');
                    this.org_width = img_width;
                    this.org_height = img_height;
                }
                //var percent = xn.min(100, xn.ceil((img_width / jmessage_width) * 100));
                if (img_width > jmessage_width) {
                    if (this.tagName == 'IMG') {
                        jimg.width(jmessage_width);
                        jimg.css('height', 'auto');
                        jimg.css('cursor', 'pointer');
                        jimg.on('click', function () {
                            //window.open(jimg.attr('src'));
                        });
                    } else {
                        jimg.width(jmessage_width);
                        var height = (img_height / img_width) * jimg.width();
                        jimg.height(height);
                    }
                }
            });
        });
    }

// 对于超宽的表格，加上响应式
    function resize_table() {
        $('div.message').each(function () {
            var jdiv = $(this);
            jdiv.find('table').addClass('table').wrap('<div class="table-responsive"></div>');
        });
    }

    $(function () {
        resize_image();
        resize_table();
        $(window).on('resize', resize_image);
    });

// 输入框自动伸缩

    var jmessage = $('#message');
    jmessage.on('focus', function () {
        if (jmessage.t) {
            clearTimeout(jmessage.t);
            jmessage.t = null;
        }
        jmessage.css('height', '8rem');
    });
    jmessage.on('blur', function () {
        jmessage.t = setTimeout(function () {
            jmessage.css('height', '2.5rem');
        }, 1000);
    });

    $('li[data-active="fid-{{ $thread->forum->id }}"]').addClass('active');

</script>

@if($thread->closed && (Auth::user()->group_id == 1 || Auth::user()->group_id > 6))
<script>
    jmessage.val('@lang('app.thread_has_already_closed')').attr('readonly', 'readonly');
</script>
<script>
// 删除帖子 / Delete post
$('body').on('click', '.post_delete', function() {
	var jthis = $(this);
	var href = jthis.data('href');
	var isfirst = jthis.attr('isfirst');
	if(window.confirm(lang.confirm_delete)) {
		$.xajax('DELETE', href, function(code, message) {
			var isfirst = jthis.attr('isfirst');
			if(code == 0) {
				if(isfirst == '1') {
					$.location('{{ route("forum.show", $thread->forum->id) }}');
				} else {
					// 删掉楼层
					jthis.parents('.post').remove();
					// 回复数 -1
					var jposts = $('.posts');
					jposts.html(xn.intval(jposts.html()) - 1);
				}
			} else {
				$.alert(message);
			}
		});
	}
	return false;
});
</script>
@endif
@endsection