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
                    <h1 class="text-center" id="title">图片墙</h1>
                </div>
            </div>
        </div>
        <div class="photo-container">
            <div class="container">
                <div id="data">
                    <photo-box v-for="photo in datalist" v-bind:psrc="photo"></photo-box>
                </div>
            </div>
        </div>

        <?php include "script.php" ?>
		<script>
		$(document).ready(function(){
            photoInit();
		});
		</script>
    </body>
</html>
