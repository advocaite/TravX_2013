<div id="box1">
  <div id="box2">
    <h1>{Player profile}</h1>
    <p class="title_menu"> <a href="profile.php">{Overview}</a> | <a href="profile.php?s=1">{Edit Profile}</a> | <span class="selected"><a href="profile.php?s=3">{Option}</a></span> </p>
    <form method="POST" name="frm_acc" action="profile.php?s=3&act=3" onsubmit="return checkinput();">
      <br />	
      <table cellspacing="1" cellpadding="2" class="tbg" width="100%">
        <tr>
          <td class="rbg" colspan="2">{Invite to allbody}</td>
        </tr>
        <tr>
        	<td style="text-align:justify;">{Content invite}<br /><center><p><strong><a href="#1" onclick="javascript:document.getElementById('txtBBCode1').style.display='block';document.getElementById('txtBBCode2').style.display='none';el=document.getElementById('txtBBCode1'); el.select(); doClick(el, event) " onmousemove="HideCopyMsg()">Mã HTML</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#2" onclick="javascript:document.getElementById('txtBBCode1').style.display='none';document.getElementById('txtBBCode2').style.display='block';el=document.getElementById('txtBBCode2'); el.select(); doClick(el, event) " onmousemove="HideCopyMsg()">Mã BLog</a></strong></p><textarea cols="50" id="txtBBCode1" rows="5" readonly="readonly" style="display:block;" onclick="this.select(); doClick(this, event)" onmousemove="HideCopyMsg()"><div><script type="text/javascript" language="javascript1.1" src="{url}js/Library.js"></script><a href="{url}ref/index.php?id={acc_sis_id}" onclick="return openMeExt(this,0,0,1,0,0,0,0,1,640,655,0,0,0);"><img src="{url}image.php?id={acc_sis_id}" width="500" height="125" border="0" /></a></div></textarea><textarea cols="50" id="txtBBCode2" rows="3" readonly="readonly" style="display:none;" onclick="this.select(); doClick(this, event)" onmousemove="HideCopyMsg()">[URL="{url}ref/index.php?id={acc_sis_id}"][IMG]{url}image.php?id={acc_sis_id}[/IMG][/URL]</textarea></center></td>
        </tr>
      </table>
      <br />    
      <table width="100%" cellspacing="1" cellpadding="2" class="tbg">
        <tr>
          <td class="rbg" colspan="2">{Account sitters} </td>
        </tr>
        <tr class="f8">
          <td colspan="2">{Account sitters description 1}</td>
        </tr>
        <tr class="s7" {hidden_1}>
          <td width="50%">{Name of the sitter}</td>
          <td width="50%"><input class="fm f110" type="text" name="txt_sister" maxlength="20">
          </td>
        </tr>
        <tr {hidden_2}>
          <td colspan="2"><a href="profile.php?act=del_account_sister&acc_sis_id={acc_sis_id}"> <img src="images/un/a/del.gif" width="12" height="12" border="0" > </a> &nbsp; <a href="profile.php?uid={sister_id_1}">{account_sister} </a> </td>
        </tr>
      </table>
      </p>
	  <p>
	  <b style="color:#FF6600; margin-top:0px; margin-bottom:3px">{pw_invalid}</b>
      <table cellspacing="1" cellpadding="2" class="tbg" width="100%">
        <tr>
          <td class="rbg" colspan="2">{Delete account 1}</td>
        </tr>
        <tr class="f8">
          <td colspan="2">{Delete account description}</td>
        </tr>
        </tr>
        
        <tr class="s7">
          <td width="50%">{Delete account 2}</td>
          <td width="50%"><input type="Radio" name="delete_account" id="delete_account" value="1">
            {Yes}
            <input type="Radio" name="delete_account" value="0" checked>
            {No} </td>
        </tr>
        <tr class="s7">
          <td> {Confirm with password} </td>
          <td><input class="fm f110" type="password" name="pw_del_acc" id="pw_del_acc" maxlength="20">
          </td>
        </tr>
      </table>
      <p align="center" style="width:100%">
        <input type="submit" value="Ok" tabindex="3">
      </p>
    </form>
  </div>
</div>
</div>
<script language="javascript">
function emailCheck (emailStr)
{
	var string=document.getElementById("email").value;
	var emailPat=/^(.+)@(.+)$/
	var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
	var validChars="\[^\\s" + specialChars + "\]"
	var quotedUser="(\"[^\"]*\")"
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
	var atom=validChars + '+'
	var word="(" + atom + "|" + quotedUser + ")"
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
	var matchArray=emailStr.match(emailPat)
	if (matchArray==null) 
	{
		alert(string);
		return false;
	}
	var user=matchArray[1]
	var domain=matchArray[2]
	if (user.match(userPat)==null) 
	{
		alert(string);
		return false;
	}
	var IPArray=domain.match(ipDomainPat)
	if (IPArray!=null) 
	{
		// this is an IP address
		for (var i=1;i<=4;i++) 
		{
			if (IPArray[i]>255)
			{
				alert(string);
				return false
			}
		}
		return true
	}
	var domainArray=domain.match(domainPat)
	if (domainArray==null) 
	{
		alert(string);
		return true
	}
	var atomPat=new RegExp(atom,"g")
	var domArr=domain.match(atomPat)
	var len=domArr.length
	if (domArr[domArr.length-1].length<2 || domArr[domArr.length-1].length>4) 
	{
		alert(string);
	   	return false
	}
	if (len<2) 
	{
	   alert(string);
	   return false
	}
  	return true;
}
	
function checkinput()
{
	if(document.getElementById("new_email").value!="")
	{
		if(emailCheck(document.getElementById("new_email").value)==false)
	  	{
  	  		document.getElementById("new_email").focus();
	  	  	return false;
    	}
	}
	var string1=document.getElementById("pass1").value;
	var string2=document.getElementById("pass2").value;
	var string3=document.getElementById("pass3").value;
	var string4=document.getElementById("delete_confirm_password").value;
	
	if(document.getElementById("pw2").value!="")
	{
		if(document.getElementById("pw2").value.length<=3)
		{
			alert(string2);
			document.getElementById("pw2").focus();
			return false;
		}
		if(document.getElementById("pw2").value.length!=document.getElementById("pw3").value.length)
		{
			alert(string3);
			document.getElementById("pw3").focus();
			return false;
		}
	}	
	return true;
}
</script>
<script type="text/javascript">
var mousex;
var mousey;
function doClick(el,e) {    

if (e) { 
    if (e.pageX || e.pageY) {
        mousex = e.pageX;
        mousey = e.pageY;
    }else if (e.clientX || e.clientY) {
        mousex = e.clientX + document.body.scrollLeft;
        mousey = e.clientY + document.body.scrollTop;
    } 
    mousex += 12;
}	

var theCode = el.value;
theCode = htmlDecode(theCode);
copy(theCode);
ShowCopyMsg();
}

function copy(text2copy)
{
if (window.clipboardData) {
    window.clipboardData.setData("Text",text2copy);
}else{        
    swfobject.embedSWF("images/clipboard.swf", "flashcontent", "0", "0", "4","images/expressInstall.swf", {clipboard:escape(text2copy)}, {}, {}); 
}    
}

function ShowCopyMsg() {
document.getElementById('copiedMsg').style.display='block';
document.getElementById('copiedMsg').style.top=mousey+'px';
document.getElementById('copiedMsg').style.left=mousex+'px';
}

function HideCopyMsg() {
document.getElementById('copiedMsg').style.display='none';
return false;
}

//-->
</script>