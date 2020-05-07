<form action="{{url('/xin/store')}}"method="post"enctype="multipart/form-data">
	@csrf
	<table>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<tr>
			<td>姓名</td>
			<td><input type="text" name="xin_name"id="xin_name">
				<span>{{$errors->first('xin_name')}}</span>
			</td>
		</tr>
		<tr>
			<td>年龄</td>
			<td><input type="text" name="xin_age"id="xin_age">
				<span>{{$errors->first('xin_age')}}</span>
			</td>
		</tr>
		<tr>
			<td>身份证</td>
			<td><input type="text" name="xin_care"id="xin_care">
				<span>{{$errors->first('xin_care')}}</span>
			</td>
		</tr>
		<tr>
			<td>头像</td>
			<td><input type="file" name="xin_img"></td>
		</tr>
		<tr>
			<td>是否湖北人</td>
			<td>是:<input type="radio" name="xin_is"value="是">
				否:<input type="radio" name="xin_is"value="否">
				<span>{{$errors->first('xin_is')}}</span>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit"value="提交"></td>
		</tr>
	</table>
</form>
<!-- <script src="../jquery.js"></script> -->
<!-- <script>
	$(document).on("blur","#xin_name",function(){
		var _this=$(this);
		var xin_name=_this.val();
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

		$.get("/xin/ajax",{xin_name:xin_name},function(res){
			if(res=="no"){
				alert('该名称已存在');
				return ;
			}
		},
		
		);
	});
	$(document).on("blur","#xin_age",function(){
		var _this=$(this);
		var xin_age=_this.val();
		var reg = /^[0-9]+.?[0-9]*$/;
		if(!reg.test(xin_age)){
			alert('请正确填写年龄格式 应为伯数字类型');
		}
		if(xin_age>130){
			alert('年龄为1-130之间');
		}
		if(xin_age<1){
			alert('年龄为1-130之间');
		}
	});
	$(document).on("blur","#xin_care",function(){
		var _this=$(this);
		var xin_care=_this.val();
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

		$.get("/xin/ajaxs",{xin_care:xin_care},function(res){
			if(res=="no"){
				alert('该证件号码已存在');
				return ;
			}
		},
		
		);
	}); -->
<!-- </script> -->