<form method="post" action="ranking.php?tab=4" name="frm_player">
<p>{error}
<table width="70%" cellspacing="1" cellpadding="2" class="tbg">
<tr class="rbg">
<td class="rbg" colspan="1">{sum_allies}</td>
<td class="rbg" colspan="6"><a name="h2"></a>{rank_allies}</td>
</tr>
<tr>
	<td width="5%" >&nbsp;</td>
	<td width="27%">{Name_Allies}</td>
	<td width="15%">{SumPlayer}</td>
    <td width="20%">{Boss}</td>
	<td width="14%">{Danso_TBa}</td>
	<td width="15%">{Point_allies}</td>
	<td width="1%">{Level}</td>
</tr>
{list}
</table>
<p>
<table class="tbg" cellspacing="1" cellpadding="0" width="70%"><tr><td>
<table class="tbg" cellspacing="0" cellpadding="2">
<tr>
<td width="100"><b>{Search}:</b></td>
<td width="75">{Rank}:</td>
<td width="59"><input class="fm f30" type="Text" id="rank" name="rank" value="{rank}" maxlength="5" size="5" onfocus="document.getElementById('name').value='';" onkeyup="CheckNumberInput(this);"></td>

<td width="37" align="center"><i>{Or}</i></td>
<td width="108">{Name_Allies}</td>
<td width="87"><input class="fm f80" type="Text" id="name" name="name" value="{value}" size="15" maxlength="30" onfocus="document.getElementById('rank').value='';"></td>
<td width="44" class="c r7">{page}</td>
</tr>
</table>
</td></tr></table><p>
<input type="submit" value="OK" name="submit_player"/></input>
</p>
</form>
</div>
</div>
</div>