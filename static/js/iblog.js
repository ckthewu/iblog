function indexInit(){
    var users = new Vue({
        el: '#users',
        data:{
            usernow: '',
            userlist: []
        }
    });
    $.getJSON('/api/getusers.php',
        function(ret){
            users.userlist = ret;
            users.usernow = ret[0];
        });
}
function lessonsInit(){
    $("#li-lessons").attr("class", "active");
    function withuserchange(){
        $.getJSON('/api/getlessons.php',
            {
                username:users.usernow
            },
            function(ret){
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
            changeuser: function(){
                withuserchange();
            }
        }

    });
    var data = new Vue({
        el: '#data',
        data: {
            datalist: []
        }
    });
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
    $(".tab-container").hide();
    $("#u2l-form").show();
    $("#tab li").click(function(){
        $(this).siblings().attr('class','');
        $(this).attr('class', 'active');
        $(".tab-container").hide();
        console.log($(this).attr('id'));
        $("#"+$(this).attr('id')+"-form").show();
    });
     var data = new Vue({
         el: '#data',
         data: {
             havelessons: [],
             otherlessons: []
         },
         methods:{
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
    function waterfall() {
        var boxes = $('.box');
        var eachheights = [];
        var outerdiv = $('#data')[0];
        var starttop = $('.box')[0].offsetTop;
        var startleft = $('.box')[0].offsetLeft + $('.box')[0].clientLeft;
        var cols = Math.round(outerdiv.offsetWidth / boxes[0].offsetWidth);
        for (var i = 0; i<boxes.length; i++){
            if (i<cols){
                eachheights.push(boxes[i].offsetHeight);
            }
            else {
                var mind = getMin(eachheights),
                      min = mind.min,
                      minind = mind.minind;
                boxes[i].style.position = 'absolute';
                boxes[i].style.top = (min+Number(starttop))+"px";
                boxes[i].style.left = (minind*boxes[i].offsetWidth+Number(startleft)) + "px";
                eachheights[minind] += boxes[i].offsetHeight;
            }
        }
    }
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
    Vue.component('photo-box', {
        props: ['psrc'],
      template: '<div class="box"><div class="imgdata"><img v-bind:src="psrc"></div></div>'
    });
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
    function withuserchange(){
        $.getJSON('/api/gettranscript.php',
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
