<?php if (!defined('THINK_PATH')) exit();?><html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>七牛 - 视频Demo</title>
    <!-- <link href="favicon.ico" rel="shortcut icon"> -->
    <link rel="stylesheet" href="/thinkphp_3.2.3_full/Public/Qiniu/css/bootstrap.min.css">
    <link rel="stylesheet" href="/thinkphp_3.2.3_full/Public/Qiniu/css/main.css">
    <link rel="stylesheet" href="/thinkphp_3.2.3_full/Public/Qiniu/css/highlight.css">
    <link rel="stylesheet" href="/thinkphp_3.2.3_full/Public/Qiniu/css/video-js.min.css">
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/video.min.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/videojs-media-sources.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/videojs.hls.min.js"></script>
    <!--[if lt IE 9]>
      <script src="/thinkphp_3.2.3_full/Public/Qiniu/js/Respond-1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <div class="text-left col-md-12 ">
            <h1 class="text-left col-md-12 ">
            七牛云存储 - 视频Demo
            </h1>
            <input type="hidden" id="domain" value="<?php echo ($domain); ?>">
            <input type="hidden" id="uptoken_url" value="<?php echo ($uptokenUrl); ?>">
        </div>
        <div class="body">
            <div class="col-md-12">
                <div id="container">
                    <a class="btn btn-default btn-lg " id="pickfiles" href="#">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>选择文件</span>
                    </a>
                </div>
            </div>
            <div style="display:none" id="success" class="col-md-12">
                <div class="alert-success">
                    队列全部文件处理完毕
                </div>
            </div>
            <div class="col-md-12 ">
                <table class="table table-striped table-hover text-left" style="margin-top:40px;">
                    <tbody id="fsUploadProgress">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade body" id="myModal-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">视频播放</h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body-wrapper text-center">
                            <div id="video-container" style="margin:-20px;border:0px solid #999;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/plupload.full.min.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/zh_CN.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/qiniu.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/main.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3_full/Public/Qiniu/js/ui.js"></script>
</body>
</html>