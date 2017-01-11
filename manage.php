<?php
    session_start();
    if($_SESSION["user_name"]=="" || $_SESSION["user_uptime"]==""){
        echo "<script language=javascript>alert('请先登陆!');location.href='/login.php';</script>";
        exit;
    }

 ?>
<html>
    <head>
        <title>iBlog</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/static/css/bootstrap.min.css">
        <link rel="stylesheet" href="/static/css/iblog.css">
    </head>
    <body>
        <?php include "navbar.php" ?>
        <div class="header-content">
            <div class="container">
                <div class="header-content-title">
                    <h1 class="text-center" id="title"><?php echo $_SESSION["user_name"]."个人管理" ?></h1>
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
                      <li role="presentation" id="newusers"><a href="#">注册账号</a></li>
                    </ul>
                </div>
                <div class="mian-content"  id="data">
                    <div id="u2l-form" class="tab-container">
                        <div>
                            <table class="table table-striped">
                              <thead><tr><th>课程名</th><th>任课教师</th><th>星期</th><th>节次</th><th>选退课</th></tr></thead>
                              <tbody>
                                  <tr><th colspan="5" class="text-center">已选课程</th></tr>
                                  <tr v-for="(lesson, index) in havelessons">
                                      <td>{{ lesson.lessonname }}</td><td>{{ lesson.teachername }}</td>
                                      <td>{{ lesson.day }}</td><td>{{ 2*lesson.section-1 }}-{{ 2*lesson.section }}</td>
                                      <td><button v-on:click="deleteclass(lesson.lessonname)" type="button" class="btn btn-default deletebutton" id=("delete"+index)>删课</button></td>
                                  </tr>
                                  <tr><th colspan="5" class="text-center">未选课程</th></tr>
                                  <tr v-for="(lesson, index) in otherlessons">
                                      <td>{{ lesson.lessonname }}</td><td>{{ lesson.teachername }}</td>
                                      <td>{{ lesson.day }}</td><td>{{ 2*lesson.section-1 }}-{{ 2*lesson.section }}</td>
                                      <td><button v-on:click="addclass(lesson.lessonname)" type="button" class="btn btn-default addbutton" id=("add"+index)>选课</button></td>
                                  </tr>
                              </tbody>
                            </table>
                        </div>
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
                                          <option value="1">第1-2节</option>
                                          <option value="2">第3-4节</option>
                                          <option value="3">第5-6节</option>
                                          <option value="4">第7-8节</option>
                                          <option value="5">第9-10节</option>
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
                                  <select class="form-control" name="lessonname">
                                      <option v-for="lesson in havelessons" v-bind:value="lesson.lessonname">{{ lesson.lessonname }}</option>
                                  </select>
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
                    <div id="newusers-form" class="tab-container">
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
        <?php include "script.php" ?>
        <script>
         $(document).ready(function(){
             manageInit();
         });
        </script>
    </body>
</html>
