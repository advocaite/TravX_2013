
    <div id="GF_toolbar">
        <h3>Other Options</h3>
            <li class="premium">
                <a href="plus.php" title="iFarm PLUS">
                    <span class="textLabel">iFarm PLUS (790)</span>
                </a>
            </li>
            <li class="highscore">
                <a href="ranking.php" title="Highscore">
                    <span class="textLabel">Highscore</span>
                </a>
            </li>
            <li class="options">
                <a href="profile.php" title="Options">
                    <span class="textLabel">Options</span>
                </a>
            </li>
            <li class="notes">
                <a href="javascript:switchNoteDisplay()" title="Notes">
                    <span class="textLabel">Notes</span>
                </a>
            </li>
            <li class="logout">
                <a href="logout.php" title="End game session">
                    <span class="textLabel">Logout</span>
                </a>
            </li>
            <li class="version">
                <a href="news.php" title="Version">
                    <span class="textLabel">v.0.1.0</span>
                </a>
            </li>
            <li class="serverTime">
                <a>
                    <span class="textLabel" id="servertime">19.01.2013 11:24:20</span>
                </a>
            </li>
        </ul>
    </div>
	<div id="extraDiv1"><span></span></div>
    <div id="extraDiv2"><span></span></div>
    <div id="extraDiv3"><span></span></div>
    <div id="extraDiv4"><span></span></div>
    <div id="extraDiv5"><span></span></div>
	<div id="extraDiv6"><span></span></div>
	<script type="text/javascript">
		/*
		kickListmember = function(friendId) {
		    ajaxRequest("friend.php?delete="+friendId, function(response){
	        alert(response);
		    });
		};
		*/
		// Adds a "down" css-class to a supplied element.
		function makeButton(ele) {
		    var Event = YAHOO.util.Event;
		    var Dom = YAHOO.util.Dom;
		    Event.addListener(ele, "mousedown", function() {
		        YAHOO.util.Dom.addClass(ele, "down");
		    });
		    Event.addListener(ele, "mouseup", function() {
		        YAHOO.util.Dom.removeClass(ele, "down");
		    });
		    Event.addListener(ele, "mouseout", function() {
		        YAHOO.util.Dom.removeClass(ele, "down");
		    });
		}

		//removed "childTooltip"-code. Don't duplicate code, just nest normal tooltips!
		// Old function:
		function ToolTips() {
		    var tooltips = Dom.getElementsByClassName ( "tooltip" , "div" , document , function() {
		        Dom.setStyle(this, "display", "none");
		    })
		    for(i=0;i<tooltips.length;i++) {
		        Event.addListener ( tooltips[i].parentNode , "mouseover" , function() {
		            Dom.getElementsByClassName ( "tooltip" , "div" , this , function() {
		                Dom.setStyle(this, "display", "block");
		            });
		        });
		        Event.addListener ( tooltips[i].parentNode , "mouseout" , function() {
		            Dom.getElementsByClassName ( "tooltip" , "div" , this , function() {
		                Dom.setStyle(this, "display", "none");
		            });
		        });
		    }
		}
		// New function
		/*
		function ToolTips() {
		    var tooltips = Dom.getElementsByClassName("tooltip", "div" ,document);
		    for(var i=0, l=tooltips.length;i<l;i++) {
		        Dom.setStyle(tooltips[i], "display", "none");
						
		        Event.addListener ( tooltips[i].parentNode , "mouseover" , function() {
					Dom.setStyle(this, "display", "block");
		        }, tooltips[i], true);
		        Event.addListener ( tooltips[i].parentNode , "mouseout" , function() {
					Dom.setStyle(this, "display", "none");
		        }, tooltips[i], true);
		    }
		}
		*/

		Event.onDOMReady( function() {
		    var links = document.getElementsByTagName("a");
		    for(i=0; i<links.length; i++) {
		        makeButton(links[i]);
		    }
		    ToolTips();
		    replaceSelect(Dom.get("citySelect"));
		});

		/* One for the wood... */
		var woodCounter = getResourceCounter({
			startdate: 1358612660,
			interval: 2000,
			available: 9396.23888907,
			limit: [0, 15000],
			production: 0.00555555555556,
			valueElem: "value_wood"
			});
		if(woodCounter) {
			woodCounter.subscribe("update", function() {
				IKARIAM.currentCity.resources.wood = woodCounter.currentRes;
				});
			}

		/* ...one for the tradegood... */
				var tradegoodCounter = getResourceCounter({
			startdate: 1358612660,
			interval: 2000,
		 	available: 15000,
			limit: [0, 15000],
			production: 0,
				valueElem: "value_crystal"
			});
		if(tradegoodCounter) {
			tradegoodCounter.subscribe("update", function() {
				IKARIAM.currentCity.resources.crystal = tradegoodCounter.currentRes;
				});
			}

		var localTime = new Date();
		var startServerTime = localTime.getTime() - (3600000) - localTime.getTimezoneOffset()*60*1000; // GMT+1+Sommerzeit - offset
		var obj_ServerTime = 0;
		Event.onDOMReady(function() {
		    var ev_updateServerTime = setInterval("updateServerTime()", 500);
		    obj_ServerTime = document.getElementById('servertime');
		});
		function updateServerTime() {
		    var currTime = new Date();
		    // New: currTime.setTime((1358612660000-startServerTime)+ currTime.getTime()) ;
		    currTime.setTime(currTime.getTime()) ;
		    str = getFormattedDate(currTime.getTime(), 'd.m.Y G:i:s');
		    obj_ServerTime.innerHTML = str;
		}
		function jsTitleTag(nextETA) {
		    this.nextETA = nextETA;
		    var thisObj = this;
		    var cnt = new Timer(nextETA, 1358612660, 1);
		    //cnt.currentdate *= 1000; // obsolete?
			//top.document.title = "iZariam - World Alpha";
		    cnt.subscribe("update", function() {
		        var timeargs = this.enddate - Math.floor(this.currenttime/1000) *1000;
		        var title = "iFARM - ";
		        if (timeargs != "")
		            title += getTimestring(timeargs, 3, undefined, undefined, undefined, true) + " - ";
		        title += "World Alpha";
		        top.document.title = title;
		    })
		    cnt.subscribe("finished", function() {
		        top.document.title = "iZariam" + " - World Alpha";
		    });
		    cnt.startTimer();
		    return cnt;
		}

				
		// Notizzetel
		var avatarNotes = null;
		// var allyChat = null;

		function switchNoteDisplay() {
		    document.cookie = 'notes=0; expires=Thu, 01-Jan-70 00:00:01 GMT;';
		    var noteLayer = Dom.get("avatarNotes");
		    if (noteLayer.style.display == "block") {
		        avatarNotes.save();
		        noteLayer.style.display = "none";
		    } else {
		        if (noteLayer.innerHTML == "") { // nur AjaxRequest starten, wenn Notizen noch nicht geladen sind
		            ajaxRequest('#/', updateNoteLayer);

		            ///setCookie('message', Dom.get("message").text);
		            document.cookie = 'notes=1;';
		        }
		        noteLayer.style.display = "block";
		   }
		    if (avatarNotes instanceof Notes) {
		        setCookie( 'ikariam_notes_x', Dom.get("resizablepanel_c").style.left, '9999', '/', '', '' );
		        setCookie( 'ikariam_notes_y', Dom.get("resizablepanel_c").style.top, '9999', '/', '', '' );
		        setCookie( 'ikariam_notes_width', Dom.get("resizablepanel").style.width, '9999', '/', '', '' );
		        setCookie( 'ikariam_notes_height', Dom.get("resizablepanel").style.height, '9999', '/', '', '' );
		        avatarNotes.save();
		    }
		}
		if (getCookie('notes') == 1) {
		    switchNoteDisplay();
		}

		function updateNoteLayer(responseText) {
		    var noteLayer = Dom.get("avatarNotes");
		    noteLayer.innerHTML = responseText;
		            var panel = new YAHOO.widget.Panel("resizablepanel", {
		                draggable: true,
		                width: getCookie("ikariam_notes_width", "470px"),
		                height: getCookie("ikariam_notes_height", "320px"),
		                autofillheight: "body", // default value, specified here to highlight its use in the example
		                constraintoviewport:true,
		                context: ["tl", "bl"]
		            });
		            panel.render();
		            var resize = new YAHOO.util.Resize("resizablepanel", {
		                handles: ["br"],
		                autoRatio: false,
		                minWidth: 220,
		                minHeight: 110,
		                status: false
		            });
		            resize.on("startResize", function(args) {
		                if (this.cfg.getProperty("constraintoviewport")) {
		                    var D = YAHOO.util.Dom;
		                    var clientRegion = D.getClientRegion();
		                    var elRegion = D.getRegion(this.element);
		                    resize.set("maxWidth", clientRegion.right - elRegion.left - YAHOO.widget.Overlay.VIEWPORT_OFFSET);
		                    resize.set("maxHeight", clientRegion.bottom - elRegion.top - YAHOO.widget.Overlay.VIEWPORT_OFFSET);
		                } else {
		                    resize.set("maxWidth", null);
		                    resize.set("maxHeight", null);
		                }
		            }, panel, true);
		            resize.on("resize", function(args) {
		                var panelHeight = args.height;
		                this.cfg.setProperty("height", panelHeight + "px");
		                Dom.get("message").style.height = (panelHeight-75) + "px";
		            }, panel, true);
		            avatarNotes = new Notes();
		            avatarNotes.setMaxChars(8192);
		            avatarNotes.init(Dom.get("message"), Dom.get("chars"));
		            Dom.get("resizablepanel_c").style.top = getCookie("ikariam_notes_y", "80px");
		            Dom.get("resizablepanel_c").style.left = getCookie("ikariam_notes_x", "375px");
		            Dom.get("message").style.height = (parseInt(getCookie("ikariam_notes_height", "320px")) - 75 ) + "px";
		}
		/* New code
		/* type: "avatarNotes" (notizzettel) or "chatWindow" 
		function switchNoteDisplay(type) {
			
		    var cookieText = "notes";
			var callBackFunc = updateNoteLayer;
			
			if (type == "chatWindow") {
				cookieText = "chat";
				callBackFunc = updateChatLayer;
			}

		    var mycookie = new Cookie("ik_global", 7);
		    var noteLayer = Dom.get(type);
			if (typeof(noteLayer) == 'undefined' || noteLayer == null) return;
			
		    if (noteLayer.style.display == "block") {
		        if (type == "avatarNotes")  avatarNotes.save();
		        if (type == "chatWindow") allyChat.close();
		        noteLayer.style.display = "none";
		        mycookie.set(cookieText, '0');
		    } else {
		        if (noteLayer.innerHTML == "") { // nur AjaxRequest starten, wenn Notizen noch nicht geladen sind
		            ajaxRequest('?view='+type, callBackFunc);
		        } else if (type == "chatWindow") {
		            allyChat.poll();
		        }
		        noteLayer.style.display = "block";
		        if (allyChat && type == "chatWindow") allyChat.scrolldown();
		        mycookie.set(cookieText, '1');
		   }   
		}
		 
		Event.onDOMReady( function() {
		    var mycookie = new Cookie("ik_global", 7);
		    if (mycookie.get('notes') == '1') {
		        switchNoteDisplay('avatarNotes');
		    }
		});

		function toggleChatInfo() {
		    var chatWindow = Dom.get("chatWindow");
		    var chatInfo = Dom.getElementsByClassName("chat_info", "div" ,chatWindow)[0];
		    if (chatInfo.style.display == 'none') {
		        chatInfo.style.display = 'block';
		    } else {
		        chatInfo.style.display = 'none';
		    }
		    allyChat.scrolldown();
		}

		function updateChatLayer(responseText) {
			 Dom.get("chatWindow").innerHTML = responseText;
		     makePopupResizable("chat");
			 updateChatView();
		     var mycookie = new Cookie("ik_global", 7);
		     if (mycookie.get("chatInfo") == '1') toggleChatInfo();
		     allyChat.scrolldown();
		}

		function updateNoteLayer(responseText) {
		    Dom.get("avatarNotes").innerHTML = responseText;
			makePopupResizable("notes");
			updateNotesView();		
		}

		function updateNotesView() {
			   avatarNotes = new Notes();
			   avatarNotes.setMaxChars(200);
			   avatarNotes.init(Dom.get("notesMessages"), Dom.get("chars_notes"));
		}
		function updateChatView() {
			}

		function makePopupResizable(type) {
			
			var heightOffset = 75;
			if (type === "chat") heightOffset = 100;
		    var mycookie = new Cookie("ik_global", 7);
		    var cookie_w = mycookie.get(type+"_width");
		    var cookie_h = mycookie.get(type+"_height");
		    var cookie_x = mycookie.get(type+"_x");
		    var cookie_y = mycookie.get(type+"_y");
			
			// Create a panel Instance, from the 'resizablepanel' DIV standard module markup
			var panel = new YAHOO.widget.Panel("resizablepanel_"+type, {
				draggable: true,
				width: (cookie_w ? cookie_w : "470px"),
				height: (cookie_h ? cookie_h : "320px"),
				autofillheight: "body", // default value, specified here to highlight its use in the example
				constraintoviewport:true,
				context: ["tl", "bl"]
			});
			panel.render();

			// Create Resize instance, binding it to the 'resizablepanel' DIV 
			var resize = new YAHOO.util.Resize("resizablepanel_"+type, {
				handles: ["br"],
				autoRatio: false,
				minWidth: type === 'chat' ? 400 : 220,
				minHeight: type === 'chat' ? 300 : 110,
				status: false 
			});

			// Setup startResize handler, to constrain the resize width/height
			// if the constraintoviewport configuration property is enabled.
			resize.on("startResize", function(args) {

				if (this.cfg.getProperty("constraintoviewport")) {
					var clientRegion = Dom.getClientRegion();
					var elRegion = Dom.getRegion(this.element);

					resize.set("maxWidth", clientRegion.right - elRegion.left - YAHOO.widget.Overlay.VIEWPORT_OFFSET);
					resize.set("maxHeight", clientRegion.bottom - elRegion.top - YAHOO.widget.Overlay.VIEWPORT_OFFSET);
				} else {
					resize.set("maxWidth", null);
					resize.set("maxHeight", null);
				}

			}, panel, true);

			// Setup resize handler to update the Panel's 'height' configuration property 
			// whenever the size of the 'resizablepanel' DIV changes.

			// Setting the height configuration property will result in the 
			// body of the Panel being resized to fill the new height (based on the
			// autofillheight property introduced in 2.6.0) and the iframe shim and 
			// shadow being resized also if required (for IE6 and IE7 quirks mode).
			resize.on("resize", function(args) {
				var panelHeight = args.height;
				this.cfg.setProperty("height", panelHeight + "px");
				Dom.get(type+"Messages").style.height = (panelHeight - heightOffset) + "px";
				if (type == "chat") {
						
					 Dom.get("chatpartners").style.height = (panelHeight - heightOffset) + "px";
				 	 Dom.get("js_ResizeMessages").style.width = (Dom.get("resizablepanel_chat").offsetWidth - Dom.get("chatpartners").offsetWidth - 40) + "px";
				
				}
			}, panel, true);
			
			Dom.get("resizablepanel_"+type+"_c").style.top = (cookie_y ? cookie_y : "80px");
			Dom.get("resizablepanel_"+type+"_c").style.left = (cookie_x ? cookie_x : "375px");
			var newHeight = (parseInt((cookie_h ? cookie_h : "320px")) - heightOffset ) + "px";
			Dom.get(type+"Messages").style.height = newHeight;
			if (type == "chat") {
				 var chatcontainer = Dom.get("resizablepanel_chat");
				 Dom.get("chatpartners").style.height = newHeight;
				 Dom.get("js_ResizeMessages").style.width = (Dom.get("resizablepanel_chat").offsetWidth - Dom.get("chatpartners").offsetWidth - 40) + "px";
			}
		}
		window.onunload = function() {
			var mycookie = new Cookie("ik_global", 7);
			if (avatarNotes instanceof Notes) {
				mycookie.set( 'notes_x', Dom.get("resizablepanel_notes_c").style.left);
				mycookie.set( 'notes_y', Dom.get("resizablepanel_notes_c").style.top);
				mycookie.set( 'notes_width', Dom.get("resizablepanel_notes").style.width);
				mycookie.set( 'notes_height', Dom.get("resizablepanel_notes").style.height);
				avatarNotes.save();
			}
		}
		End new code */
		window.onunload = function() {
		    if (avatarNotes instanceof Notes) {
		        setCookie( 'ikariam_notes_x', Dom.get("resizablepanel_c").style.left, '9999', '/', '', '' );
		        setCookie( 'ikariam_notes_y', Dom.get("resizablepanel_c").style.top, '9999', '/', '', '' );
		        setCookie( 'ikariam_notes_width', Dom.get("resizablepanel").style.width, '9999', '/', '', '' );
		        setCookie( 'ikariam_notes_height', Dom.get("resizablepanel").style.height, '9999', '/', '', '' );
		        avatarNotes.save();
		    }
		}
		function resizeChat()
		{

		}
		function setCookie(name, value, expires, path, domain, secure)
		{
			var today = new Date();
			today.setTime( today.getTime() );

		    if ( expires ) {
		        expires = expires * 1000 * 60 * 60 * 24;
		    }
		    var expires_date = new Date( today.getTime() + (expires) );
		    document.cookie = name + "=" +escape( value ) + ((expires) ? ";expires=" + expires_date.toGMTString() : "" ) + ((path) ? ";path=" + path : "" ) + ((domain) ? ";domain=" + domain : "" ) + ((secure) ? ";secure" : "" );
		}
		function getCookie ( check_name, def_val ) {
		    var a_all_cookies = document.cookie.split( ';' );
		    var a_temp_cookie = '';
		    var cookie_name = '';
		    var cookie_value = '';
		    var b_cookie_found = false;
		    for (i=0; i<a_all_cookies.length; i++) {
		        a_temp_cookie = a_all_cookies[i].split( '=' );
		        cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
		        if ( cookie_name == check_name ) {
		            b_cookie_found = true;
		            if ( a_temp_cookie.length > 1 ) {
		                cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
		            }
		            return cookie_value;
		            break;
		        }
		        a_temp_cookie = null;
		        cookie_name = '';
		    }
		    if (!b_cookie_found ) {
		        return def_val;
		    }
		}
				//document.getElementsByTagName("DIV")[0].style.display = 'none';
			</script>
	<div id="fb-root"></div>
		</body>
</html>