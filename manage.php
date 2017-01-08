<?php
    session_start();
    if($_SESSION["user_name"]=="" || $_SESSION["user_pw"]==""){
        echo "<script language=javascript>alert('请先登陆!');location.href='/login.php';</script>";
        exit;
    }

 ?>
<html>
    <head>
        <title>iBlog</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <style>
            .tab-container{
                padding: 20px;
                border: 1px solid #ddd;
                border-top: 0px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">iBlog</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="/lessons.php">课程表</a></li>
                <li><a href="/transcripts.php">成绩单</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <?php
                    if($_SESSION["user_name"]!="" && $_SESSION["user_pw"]!=""){
                        echo "<li><a href=\"#\">".$_SESSION["user_name"]."</a></li>";
                        echo "<li><a href=\"/manage.php\">管理个人信息</a></li>";
                        echo "<li><a href=\"/api/logout.php\">登出</a></li>";
                    }
                    else {
                        echo "<li><a href=\"/login.php\">登陆</a></li>";
                    }
                   ?>
              </ul>
            </div>
          </div>
        </nav>

        <div class="header-content">
            <div class="container">
                <div class="header-content-title">
                    <h1 class="text-center">欢迎使用iBlog Manage</h1>
                </div>
            </div>
        </div>
        <div class="mian-content">
            <div class="container">
                <div class="mian-content-nav">
                    <ul class="nav nav-tabs" role="tablist" id="tab">
                      <li role="presentation" class="active" id="u2l"><a href="#">编辑课表</a></li>
                      <li role="presentation" id="transcript"><a href="#">成绩录入</a></li>
                      <li role="presentation" id="lessons"><a href="#">新建课程</a></li>
                      <li role="presentation" id="photo"><a href="#">上传图片</a></li>
                      <li role="presentation" id="users"><a href="#">注册账号</a></li>
                    </ul>
                </div>
                <div class="mian-content">
                    <div id="u2l-form" class="tab-container">
                        <table class="table table-striped ">
                          <thead><tr><th>课程名</th><th>任课教师</th><th>星期</th><th>节次</th><th>选课</th><th>退课</th></tr></thead>
                          <tbody></tbody>
                        </table>
                    </div>
                    <div id="lessons-form" class="tab-container">
                        <div class="row">
                            <form class="form-horizontal" role="form" action="/api/editlesson.php" method="post">
                              <div class="form-group">
                                <label for="" class="col-md-offset-2 col-md-2 control-label">课程名</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" placeholder="" name="lessonname">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-offset-2 col-md-2 control-label">任课教师</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" placeholder="" name="teachername">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-offset-2 col-md-2 control-label">上课时间</label>
                                    <div class="col-md-2">
                                      <select class="form-control" name="lessontime-day">
                                          <option value="1">星期一</option>
                                          <option value="2">星期二</option>
                                          <option value="3">星期三</option>
                                          <option value="4">星期四</option>
                                          <option value="5">星期五</option>
                                          <option value="6">星期六</option>
                                          <option value="7">星期日</option>
                                      </select>
                                    </div>
                                  <div class="col-md-2">
                                      <select class="form-control" name="lessontime-section">
                                          <option value="1">第1节</option>
                                          <option value="2">第2节</option>
                                          <option value="3">第3节</option>
                                          <option value="4">第4节</option>
                                          <option value="5">第5节</option>
                                          <option value="6">第6节</option>
                                          <option value="7">第7节</option>
                                          <option value="8">第8节</option>
                                          <option value="9">第9节</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-offset-4 col-md-8">
                                  <button type="submit" class="btn btn-default">提交</button>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    <div id="transcript-form" class="tab-container">
                        <div class="row">
                            <form class="form-horizontal" role="form" action="/api/edittranscript.php" method="post">
                              <div class="form-group">
                                <label for="" class="col-md-offset-2 col-md-2 control-label">课程名</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" placeholder="" name="lessonname">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-offset-2 col-md-2 control-label">分数</label>
                                <div class="col-md-4">
                                  <input type="number" min="0" max="100" class="form-control" placeholder="" name="score">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-offset-4 col-md-8">
                                  <button type="submit" class="btn btn-default">提交</button>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    <div id="photo-form" class="tab-container">
                        <div class="row">
                            <form class="form-horizontal" action="/api/photoup.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-offset-2 col-md-2 control-label">上传图片</label>
                                    <div class="col-md-4">
                                      <input type="file"  name="file">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-md-offset-4 col-md-8">
                                    <button type="submit" class="btn btn-default">提交</button>
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="users-form" class="tab-container">
                        <div class="row">
                            <form class="form-horizontal" role="form" action="/api/register.php" method="post">
                              <div class="form-group">
                                <label for="" class="col-md-offset-2 col-md-2 control-label">用户名</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" placeholder="Username" name="username">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-offset-2 col-md-2 control-label">密码</label>
                                <div class="col-sm-4">
                                  <input type="password" class="form-control" placeholder="Password" name="password1">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="" class="col-md-offset-2 col-md-2 control-label">确认密码</label>
                                <div class="col-sm-4">
                                  <input type="password" class="form-control" placeholder="Password" name="password2">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-offset-4 col-md-8">
                                  <button type="submit" class="btn btn-default">提交</button>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script>
            <?php
                try{
                    $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
                    $dbh->query('set names utf8;');
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $class_chosen = $dbh->query("SELECT * FROM lessons");
                    $classtable = $class_chosen->fetchAll();
                    echo "var classtable = ".json_encode($classtable).";";
                } catch (Exception $e) {
                    echo "Failed: " . $e->getMessage();
                }
            ?>
         console.log(classtable);
         $(classtable).each(function(i){
             $("#u2l-form table tbody").append("<tr><td>"+
             classtable[i].lessonname+"</td><td>"+classtable[i].teachername+
             "</td><td>"+classtable[i].day+"</td><td>"+classtable[i].section+
             '</td><td><button type="button" class="btn btn-default" id="add'+i+
             '">选课</button></td><td><button type="button" class="btn btn-default" id="delete'+i+
             '">删课</button></td></tr>');
             $("#delete"+i).click(function(){
                 $.post('/api/deleteclass.php',
                     {
                         lessonname: classtable[i].lessonname
                     },
                     function(ret){
                         alert(ret);
                     }
                 );
             });
             $("#add"+i).click(function(){
                 $.post('/api/addclass.php',
                     {
                         lessonname: classtable[i].lessonname
                     },
                     function(ret){
                         alert(ret);
                     }
                 );
             });
         });
         $("#tab li").click(function(){
             $(this).siblings().attr('class','');
             $(this).attr('class', 'active');
             $(".tab-container").hide();
             $("#"+$(this).attr('id')+"-form").show();
         });
         $(document).ready(function(){
             $(".tab-container").hide();
             $("#u2l-form").show();
         });
        </script>
    </body>
</html>
