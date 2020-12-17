<?php
if ($threadlist) {
    $have_allowtop = 0;
    foreach ($threadlist as &$_thread) {
        //$_thread['allowtop'] = forum_access_mod($_thread['fid'], $gid, 'allowtop');
        if ($_thread['allowtop'])
            $have_allowtop = 1;
    }
}
?>

@if($threadlist)

    @foreach($threadlist as $thread)
    <li class="media thread tap <?php echo $_thread['top_class']; ?> " data-href="{{ route('thread.show', $thread->id) }}" data-tid="{{ $thread->id }}">
            <?php if ($have_allowtop) { ?>
                <?php if ($_thread['allowtop']) { ?>
                    <input type="checkbox" name="modtid" class="mt-3 mr-2" value="{{ $thread->id }}" <?php echo empty($mod_input_checked) ? '' : 'checked disabled'; ?> />
                <?php } ?>

        <?php } ?>

            <a href="{{ route('user.show', $thread->user_id) }}" tabindex="-1" class="ml-1 mt-1 mr-3">
                <img class="avatar-3" src="{{ $thread->user->avatar }}">
            </a>

            <div class="media-body">
                <div class="subject break-all">

                    @if($thread->top)
                        <i class="icon-top-{{ $thread->top }}"></i>
                    @endif

                    <a href="{{ route('thread.show', $thread->id) }}">{{ $thread->subject }}</a>

                    @if($thread->files)
                        <i class="icon small filetype other"></i>
                    @endif

                    @if($thread->closed)
                        <i class="icon-lock"></i>
                    @endif

                </div>
                <div class="d-flex justify-content-between small mt-1">
                    <div>
                        <span class="username text-grey mr-1 @if($thread->last_uid) hidden-sm @endif" uid="{{ $thread->user_id }}">{{ $thread->user->name }}</span>
                        <span class="date text-grey @if($thread->last_uid) hidden-sm @endif">{{ $thread->created_at->diffForHumans() }}</span>

                        @if($thread->last_uid)
                            <span>
                                <span class="text-grey mx-2">←</span>
                                <span class="username text-grey mr-1" uid="{{ $thread->last_uid }}">{{ $thread->lastUser->name }}</span>
                                <span class="text-grey">{{ $thread->updated_at }}</span>
                            </span>
                        @endif

                    </div>
                    <div class="text-muted small">
                        <span class="ml-2 d-none"><i class="icon-eye"></i> {{ $thread->views }}</span>

                        <span class="ml-2"><i class="icon-comment-o"></i> {{ $thread->posts }}</span>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
@else
    <li>
        <div>@lang('app.none')</div>
    </li>
@endif