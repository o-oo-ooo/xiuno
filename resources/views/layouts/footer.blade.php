        <footer class="text-muted small bg-dark py-4 mt-3" id="footer">
            <div class="container">
                <div class="row">
                    <div class="col">
                        Powered by <a href="http://bbs.xiuno.com/" target="_blank" class="text-muted"><b>Xiuno BBS <span>4.0.4</span></b></a>
                    </div>
                    <div class="col text-right">
                        Processed: <b><?php echo substr(microtime(1) - LARAVEL_START, 0, 5); ?></b>, SQL: <b>00</b>
                    </div>
                </div>
            </div>
        </footer>
        <!--[if ltg IE 9]>
        <script>window.location = '<?php echo url('browser'); ?>';</script>
        <![endif]-->

        @if(strpos(request()->userAgent(), 'ie'))
            <script src="{{ mix('/js/es6-shim.js') }}"></script>
        @endif
        <script src="{{ mix('/js/jquery-3.1.0.js') }}"></script>
        <script src="{{ mix('/js/popper.js') }}"></script>
        <script src="{{ mix('/js/bootstrap.js') }}"></script>
        <script src="{{ mix('/js/xiuno.js') }}"></script>
        <script src="{{ mix('/js/bootstrap-plugin.js') }}"></script>
        <script src="{{ mix('/js/async.js') }}"></script>
        <script src="{{ mix('/js/form.js') }}"></script>
        <script>
            var debug = DEBUG = {{ config('app.debug') }};
            var url_rewrite_on = true;
            var forumarr = {!! $forumarr !!};
            var fid = {{ $forum_id ?? 0 }};
            
            @auth
            var uid = {{ Auth::user()->id }};
            var gid = {{ Auth::user()->group_id }};
            @else
            var uid = 0;
            var gid = 0;
            @endauth
            
            xn.options.water_image_url = '{{ config("water_url") }}';	// 水印图片 / watermark image
        </script>
        <script src="{{ mix('/js/bbs.js') }}"></script>