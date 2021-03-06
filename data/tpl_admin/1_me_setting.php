<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head_open","file"); ?>
<script type="text/javascript">
function check_save()
{
	var oldpass = $("#oldpass").val();
	if(!oldpass){
		$.dialog.alert("旧密码不能为空");
		return false;
	}
	var old = "<?php echo $rs['account'];?>";
	var name = $("#name").val();
	if(name && old != name){
		var qc = confirm("确定要修改您的管理员信息吗？\n修改后需要重新登录才能生效");
		if(qc == '0'){
			return false;
		}
	}
	var newpass = $("#newpass").val();
	if(newpass){
		var chkpass = $("#chkpass").val();
		if(newpass != chkpass){
			$.dialog.alert("两次输入的密码不一致");
			return false;
		}
	}
	return true;
}
</script>
<form method="post" action="<?php echo phpok_url(array('ctrl'=>'me','func'=>'submit'));?>" onsubmit="return check_save()">
<div class="table">
	<div class="title">
		管理员密码验证：
		<span class="note">请输入密码以验证您的身份合法性</span>
	</div>
	<div class="content">
		<input type="password" id="oldpass" name="oldpass" class="default" value="" />
	</div>
</div>
<div class="table">
	<div class="title">
		管理员账号：
		<span class="note">请慎用修改管理员账号，修改后要求重新登录</span>
	</div>
	<div class="content">
		<input type="text" id="name" name="name" class="default" value="<?php echo $rs['account'];?>" />
	</div>
</div>
<div class="table">
	<div class="title">
		管理员姓名：
		<span class="note">请填写管理员的姓名，姓名为空时使用账号作姓名</span>
	</div>
	<div class="content">
		<input type="text" id="fullname" name="fullname" class="default" value="<?php echo $rs['fullname'];?>" />
	</div>
</div>
<div class="table">
	<div class="title">
		邮箱：
		<span class="note">用于接收邮件通知，不设置表示不接收邮件通知，建议您设置有效的邮箱。</span>
	</div>
	<div class="content">
		<input type="text" id="email" name="email" class="default" value="<?php echo $rs['email'];?>" />
	</div>
</div>
<div class="table">
	<div class="title">
		新密码：
		<span class="note">请输入新的密码，长度不能少于5位，建议字母+数字组合</span>
	</div>
	<div class="content">
		<input type="password" id="newpass" name="newpass" class="default" value="" />
	</div>
</div>
<div class="table">
	<div class="title">
		验证密码：
		<span class="note">请再次输入密码</span>
	</div>
	<div class="content">
		<input type="password" id="chkpass" name="chkpass" class="default" value="" />
	</div>
</div>
<div class="table">
	<div class="title">
		关闭窗口弹出提示：
		<span class="note">如不提示，请留空！此项可有效防止误关窗口</span>
	</div>
	<div class="content">
		<input type="text" id="close_tip" name="close_tip" class="default" value="<?php echo $rs['close_tip'];?>" />
	</div>
</div>

<br />
<div class="table">
	<div class="content">
		<input type="submit" value="提 交" class="submit" />
	</div>
</div>
</form>
<?php $this->output("foot_open","file"); ?>