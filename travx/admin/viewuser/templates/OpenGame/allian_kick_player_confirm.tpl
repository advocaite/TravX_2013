<div id="box1">
  <div id="box2">
    <h1>{valu_allain}</h1>
    <p class=\"title_menu\"><a href="allianz.php">{Overview}</a> | <a href="allianz.php?s=10">{giao_tranh}</a> | <a href="allianz.php?s=11">{News}</a> | <span class="selected"><a href="allianz.php?s=12">{Options}</a></span></p>
    <form method="POST" action="allianz.php?event=3&act=2">
      <input type="hidden" name="kick_player_id"  id="kick_player_id" value="{kick_player_id}">
      <table class="tbg" style="width: 50%;" cellpadding="2" cellspacing="1">
        <tbody>
          <tr class="rbg">
            <td colspan="2">{Options}</td>
          </tr>
        <tr>
            <td colspan="2" class="s7"><a href="allianz.php?event=1">{assign_to_position}</a></td>
          </tr>
          <tr>
            <td colspan="2" class="s7"><a href="allianz.php?event=2">{change_name}</a></td>
          </tr>
          <tr>
            <td colspan="2" class="s7 selected"><a href="allianz.php?event=3">{kick_player}</a></td>
          </tr>
          <tr>
            <td colspan="2" class="s7"><a href="allianz.php?event=4">{change_des}</a></td>
          </tr>
          <tr>
            <td colspan="2" class="s7"><a href="allianz.php?event=5">{allian_diplomacy}</a></td>
          </tr>
          <tr>
            <td colspan="2" class="s7"><a href="allianz.php?event=6">{invite_player}</a></td>
          </tr>
        <tr>
          
          <input type="hidden" name="aid" id="aid" value="{ally_id}" />
          <td colspan="2" class="s7"><a href="allianz.php?event=8">{Quit alliance}</a></td>
        </tr>
        <tr>
          <td align="center" class="s7" colspan="2"></td>
        </tr>
        </tbody>
        
      </table>
      <br />
      <table class="tbg" style="width: 50%;" cellpadding="2" cellspacing="1">
        <tbody>
          <tr class="rbg">
            <td colspan="2">{Kick player confirm}</td>
          </tr>
          <tr>
            <td colspan="2">{Kick player confirm description}</td>
          </tr>
          <tr class="s7">
            <td width="70">{Password}:</td>
            <td><input class="fm" type="password" name="kick_player_confirm" id="kick_player_confirm" value="" size="18" maxlength="25">
              </td>
          </tr>
        </tbody>
      </table>
      <p align="center" style="width:50%"><input type="image" src="{images}" value="" tabindex="3"></p>
      <b style="color:#FF6600">{message}</b>
    </form>
  </div>
</div>
</div>
