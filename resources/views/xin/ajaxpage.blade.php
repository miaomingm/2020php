<table>
        <tr>
            <td>id</td>
            <td>姓名</td>
            <td>年龄</td>
            <td>头像</td>
            <td>是否湖北人</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
@foreach ($xin as $k=> $v)
        <tr xin_id="{{$v->xin_id}}">    
            <td>{{$v->xin_id}}</td>
            <td>{{$v->xin_name}}</td>
            <td>{{$v->xin_age}}</td>
            <td><img src="{{env('UPLOADS_URL')}}{{$v->xin_img}}"width=50></td>
            <td>{{$v->xin_is}}</td>
            <td>{{date("Y-m-d H:i:s",$v->xin_time)}}</td>
            <td><button id="del">删除</button>
                <a href="{{url('/xin/edit/'.$v->xin_id)}}">修改</a>
            </td>
        </tr>
@endforeach
    </table>
    <script>
    $(document).on("click","#del",function(){
        var _this=$(this);
        var xin_id=_this.parents("tr").attr("xin_id");
        if(window.confirm("确定删除吗？")){
            location.href="{{url('/xin/destroy')}}/"+xin_id;
        }
    });
    $(document).on("click",".pagination a",function(){
        var _this=$(this);
        var url=$(this).attr('href');
        $.get(url,function(res){
            $('table').html(res);
        });
        return false;
    });
</script>