<html>
    <head>
        <title>iBlog</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/static/css/bootstrap.min.css">
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
        <?php include "script.php" ?>
		<script>
		$(document).ready(function(){
            indexInit();
		});
		</script>
    </body>
</html>
