<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script>
function check()
{
	var frm = document.form_alert;		
		if(frm.txt_reason.value.length > 250 || frm.txt_reason.value.length <1)
		{			
			alert("Nhập lý do từ 1 đến 250 ký tự !") 
			frm.txt_reason.focus();
			return false;			
		}
	return true;
}

function okBan()
{
	window.opener.document.frm_del_village.reason_del_village.value = document.form_alert.txt_reason.value;
	/* close & refresh 
	window.opener.location.href = window.opener.location.href;
	self.close();
	*/
	/* close & refresh
	opener.location.reload(true);
	self.close();
	*/
	window.opener.document.frm_del_village.submit(); // close & submit parent form (frm_user_list)
    self.close();
}
</script>
<body>
<form action="" name="form_alert" method="post"  onSubmit="check();">
    <table align="center" style="border:solid 1px #999999" width="300" height="100">
        <tr>
            <td align="center" colspan="4"><b style="color:#FF0000">Lý do</b> </td>
        </tr>
        <tr>
            <td colspan="4">
            <textarea name="txt_reason" id="txt_reason" cols="45" rows="3"></textarea>
            </td>
        </tr>
        <tr>
            <td width="75">            </td>
            <td width="67" align="center"><input type="submit" name="submit" value="Đồng ý" onclick="okBan();">
            </td>
            <td width="52" align="center"><input type="button" name="cancel" value="Hủy" onClick="window.close();">
            <td width="82">            </td>
          <td width="0"></td>
        </tr>
    </table>
</form>
</body>
</html>
