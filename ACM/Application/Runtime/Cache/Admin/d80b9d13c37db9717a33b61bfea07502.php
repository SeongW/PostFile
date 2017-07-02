<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>跳转提示</title>
        <style type="text/css">
            * {
                padding: 0;
                margin: 0;
            }

            html {
                width: 100%;
                height: 100%;
            }

            body {
                width: 100%;
                height: 100%;
                font-family: '微软雅黑';
                color: #000;
                background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            }

            .container {
                text-align: center;
                width: 1170px;
                margin: 200px auto;
            }

            .system-message {
                padding: 24px 48px;
            }

            .system-message h1 {
                font-size: 100px;
                font-weight: normal;
                line-height: 120px;
                margin-bottom: 12px;
            }

            .system-message .jump {
                margin-top: 50px;
                padding-top: 10px
            }

            .system-message .jump a {
                color: #fff;
                background-color: #428bca;
                border-color: #357ebd;
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 4px;
                text-decoration: none;
            }

            .system-message .success,
            .system-message .error {
                line-height: 1.8em;
                font-size: 36px
            }

            .system-message .detail {
                font-size: 12px;
                line-height: 20px;
                margin-top: 12px;
                display: none
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="system-message">
                <?php if(isset($message)) {?>
                <!-- <h1>:)</h1> -->
                <p class="success">
                    <?php echo($message); ?>
                </p>
                <?php }else{?>
                <!-- <h1>:(</h1> -->
                <p class="error">
                    <?php echo($error); ?>
                </p>
                <?php }?>
                <p class="detail"></p>
                <p class="jump">
                    页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
                </p>
            </div>
        </div>
        <script type="text/javascript">
            (function() {
                var wait = document.getElementById('wait'),
                    href = document.getElementById('href').href;
                var interval = setInterval(function() {
                    var time = --wait.innerHTML;
                    if (time <= 0) {
                        location.href = href;
                        clearInterval(interval);
                    };
                }, 1000);
            })();
        </script>
    </body>

    </html>