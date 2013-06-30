
			<script>
				Event.onDOMReady( function() {
					var myfriendslist = new friendsList('friends');
					var mainview=Dom.get('mainview');
					var height = Dom.getRegion(mainview);
					height = height.bottom - height.top;
					if(height<400) Dom.setStyle(mainview, 'min-height', '440px');
				});
			</script>
			<div id="footer">
				<span class="copyright">&copy; 2013 IFARM&trade;
			</div>
			<div id="conExtraDiv1"><span></span></div>
			<div id="conExtraDiv2"><span></span></div>
			<div id="conExtraDiv3"><span></span></div>
			<div id="conExtraDiv4"><span></span></div>
			<div id="conExtraDiv5"><span></span></div>
			<div id="conExtraDiv6"><span></span></div>
        </div>
    </div>