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
                        <th>
                            课程名
                        </th>
                        <th>
                            教师
                        </th>
                        <th>
                            分数
                        </th>
                    </tr></thead>
                    <tbody id="data">
                        <tr v-for="data in datalist">
                              <td>
                              {{ data.lessonname }}
                              </td>
                              <td>
                              {{ data.teachername }}
                              </td>
                              <td>
                              {{ data.score }}
                              </td>
                          </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include "script.php" ?>
        <script>
		$(document).ready(function(){
            transcriptsInit();
		});
		</script>
    </body>
</html>
