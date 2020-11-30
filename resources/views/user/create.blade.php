@extends('layouts.app')

@section('title', '用户注册')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                @lang('app.user_create')
            </div>
            <div class="card-body">
                <form action="<?php echo url('user-create'); ?>" method="post" id="form">

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon icon-envelope icon-fw"></i></span>
                        </div>
                        <input type="email" class="form-control" placeholder="@lang('app.email')" name="email" id="email" required>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon icon-user icon-fw"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="@lang('app.username')" name="username" id="username">
                    </div>

                    <div class="media">
                        <div class="media-body">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-lock icon-fw"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="@lang('app.password')" name="password" id="password">
                            </div>
                        </div>
                    </div>

                    <?php if (0 && $conf['user_create_email_on']) { ?>
                        <div class="media">
                            <div class="media-body">
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon icon-barcode icon-fw"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="@lang('app.verify_code')" name="code" id="code">
                                </div>
                            </div>
                            <div class="align-self-center ml-1">
                                <button type="submit" class="btn btn-primary btn-sm ml-3 form-group" id="sendcode" data-loading-text="@lang('app.sending')..." action="<?php echo url('user-send_code-user_create'); ?>">@lang('app.send_verify_code')</button>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="submit" data-loading-text="@lang('app.submiting')..." <?php if (0&&$conf['user_create_email_on']) { ?>disabled<?php } ?>>@lang('app.next_step')</button>
                    </div>

                    <div class="media">
                        <div>
                            <!--{hook user_create_form_footer_left.htm}-->
                        </div>
                        <div class="media-body text-right">
                            <a href="{{ route('login') }}" class="text-muted"><small>@lang('app.user_login')</small></a>
                            <?php if (!empty($conf['user_resetpw_on'])) { ?>
                                <a href="<?php echo url('user-resetpw'); ?>" class="text-muted ml-3"><small>@lang('app.forgot_pw')</small></a>
                                    <?php } ?>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tail.script')
<script src="{{ mix('js/md5.js') }}"></script>

<script>
var jform = $('#form');
var jsubmit = $('#submit');
var jsend = $('#sendcode');
var referer = '{{ request()->header("referer") }}';
jsend.on('click', function () {
    jform.reset();
    jsend.button('loading');
    var postdata = jform.serialize();
    $.xpost(jsend.attr('action'), postdata, function (code, message) {
        if (code == 0) {
            $('#code').focus();
            var t = 60; // 倒计时
            jsend.button('@lang('app.user_send_sucessfully') 60 ');
            jsubmit.button('reset');
            // 倒计时，重新发送
            var handler = setInterval(function () {
                jsend.button('@lang('app.user_send_sucessfully') ' + (--t) + ' ');
                if (t == 0) {
                    clearInterval(handler);
                    jsend.button('reset');
                }
            }, 1000);
        } else if (code < 0) {
            $.alert(message, -1);
            jsend.button('reset');
        } else {
            jform.find('[name="' + code + '"]').alert(message).focus();
            jsend.button('reset');
        }
    });
    return false;
});

jform.on('submit', function () {
    var postdata = jform.serializeObject();
    jsubmit.button('loading');
    postdata.password = $.md5(postdata.password);
    $.xpost(jform.attr('action'), postdata, function (code, message) {
        if (code == 0) {
            jsubmit.button(message).delay(1000).location(referer);
        } else if (xn.is_number(code)) {
            alert(message);
            jsubmit.button('reset');
        } else {
            jform.find('[name="' + code + '"]').alert(message).focus();
            jsubmit.button('reset');
        }
    });
    return false;
});

</script>
@endsection