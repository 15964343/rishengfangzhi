<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Expires" content="wed, 26 feb 1997 08:21:57 gmt" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache" />
<title><?php echo P_Lang("管理员登录");?></title>
<link href="css/css.php?file=<?php echo rawurlencode('login.css,artdialog.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo phpok_url(array('ctrl'=>'js'));?>"></script>
<script type="text/javascript">
function login_code(appid)
{
	var src_url = api_url("vcode","","id="+appid);
	$("#src_code").attr("src",src_url);
}

//验证并登录
function admlogin()
{
	var username = $("#username").val();
	if(!username)
	{
		$.dialog.alert("<?php echo P_Lang("管理员账号不能为空");?>",false,'error');
		return false;
	}
	//密码验证
	var pass = $("#password").val();
	if(!pass)
	{
		$.dialog.alert("<?php echo P_Lang("密码不能为空");?>",false,'error');
		return false;
	}
	var url = get_url('login','check','user='+$.str.encode(username)+"&pass="+$.str.encode(pass));
	var vcode = $("#code_id").val();
	if(vcode)
	{
		url += "&_code="+$.str.encode(vcode);
	}
	var rs = $.phpok.json(url);
	if(rs.status != 'ok')
	{
		$.dialog.alert(rs.content,function(){
			$("#code_id").val('');
			login_code('<?php echo $sys['app_id'];?>');
		},'error');
		return false;
	}
	else
	{
		url = get_url('index');
		$.phpok.go(url);
	}
	return false;
}
function update_lang(val)
{
	url = "<?php echo phpok_url(array('ctrl'=>'login'));?>&_langid="+val;
	$.phpok.go(url);
}

//防止被嵌套
if (self.location != top.location) top.location = self.location;
</script>
<?php echo $app->plugin_html_ap("phpokhead");?></head>
<body>
<div class="top">
	<?php if($config['adm_logo180']){ ?>
	<div class="logo"><div><img src="<?php echo $config['adm_logo180'];?>" border="0" /></div></div>
	<?php } ?>
</div>
<div class="main">
	<div class="box">
		<form method="post" id="adminlogin" onsubmit="return admlogin()">
		<table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td height="30"><?php echo P_Lang("管理员账号");?></td>
			<td colspan="2"><?php echo P_Lang("语言");?></td>
		</tr>
		<tr>
			<td height="40"><input name="username" type="text" class="user user_bg1" id="username" tabindex="1" /></td>
			<td colspan="2">
				<select name="langid" id="langid" onchange="update_lang(this.value)" style="padding:3px;border:1px solid #7ea3b8;line-height:27px;height:27px;">
					<?php $langlist_id["num"] = 0;$langlist=is_array($langlist) ? $langlist : array();$langlist_id["total"] = count($langlist);$langlist_id["index"] = -1;foreach($langlist AS $key=>$value){ $langlist_id["num"]++;$langlist_id["index"]++; ?>
					<option value="<?php echo $key;?>"<?php if($key == $langid){ ?> selected<?php } ?>><?php echo $value;?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
			<tr>
				<td width="209" height="30"><?php echo P_Lang("管理员密码");?></td>
				<td colspan="2"><?php if($vcode){ ?><?php echo P_Lang("验证码");?><?php } ?></td>
			</tr>
			<tr>
				<td height="40"><input name="password" id="password" type="password" class="user user_bg2" tabindex="2" /></td>
				<?php if($vcode){ ?>
				<td width="72"><input name="code_id" type="text" class="user user_bg3" id="code_id" tabindex="3" /></td>
				<td width="79"><img src="images/blank.gif" border="0" align="absmiddle" style="cursor:pointer;" onclick="login_code('<?php echo $sys['app_id'];?>')" id="src_code"><script type="text/javascript">$(document).ready(function(){login_code("<?php echo $sys['app_id'];?>");});</script></td>
				<?php } ?>
			</tr>
		<tr>
			<td height="50" colspan="3"><input type="submit" value="<?php echo P_Lang("认证登录");?>" class="but" /></td>
		</tr>
		<tr>
			<td height="30" colspan="3"><?php echo P_Lang("推荐使用：傲游/谷歌/火狐/IE9-12等浏览器访问本系统");?></td>
		</tr>
		</table>
		</form>
	</div>
	<div class="bottom"></div>
</div>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>
