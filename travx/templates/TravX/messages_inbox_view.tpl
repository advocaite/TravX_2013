<form action="" method="post" name="formTwo">
<div class="write_head"></div>
<div id="write_content">
<table cellspacing="0" cellpadding="0" class="f10">		
<tr>
			<td width="40" rowspan="2"></td>
	  <td width="75" class="message">{personal}</td>
<td width="238" class="col">
<input type="text" name="txtowner" maxlength="20"  style="width:238px; background: url(images/en/msg/underline.gif) top center; border:0px;" value="{from_id}" readonly="1">
			</td>
			<td width="85" class="datetime">{date}</td>
	</tr>
<tr>
        <td width="75" class="message">{Subject}</td>
			<td class="col">
                <input type="text" name="txttopic" id="txttopic" maxlength="35" value="{topic}" style="width:238px;background: url(images/en/msg/underline.gif) top center; border:0px;" readonly="1">
	  </td>	
        <td width="85" class="datetime">{time}</td>	
	</tr>
	</table>
	<div class="line"></div>
	<table>
		
		<tr>
			<td colspan="3">
                <textarea name="txtcontent" readonly="readonly" id="igm" rows="14" class="textarea write">{content}</textarea>

			</td>
		</tr>
		
		<tr>
			<td colspan="4" align="center">
		<input type="submit" value="Send" name="send_w_msg" id="send_w_msg" onClick="return urlaub()"></input>
			</td>
		</tr>
</table>
</form>
</div>
<div id="write_foot"></div>

</div>
</div>
</div>