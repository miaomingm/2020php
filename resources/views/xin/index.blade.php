<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Bootstrap 实例 - 静态的顶部</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container-fluid"> 
    <div class="navbar-header">
        <a class="navbar-brand" href="#">叮咚</a>
    </div>
    <div>
        
    </div>
	</div>
</nav>

</body>
</html>
<form>
	身份证<input type="text" name="xin_care">
	姓名<input type="text" name="xin_name">
	<button>搜索</button>
</form>
	<table border="1">
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
			<td><a  href="{{url('/xin/destroy/'.$v->xin_id)}}" id="del">
			删除</a>
				<a href="{{url('/xin/edit/'.$v->xin_id)}}">修改</a>
			</td>
		</tr>
@endforeach
	</table>
	{{$xin->links()}}
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