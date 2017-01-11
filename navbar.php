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
        <li id="li-lessons"><a href="/lessons.php">课程表</a></li>
        <li id="li-transcripts"><a href="/transcripts.php">成绩单</a></li>
        <li id="li-photo"><a href="/photo.php">图片墙</a></li>
      </ul>
      <div class="navbar-form navbar-left" id="users">
         <small>选择你要查看的用户 </small>
          <select class="form-control"  v-model="usernow" v-on:change="changeuser">
              <option v-for="user in userlist" v-bind:value="user" >{{ user }}</option>
          </select>
      </div>
      <ul class="nav navbar-nav navbar-right">
          <?php
            session_start();
            if($_SESSION["user_name"]!="" && $_SESSION["user_uptime"]!=""){
                echo "<li><a href=\"#\" id=\"manageuser\">".$_SESSION["user_name"]."</a></li>";
                echo "<li id=\"li-manage\"><a href=\"/manage.php\">管理个人信息</a></li>";
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
