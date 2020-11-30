@extends('layouts.app')

@section('title', '用户登录')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                @lang('app.user_login')
            </div>
            <div class="card-body ajax_modal_body">
                <form action="{{ route('login') }}" method="POST" id="form">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon icon-user icon-fw"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="@lang('app.email') / @lang('app.username')" id="email" name="email">
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--{hook user_login_email_after.htm}-->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon icon-lock icon-fw"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="@lang('app.password')" id="password" name="password">
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--{hook user_login_password_after.htm}-->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="submit" data-loading-text="@lang('app.submiting')...">@lang('app.login')</button>
                    </div>
                    <div class="media">
                        <div>
                            <!--{hook user_login_form_footer_left.htm}-->
                        </div>
                        <div class="media-body text-right">
                            <a href="{{ route('user.create') }}" class="text-muted"><small>@lang('app.user_create')</small></a>
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
var jemail = $('#email');
var jpassword = $('#password');
var referer = '{{ request()->header("referer") }}';
jform.on('submit', function () {
    jform.reset();
    jsubmit.button('loading');
    var postdata = jform.serializeObject();
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
        /*
         if(code == 0) {
         jsubmit.button(message).delay(1000).location(referer);
         } else if(code == 'email') {
         jemail.alert(message).focus();
         jsubmit.button('reset');
         } else if(code == 'password') {
         jpassword.alert(message).focus();
         jsubmit.button('reset');
         } else {
         alert(message);
         jsubmit.button('reset');
         }*/
    });
    return false;
});

</script>
@endsection