<form method="post" action="ranking.php?tab=2" name="frm_player">
<p>{error}
<table width="70%" cellspacing="1" cellpadding="2" class="tbg">
<tr class="rbg">
<td class="rbg" colspan="1">{sum_player}</td>
<td class="rbg" colspan="4"><a name="h2"></a>{rank_attack}</td>
</tr>
<tr>
	<td width="6%" >&nbsp;</td>
	<td width="35%">{Player}</td>
	<td width="25%">{Alliance}</td>
	<td width="20%">{attack_point}</td>
	<td width="14%">{Villages}</td> 
</tr>
{list}
</table>
<p>
<table class="tbg" cellspacing="1" cellpadding="0" width="70%"><tr><td>
<table class="tbg" cellspacing="0" cellpadding="2">
<tr>
<td width="100"><b>{Search}:</b></td>
<td width="75">{Rank}:</td>
<td width="59"><input class="fm f30" type="Text" id="rank" name="rank" value="{rank_user}" maxlength="5" size="5" onfocus="document.getElementById('name').value='';"></td>

<td width="37" align="center"><i>{Or}</i></td>
<td width="108">{Name}</td>
<td width="87"><input class="fm f80" type="Text" id="name" name="name" value="{value_name}" size="15" maxlength="30" onfocus="document.getElementById('rank').value='';"></td>
<td width="44" class="c r7">{page}</td>
</tr>
</table>
</td></tr></table><p>
<input type="image" value="ok" border="0" name="submit_player" src="images/en/b/ok1.gif" width="50" height="20"  /></input>
</p>
</form>
</div>
</div>
</div>