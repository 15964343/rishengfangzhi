<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("menutitle","网站首页"); ?><?php $this->assign("title","会员登录"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
var maxtime = 60;
var mobile_send_lock = false;
var win_time_out;
function update_send_sms_loading()
{
	maxtime--;
	if(maxtime < 1){
		$("#mobile_send_status").val('发送手机验证码');
		mobile_send_lock = false;
		maxtime = 60;
		window.clearInterval(win_time_out);
		return true;
	}
	var tips = "验证码已发送("+maxtime+")";
	$("#mobile_send_status").val(tips);
}

function check_input()
{
	var mobile = $("input[name=mobile]").val();
	if(!mobile){
		$.dialog.alert('手机号不能为空','','error');
		return false;
	}
	var code = $("input[name=_chkcode]").val();
	if(!code){
		$.dialog.alert('验证码不能为空','','error');
		return false;
	}
	var url = api_url('login','sms','mobile='+mobile+"&_chkcode="+code);
	var rs = $.phpok.json(url);
	if(rs.status){
		var backurl = $("input[name=_back]").val();
		if(!backurl){
			backurl = "<?php echo $sys['url'];?>";
		}
		$.phpok.go(backurl);
	}else{
		$.dialog.alert(rs.info,'','error');
		return false;
	}
	return false;
}
function send_sms()
{
	if(mobile_send_lock){
		$.dialog.alert('验证码已发送，请一分钟后再执行');
		return false;
	}
	var url = api_url('login','sms','type=getcode');
	var mobile = $("#mobile").val();
	if(!mobile){
		$.dialog.alert('手机号不能为空');
		return false;
	}
	url += "&mobile="+mobile;
	$.dialog.tips("请稍候…");
	update_send_sms_loading();
	$.phpok.json(url,function(rs){
		if(rs.status){
			maxtime = 60;
			mobile_send_lock = true;
			win_time_out = setInterval("update_send_sms_loading()",1000);
		}else{
			$.dialog.alert(rs.info);
			$("#mobile_send_status").val('发送手机验证码');
		}
	})
}
</script>
<div class="login-reg">
	<dl class="box">
		<dt>短信验证码登录</dt>
		<form method="post" id="login-form" onsubmit="return check_input()">
		<input type="hidden" name="_back" value="<?php echo $_back;?>" />
	    <input type="hidden" name="post_date" id="post_date" value="<?php echo date('Y-m-d H:i:s',$sys['time']);?>" />
	    <input type="hidden" name="pdip" id="pdip" value="<?php echo phpok_ip();?>" />
		<dd><label>手机号：</label><input class="input" type="text" name="mobile" id="mobile" /><div class="clear"></div></dd>
		<dd>
			<label>&nbsp;</label>
			<input type="button" value="发送手机验证码" onclick="send_sms()" class="button blue" id="mobile_send_status" />
			<div class="clear"></div>
		</dd>
		<dd><label>验证码：</label><input class="input" type="text" name="_chkcode" /><div class="clear"></div></dd>
		<dd class="submit"><input class="button blue" type="submit" value="登录" name=""></dd>
		</form>
	</dl>
	<dl class="box note">
		<dt>说明</dt>
		<dd>您正在使用手机短信验证码登录，请先获取手机验证码</dd>
		<dd>邮件登录，<a href="<?php echo phpok_url(array('ctrl'=>'login','type'=>'email'));?>" title="会员邮件登录">请点这里</a></dd>
		<dd>普通登录，<a href="<?php echo phpok_url(array('ctrl'=>'login','type'=>'default'));?>" title="普通登录">请点这里</a></dd>
		<dd>您还不是我们的会员，请点这里<a href="<?php echo phpok_url(array('ctrl'=>'register'));?>" title="注册会员">注册</a></dd>
		
		<dd>&nbsp;</dd>
	</dl>
	<div class="clear"></div>
</div>
<?php $this->output("foot","file"); ?>