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
                    <h1 class="text-center" id='title'>成绩单</h1>
                </div>
            </div>
        </div>
        <div class="score-container">
            <div class="container">
                <table class="table table-striped ">
                    <thead><tr>
                        <th>节次\星期</th><th>星期一</th><th>星期二</th>
                        <th>星期三</th><th>星期四</th><th>星期五</th>
                        <th>星期六</th><th>星期日</th>
                    </tr></thead>
                    <tbody id="data">
                         <tr v-for="(data, index) in datalist">
                             <th>{{ 2*index+1 }}-{{ 2*index+2 }}</th>
                             <td>{{ data[0] }}</td><td>{{ data[1] }}</td>
                             <td>{{ data[2] }}</td><td>{{ data[3] }}</td>
                             <td>{{ data[4] }}</td><td>{{ data[5] }}</td>
                             <td>{{ data[6] }}</td>
                         </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include "script.php" ?>
        <script>
		$(document).ready(function(){
            lessonsInit();
		});
		</script>
    </body>
</html>
