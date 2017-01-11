function indexInit(){
    //存储用户列表和当前选择用户的vue实例
    var users = new Vue({
        el: '#users',
        data:{
            usernow: '',
            userlist: []
        }
    });
    //ajax获取用户列表
    $.getJSON('/api/getusers.php',
        function(ret){
            users.userlist = ret;
            users.usernow = ret[0];
        });
}
function lessonsInit(){
    $("#li-lessons").attr("class", "active");
    //修改用户后更新datalist
    function withuserchange(){
        $.getJSON('/api/getlessons.php',
            {
                username:users.usernow
            },
            function(ret){
                //刷新数据表
                flushtable();
                for (var i = 0; i < ret.length; i++){
                    var day = Number(ret[i]['day'])-1,
                        section = Number(ret[i]['section'])-1;
                    data.datalist[section][day] = ret[i]['lessonname'];
                }
            }
        );
        $("#title").text(users.usernow+'的课程表');
    }
    var users = new Vue({
        el: '#users',
        data:{
            usernow: '',
            userlist: []
        },
        methods: {
            //绑定到user的change事件
            changeuser: function(){
                withuserchange();
            }
        }

    });
    //存储课程表的vue实例
    var data = new Vue({
        el: '#data',
        data: {
            datalist: []
        }
    });
    //刷新课程表
    function flushtable(){
        data.datalist = [];
        for (var i = 0; i < 5;i++){
            var l = [];
            for (var j = 0; j < 7;j++){
                l.push('空');
            }
            data.datalist.push(l);
        }
    }
    flushtable();
    $.getJSON('/api/getusers.php',
        function(ret){
            users.userlist = ret;
            users.usernow = ret[0];
        }).done(function(){
            withuserchange();
        });
}

function manageInit(){
    $("#li-manage").attr('class','active');
    $("#users").remove();
    //标签页初始化
    $(".tab-container").hide();
    $("#u2l-form").show();
    //标签页切换函数
    $("#tab li").click(function(){
        $(this).siblings().attr('class','');
        $(this).attr('class', 'active');
        $(".tab-container").hide();
        console.log($(this).attr('id'));
        $("#"+$(this).attr('id')+"-form").show();
    });
    //存储已选课程和未选课程列表的vue实例
     var data = new Vue({
         el: '#data',
         data: {
             havelessons: [],
             otherlessons: []
         },
         methods:{
             //退课方法
             deleteclass: function(lessonname){
                  $.post('/api/deleteclass.php',
                      {
                          lessonname: lessonname
                      },
                      function(ret){
                          alert(ret);
                          if(ret==="退课成功"){
                              updateLessons();
                          }
                      }
                  );
             },
             //选课方法
             addclass: function(lessonname){
                 $.post('/api/addclass.php',
                     {
                         lessonname: lessonname
                     },
                     function(ret){
                         alert(ret);
                         if(ret==="选课成功"){
                             updateLessons();
                         }
                     }
                 );
             }
         }
     });
     //选课退课后刷新表格
     function updateLessons(){
         var username = $("#manageuser").text()
         $.getJSON('/api/getlessons.php',
             {
                 username: username
             },
             function(ret){
                 data.havelessons = ret;
             });
         $.getJSON('/api/getlessons.php',
             {
                 username: username,
                 reverse: "1"
             },
             function(ret){
                 data.otherlessons = ret;
             });
     }
     updateLessons();
}

function photoInit(){
    $("#li-photo").attr("class", "active");
    //瀑布流效果
    function waterfall() {
        //图片容器
        var boxes = $('.box');
        //瀑布流当前各列高度数组
        var eachheights = [];
        //父容器
        var outerdiv = $('#data')[0];
        //起始位置
        var starttop = $('.box')[0].offsetTop;
        var startleft = $('.box')[0].offsetLeft + $('.box')[0].clientLeft;
        //计算当前父容器中能放下的列数
        var cols = Math.round(outerdiv.offsetWidth / boxes[0].offsetWidth);
        for (var i = 0; i<boxes.length; i++){
            //第一行正常浮动
            if (i<cols){
                eachheights.push(boxes[i].offsetHeight);
            }
            else {
                //第二行开始采用绝对定位 通过获取当前最低列来插入一个图片容器
                var mind = getMin(eachheights),
                      min = mind.min,
                      minind = mind.minind;
                boxes[i].style.position = 'absolute';
                boxes[i].style.top = (min+Number(starttop))+"px";
                boxes[i].style.left = (minind*boxes[i].offsetWidth+Number(startleft)) + "px";
                //更新各列高度
                eachheights[minind] += boxes[i].offsetHeight;
            }
        }
    }
    //获取最低列值与索引
    function getMin(list) {
        var minind = 0,
                min = list[0];
        for (var i in list){
            if (list[i]<min){
                min = list[i];
                minind = i;
            }
        }
        return {min:min, minind: minind};
    }
    //vue组件 图片容器
    Vue.component('photo-box', {
        props: ['psrc'],
      template: '<div class="box"><div class="imgdata"><img v-bind:src="psrc"></div></div>'
    });
    //用户修改后更新图片墙
    function withuserchange(){
        $.getJSON('/api/getphoto.php',
            {
                username:users.usernow
            },
            function(ret){
                data.datalist = [];
                for (var i = 0; i < ret.length; i++){
                    data.datalist.push(ret[i]);
                }
            }
        );
        $("#title").text(users.usernow+'的图片墙');
    }
    //在数据更新后 为img绑定Load事件。在图片加载后计算瀑布流位置
    function afterupdate(){
        $("img").on('load',function(){
            waterfall();
        });
    }
    var users = new Vue({
        el: '#users',
        data:{
            usernow: '',
            userlist: []
        },
        methods: {
            changeuser: function(){
                withuserchange();
            }
        }
    });
    //存储图片链接的vue实例
    var data = new Vue({
        el: '#data',
        data: {
            datalist: []
        },
        updated: function(){
            afterupdate();
        }
    });
    $.getJSON('/api/getusers.php',
        function(ret){
            users.userlist = ret;
            users.usernow = ret[0];
        }).done(function(){
            withuserchange();
        }
        );
}

function transcriptsInit(){
    $("#li-transcripts").attr("class", "active");
    //用户改变后获取当前用户成绩单存入data.datalist
    function withuserchange(){
        $.getJSON('/api/gettranscript.php',
            {
                username:users.usernow
            },
            function(ret){
                data.datalist = []r;
                for (var i = 0; i < ret.length; i++){
                    data.datalist.push(ret[i]);
                }
            }
        );
        $("#title").text(users.usernow+'的成绩单');
    }
    var users = new Vue({
        el: '#users',
        data:{
            usernow: '',
            userlist: []
        },
        methods: {
            changeuser: function(){
                withuserchange();
            }
        }

    });
    //存放成绩单列表的vue实例
    var data = new Vue({
        el: '#data',
        data: {
            datalist: []
        }
    });
    $.getJSON('/api/getusers.php',
        function(ret){
            users.userlist = ret;
            users.usernow = ret[0];
        }).done(function(){
            withuserchange();
        });
}

function loginInit() {
    $("#users").remove();
}
