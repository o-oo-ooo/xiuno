@extends('layouts.app')

@section('title', trans('app.thread_create'))

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                @lang('app.thread_create')
            </div>
            <div class="card-body">
                <form action="{{ route('thread.store') }}" method="POST" id="form">
                    <input type="hidden" name="doctype" value="{{ $form_doctype ?? 1 }}" />
                    <input type="hidden" name="quotepid" value="{{ $quotepid ?? 0 }}" />

                    <div class="form-group">
                        <select class="custom-select mr-1 w-auto" name="fid">
                            @foreach($allowforum as $forum)
                            <option value="{{ $forum->id }}">{{ $forum->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="@lang('app.subject')" name="subject" value="{{ $form_subject ?? '' }}" id="subject">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" placeholder="@lang('app.message')" name="message" id="message" style="height: 300px;">{{ $form_message ?? '' }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="attachlist_parent">
                            <a class="small text-left" href="javascript:void(0)">
                                <label class="addattach" id="addattach">
                                    <i class="icon-folder-open-o"></i> 
                                    @lang('app.add_attach')
                                    <input type="file"  multiple="multiple" class="invisible" />
                                </label>
                            </a>
                            @isset($filelist)
                            <fieldset class="fieldset">
                                <legend>上传的附件：</legend>
                                <ul class="attachlist">
                                    @foreach($filelist as $file)
                                    <li aid="{{ $file['id'] }}">
                                        <a href="{{ route('attach.show', $file['id']) }}" target="_blank">
                                            <i class="icon filetype {{ $file['filetype'] }}"></i>
                                            {{ $file['orgfilename'] }}
                                        </a>
                                        <a href="javascript:void(0)" class="delete ml-2"><i class="icon-remove"></i> @lang('app.delete')</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </fieldset>
                            @endisset
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="submit" data-loading-text="@lang('app.submiting')..."> @lang('app.thread_create') </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tail.script')
<script>
    var jform = $('#form');
    var jsubmit = $('#submit');
    var jfid = jform.find('select[name="fid"]');
    jform.on('submit', function () {
        jform.reset();
        jsubmit.button('loading');
        var postdata = jform.serialize();
        $.xpost(jform.attr('action'), postdata, function (code, message) {
            if (code == 0) {
                $.alert(message);
                jsubmit.button(message).delay(1000).location('<?php //echo $location;        ?>');
            } else if (xn.is_number(code)) {
                alert(message);
                jsubmit.button('reset');
            } else {
                $.alert(message);
                //jform.find('[name="'+code+'"]').alert(message).focus();
                jsubmit.button('reset');
            }
        });
        return false;
    });
    
    var jattachparent = $('.attachlist_parent');
    $('#addattach').on('change', function (e) {
        var files = xn.get_files_from_event(e);
        if (!files) return;
        // 并发下会 服务端 session 写入会有问题，由客户端控制改为串行
        if (!jattachparent.find('.attachlist').length) {
            jattachparent.append('<fieldset class="fieldset"><legend>@lang('app.uploaded_attach')</legend><ul class="attachlist"><ul></fieldset>');
        }

        var jprogress = jattachparent.find('.progress');
        if (!jprogress.length) {
            jprogress = $('<div class="progress"><div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div></div>').appendTo(jattachparent);
        }
        jprogressbar = jprogress.find('.progress-bar');
        $.each_sync(files, function (i, callback) {
            var file = files[i];
            xn.upload_file(file, '{{ route('attach.store') }}', {is_image: 0}, function (code, message) {
                if (code != 0)
                        return $.alert(message);
                // 把文件 append 到附件列表
                var url = message.url;
                var filetype = message.filetype;
                var id = message.id;
                $('.attachlist').append('<li aid="' + id + '"><a href="' + message.url + '" target="_blank"><i class="icon filetype ' + filetype + '"></i> ' + message.orgfilename + '</a> <a href="javascript:void(0);" class="delete ml-2"><i class="icon-remove"></i> @lang('app.delete')</a></li>');
                callback();
                jprogress.hide();
            }, function (percent) {
                percent = xn.intval(percent);
                jprogressbar.css('width', percent + '%');
                jprogressbar.text(percent + '%');
                jprogress.show();
                console.log('progress:' + percent);
            });
        });
    });
    // 删除附件
    jattachparent.on('click', 'a.delete', function () {
        var jlink = $(this);
        var jli = jlink.parents('li');
        var id = jli.attr('aid');
        if (!window.confirm(lang.confirm_delete))
                return false;
        $.xajax('DELETE', xn.url('{{ route('attach.store') }}' + '/' + id), function (code, message) {
            if (code != 0)
                    return $.alert(message);
            jlink.parent().remove();
        });
        return false;
    })

    jform.find('[name="fid"]').checked({{ $fid ?? '' }});
    $('li[data-active="fid-<?php //echo $fid;        ?>"]').addClass('active');
</script>
@endsection