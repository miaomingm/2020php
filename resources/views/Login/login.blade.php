<form action="{{url('/login/logindo')}}"method="post">
	@csrf
	<table>
		<tr>
			<td>用户名</td>
			<td><input type="text" name="user_name"></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input type="password" name="user_pwd"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit"value="登录"></td>
		</tr>
	</table>
</form>