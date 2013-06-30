<div id="box1">
	<div id="box2">
		<h1><p><b>TravX <font color="#FF6F0F">Gold</font></b></p></h1>
		
		<div style="font-size:14px;font-weight:normal;margin:14px 0;">
		<a href="buy_gold.php">Packages</a> | 
		<a href="shop.php">{Shop}</a> | 
		<a href="shop.php?tab=1">{My_item}</a>
		</div>
		<p>You now have {total_gold} {Gold}</p>
        <script type="text/javascript">		
        function ChangeSelectIdShop(value)
		{
			for(var i=1;i<=4;i++)
			{
				document.getElementById('txtshop'+i).style.display="none";	
				document.getElementById('class_shop'+i).className="";				
			}
			document.getElementById('class_'+value).className="selected";		
			document.getElementById('txt'+value).style.display="block";
		}
        </script>
		<table class="plusFunctions" cellspadding="1" cellspacing="1" width="100%">
			<thead>
				<tr>
					<th colspan="5">Plus function</th>
				</tr>
				<tr style="background-color:#C0C0C0;">
				<td>Description</td>
				<td>Duration</td>
				<td>Gold</td>
				<td>Quanity</td>
				<td>Action</td>
			</thead>
			<tbody>
				<tr>
					<td>{Des_lumber}</td>
					<td>{lumber_duration} {Days}</td>
					<td>{lumber_asu} {Asu}</td>
					<td><form action="shop.php?type=1&s=1" method="post">
					<input name="input_lumber" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {lumber_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_iron}</td>
					<td>{iron_duration} {Days}</td>
					<td>{iron_asu} {Asu}</td>
					<td><form action="shop.php?type=2&s=1" method="post">
					<input name="input_iron" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {iron_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_clay}</td>
					<td>{clay_duration} {Days}</td>
					<td>{clay_asu} {Asu}</td>
					<td><form action="shop.php?type=3&s=1" method="post">
					<input name="input_clay" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {clay_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_crop}</td>
					<td>{crop_duration} {Days}</td>
					<td>{crop_asu} {Asu}</td>
					<td><form action="shop.php?type=4&s=1" method="post">
					<input name="input_crop" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {crop_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_all_resource}</td>
					<td>{all_resource_duration} {Days}</td>
					<td>{all_resource_asu} {Asu}</td>
					<td><form action="shop.php?type=18&s=1" method="post">
					<input name="input_all_resource" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {all_resource_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_attack}</td>
					<td>{attack_duration} {Days}</td>
					<td>{attack_asu} {Asu}</td>
					<td><form action="shop.php?type=5&s=2" method="post">
					<input name="input_attack" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {attack_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_defence}</td>
					<td>{defence_duration} {Days}</td>
					<td>{defence_asu} {Asu}</td>
					<td><form action="shop.php?type=6&s=2" method="post">
					<input name="input_defence" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {defence_action}/></form></td>
				</tr>

				<tr>
					<td>{Des_complete}</td>
					<td>{immediately}</td>
					<td>{complete_asu} {Asu}</td>
					<td><form action="shop.php?type=7&s=3" method="post">
					<input name="input_complete" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {complete_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_map_large}</td>
					<td>{map_large_duration} days</td>
					<td>{map_large_asu} {Asu}</td>
					<td><form action="shop.php?type=17&s=3" method="post">
					<input name="input_map_large" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {map_large_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_build}</td>
					<td>{build_duration} days</td>
					<td>{build_asu} {Asu}</td>
					<td><form action="shop.php?type=9&s=3" method="post">
					<input name="input_build" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {build_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_speedup_15}</td>
					<td>{speedup_15_duration}</td>
					<td>{speedup_15_asu} {Asu}</td>
					<td><form action="shop.php?type=20&s=3" method="post">
					<input name="input_speedup_15" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {speedup_15_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_speedup_30}</td>
					<td>{speedup_30_duration}</td>
					<td>{speedup_30_asu} {Asu}</td>
					<td><form action="shop.php?type=21&s=3" method="post">
					<input name="input_speedup_30" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {speedup_30_action}/></form></td>
				</tr>
				<tr>
					<td>{Des_speedup_2h}</td>
					<td>{speedup_2h_duration}</td>
					<td>{speedup_2h_asu} {Asu}</td>
					<td><form action="shop.php?type=22&s=3" method="post">
					<input name="input_speedup_2h" type="text" size="2" value="1" maxlength="2" class="fm" onkeyup="CheckNumberInput(this);" /></td>
					<td><input type="submit" value="{Buy}" class="fm" {speedup_2h_action}/></form></td>
				</tr>
			</tbody>
		</table>
		
        <p>{msg}
</div>
</div>
</div>
