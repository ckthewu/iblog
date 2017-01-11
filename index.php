<html>
    <head>
        <title>iBlog</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/static/css/bootstrap.min.css">
        <link rel="stylesheet" href="/static/css/iblog.css" >
    </head>
    <body>
        <?php include "navbar.php" ?>
        <div class="header-content">
            <div class="container">
                <div class="header-content-title">
                    <h1 class="text-center">欢迎使用iBlog</h1>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="container">
                <h1 class="title">About Me</h1>
            <ul>
                <li>
                    <h2 ><span class="strong">基本信息</span></h2>
                    <hr />
                    <p><span class="big">姓名：</span>吴晨凯 |<span class="big">性别：</span>男</p>
                    <p><span class="big">年龄：</span>21 |<span class="big">出生年月：</span>1995-3</p>
                    <p><span class="big">学校：</span>北京邮电大学 |<span class="big">专业：</span>通信工程</p>
                </li>
                <li>
                    <h2 ><span class="strong">教育经历</span></h2>
                    <hr />
                    <p><span class="big">时间：</span>2013/9-2017/7</p>
                    <p><span class="big">学校：</span>北京邮电大学</p>
                    <p><span class="big">专业：</span>通信工程 本科</p>
                </li>
                <li>
                    <h2 ><span class="strong">项目地址</span></h2>
                    <hr />
                    <p><span class="big">github:</span><a href="https://github.com/ckthewu/iblog">https://github.com/ckthewu/iblog</a></p>
                </li>
            </ul>
            </div>

        </div>
        <?php include "script.php" ?>
		<script>
		$(document).ready(function(){
            indexInit();
		});
		</script>
    </body>
</html>
