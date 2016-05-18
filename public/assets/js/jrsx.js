$(function(){
    $(".btn-delete").click(function(event) {
        var sure=confirm('你确定要删除吗?');
        if (sure==true){
            var jrsxid=$(this).attr("data-jrsxid");
            var page=$(this).attr("data-page");
            var condition=$(this).attr("data-condition");

            var url="{{ route('admin.jrsx.destroy') }}";

            $.post(url,
                {
                    "_token" : {{ csrf_token() }},
                    "_method" : "DELETE",
                    "jrsxid" : jrsxid,
                },
                function(data,status){
                    if (data==="success"){
                        window.location.href={{ route('admin.jrsx.index') }};
                    }else{
                        alert("删除失败");
                    }
                });
        }
    });

    $(".btn-fav").click(function(event) {
        var sure=confirm('你确定要收藏吗?');
        if (sure==true){

        var jrsxid=$(this).attr("data-jrsxid");
        var page=$(this).attr("data-page");
        var url="src/jrsxfav.php";

        $.post(url,
            {
                jrsxid:jrsxid,
            },
            function(data,status){
                if (data==="success"){
                    alert("收藏成功");
                }else{
                    alert("已收藏");
                }
            });
        }
    });

    $(".btn-cancelfav").click(function(event) {
        var sure=confirm('你确定要取消收藏吗?');
        if (sure==true){

            var jrsxid=$(this).attr("data-jrsxid");
            var page=$(this).attr("data-page");
            var url="src/jrsxcancelfav.php";

            $.post(url,
                {
                    jrsxid:jrsxid,
                },
                function(data,status){
                    if (data==="success"){
                        window.location.href="myfav.php?page="+page;
                    }else{
                        alert("取消失败");
                    }
                });
            }
    });

    $(".btn-deleteramark").click(function(event) {
        var sure=confirm('你确定要删除备注吗?');
        if (sure==true){

            var rid=$(this).attr("data-rid");
            var page=$(this).attr("data-page");
            var url="src/jrsxdeleremark.php";

            $.post(url,
                {
                    rid:rid,
                },
                function(data,status){
                    if (data==="success"){
                        window.location.href="myremark.php?page="+page;
                    }else{
                        alert("删除备注失败");
                    }
                });
        }
    });



    $(".btn-ban").click(function(event) {
        var sure=confirm('你确定要禁止发言吗?');
        if (sure==true){
        var banrecord=$(this).attr("data-banrecord");
        var page=$(this).attr("data-page");
        var url="src/jrsxban.php";

        $.post(url,
            {
                banrecord:banrecord,
            },
            function(data,status){
                if (data==="success"){
                    alert("禁止发言成功");
                }else{
                    alert("已禁止发言");
                }
            });
        }
    });
})

