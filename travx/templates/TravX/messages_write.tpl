<!--<script type="text/javascript" src="js/vietuni.js"></script>-->
<script language="javascript">
	function CheckInput()
	{
		var frm = document.formTwo;		
		if(frm.to_name.value.length > 250 || frm.to_name.value.length <1)
		{			
			var string=document.getElementById("answer1").value;
			alert(string); 
			frm.to_name.focus();
			return false;			
		}
		if(frm.content.value.length > 5000 || frm.content.value.length <1)
		{			
			var string=document.getElementById("answer3").value;
			alert(string);
			frm.content.focus(); 
			return false;			
		}
		
		return true;
	}	
</script>
<div style="position:absolute;{customize};display:{display}"; onclick="document.getElementById('to_name').value='(*)'" onmouseover="ddrivetip('{sent_mess_allies}')" onmouseout="hideddrivetip()"><img src="images/un/a/lien-minh.png" style="cursor:pointer;"/></div>
<form action="" method="post" name="SentMessage" onSubmit="return CheckInput()" >
<input type="hidden" name="value" value="{code}">
<input type="hidden" id="answer1" value="{34}" maxlength="100">
<input type="hidden" id="answer2" value="{35}" maxlength="100">
<input type="hidden" id="answer3" value="{36}" maxlength="100">
<br />
{error}
<div class="write_head"></div>
<div id="write_content">
<table cellspacing="0" cellpadding="0">
		
		<tr>
		  <td width="19" rowspan="2"></td>
          <td width="94" class="message">{Recipient}</td>
          <td width="272">
        <input type="text" id="to_name" name="to_name" maxlength="20" value="{to}" style="width:268px; background: url(images/en/msg/underline.gif) top center; border:0px;" >			</td>
		  <td width="52" rowspan="2">&nbsp;</td>
	</tr>
		
		<tr>
        <td width="94" class="message">{Subject}</td>
		  <td><input type="text" name="topic" id="topic" maxlength="35" value="{topic}" style="width:268px;background: url(images/en/msg/underline.gif) top center; border:0px;" onkeyup="initTyper(this);"/></td>		
		</tr>
		</table>
		<div class="line"></div>
		<table>
		<tr>
	  <td colspan="3">
                <textarea name="content" id="igm" rows="14" class="textarea write" onkeyup="initTyper(this);">{content}</textarea>			</td>
		</tr>
		
		<tr>
			<td colspan="4" align="center">
		  <input type="hidden" value="2" name="id_tab" id="id_tab"  />
		<input type="submit" value="Send" name="send_w_msg" id="send_w_msg" onClick="return urlaub()"></input>			</td>
		</tr>
</table>
</form>
</div>
<div id="write_foot"></div>


</div>
</div>
</div>