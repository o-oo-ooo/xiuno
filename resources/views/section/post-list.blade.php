<?php
empty($allowupdate) AND $allowupdate = 0;
empty($allowdelete) AND $allowdelete = 0;
empty($allowpost) AND $allowpost = 0;
?>

@if($postList)
@foreach($postList as $post)
<li class="media post" data-pid="{{ $post->id }}" data-uid="{{ $post->user_id }}">
    <a href="{{ route('user.show', $post->user_id) }}" class="mr-3" tabindex="-1">
        <img class="avatar-3" src="{{ $post->user->avatar }}">
    </a>
    <div class="media-body">
        <div class="d-flex justify-content-between small text-muted">
            <div>
                <span class="username">
                    <a href="{{ route('user.show', $post->user_id) }}" class="text-muted font-weight-bold">{{ $post->user->name }}</a>
                </span>

                <span class="date text-grey ml-2">{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <div class="text-right text-grey">
                <?php //if (0 && $allowpost) { ?>
                <a href="javascript:void(0)" data-tid="{{ $post->thread_id }}" data-pid="{{ $post->id }}" class="text-grey post_reply mr-3"><i class="icon-reply" title="@lang('app.quote'); ?>"></i> <span class="d-none">@lang('app.quote')</span></a>
                <?php //} ?>

                <?php //if (0 && $allowupdate || $_post['allowupdate']) { ?>
                <a href="{{ route('post.update', $post->id) }}" class="text-grey post_update mr-3"><i class="icon-edit" title="@lang('app.edit'); ?>"></i> <span class="d-none">@lang('app.edit')</span></a>
                <?php //} ?>

                <?php //if (0&&$allowdelete || $_post['allowdelete']) { ?>
                    <a data-href="{{ route('post.destroy', $post->id) }}" data-confirm-text="@lang('app.confirm_delete'); ?>" href="javascript:void(0);" class="text-grey post_delete _confirm mr-3"><i class="icon-remove" title="@lang('app.delete')"></i> <span class="d-none">@lang('app.delete')</span></a>
                <?php //} ?>

                <span class="floor-parent">
                    <span class="floor mr-0">{{ $post->floor ?? $loop->iteration + 1 }}</span>@lang('app.floor')
                </span>
            </div>
        </div>
        <div class="message mt-1 break-all">

            <?php //if (!empty($_post['subject'])) { ?>
                <h6><a href="{{ route('thread.show', $post->thread_id) }}" target="_blank"><?php //echo $_post['subject']; ?></a></h6>
            <?php //} ?>

         {{ $post->message_format }}

         @if($post->attach->count())
         <fieldset class="fieldset">
	<legend>上传的附件：</legend>
	<ul class="attachlist">
	@foreach ($post->attach as $attach)
            <li aid="{{ $attach->id }}">
                <a href="{{ route('attach.show', $attach->id) }}" target="_blank">
                    <i class="icon filetype {{ $attach->filetype }}"></i>
                    {{ $attach->orgfilename }}
                </a>
                <a href="javascript:void(0)" class="delete ml-3"><i class="icon-remove"></i> @lang('app.delete')</a>
            </li>
	@endforeach
	</ul>
	</fieldset>
         @endif

        </div>
    </div>
</li>
@endforeach
@endif