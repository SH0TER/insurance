/*
 * JTip
 * By Cody Lindley (http://www.codylindley.com)
 * Under an Attribution, Share Alike License
 * JTip is built on top of the very light weight jquery library.
 */
var mX;
var mY;
var offset = 2;
var currentId = false;
var maxPopupHeight = 150;
var currentLinkIdTop;

//on page load (as soon as its ready) call JT_init
$(document).ready(JT_init);

function tipUpdate(){
//	if(document.getElementById('JT_copy').offsetHeight < maxPopupHeight){
		document.getElementById('JT_copy').style.height = '';
		var de = document.documentElement;
		var h = self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;
		if(h < document.getElementById('JT').offsetHeight){
			document.getElementById('JT_copy').style.height = h-50;
		}
		if(h + parseInt(document.body.scrollTop) - getAbsoluteTop('JT') < document.getElementById('JT').offsetHeight){
			var newTop = h - document.getElementById('JT').offsetHeight + parseInt(document.body.scrollTop);
			var arrowTop = currentLinkIdTop - newTop;
			document.getElementById('JT_arrow_left').style.top = arrowTop;
			document.getElementById('JT').style.top = newTop;
		}
//	}
}

function nothing() {
}

function JT_init(){
	       $("a.jTip")
		   .hover(function(){JT_show(this.href,this.id,this.name)})
           .click(function(){return false});	   
}
//,function(){$('#JT').remove()}

function JT_remove(event, linkId, isJT) {

	if (!event) {
		var event = window.event||window.Event;
	}
	
	// get mouse position x,y
    if (event.pageX || event.pageY) {
        mX = event.pageX;
        mY = event.pageY;
    } else if (event.clientX || event.clientY) {
        mX = event.clientX + parseInt(document.body.scrollLeft);
        mY = event.clientY + parseInt(document.body.scrollTop);
    }
/*
	var JT		= document.getElementById('JT');
	var top		= parseInt(JT.style.top) - parseInt(document.body.scrollTop);
	var left	= parseInt(JT.style.left);
	var right	= parseInt(JT.style.left) + parseInt(JT.style.width);
*/

	if(isJT != 1){ // linkId out is here
		var de = document.documentElement;
		
		var w = self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;

		if ((getAbsoluteLeft(linkId) + getElementWidth(linkId) + document.getElementById('JT').offsetWidth < w &&
			(mX-offset <= getAbsoluteLeft(linkId) || 
			mY-offset <= getAbsoluteTop(linkId) || 
			mY+offset >= (getAbsoluteTop(linkId)+document.getElementById(linkId).offsetHeight))) || 
			(getAbsoluteLeft(linkId) + getElementWidth(linkId) + document.getElementById('JT').offsetWidth > w &&
			(mX-offset >= getAbsoluteLeft(linkId) || 
			mY-offset <= getAbsoluteTop(linkId) || 
			mY+offset >= (getAbsoluteTop(linkId)+document.getElementById(linkId).offsetHeight)))
			) {
			currentId = false;
			$("#JT").remove();
		}
	}else if (document.getElementById('JT')){ // JT out is here
		if (mX+offset >= getAbsoluteLeft('JT') + getElementWidth('JT')  || 
			mY-offset <= getAbsoluteTop('JT') || 
			mY+offset >= getAbsoluteTop('JT')+document.getElementById('JT').offsetHeight || 
			(mX-offset <= getAbsoluteLeft('JT') && (mY-offset <= getAbsoluteTop(linkId) || mY+offset >= getAbsoluteTop(linkId) + document.getElementById(linkId).offsetHeight) )  
			) {
			currentId = false;
			$("#JT").remove();
		}
	}
}

function JT_show(url,linkId,title){
	
	if(currentId != linkId && linkId != ''){
		currentLinkIdTop = getAbsoluteTop(linkId);
		currentId = linkId;
		if(title == false)title="&nbsp;";
		var de = document.documentElement;
		
		var w = self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
		var h = self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;

		var hasArea = w - getAbsoluteLeft(linkId);
		
		var queryString = url.replace(/^[^\?]+\??/,'');
		var params = parseQuery( queryString );

		if (params['width'] === undefined){
			params['width']	= 380;
		}

		if (params['height'] === undefined){
			params['height'] = 110;
		}

		if (params['link'] !== undefined){
			$('#' + linkId).bind('click',function(){window.location = params['link']});
			$('#' + linkId).css('cursor','pointer');
		}

		title = "<table width=\"100%\"><tr><td style='color: #FFFFFF; font-weight: bold;'>" + title + "</td><td></td></tr></table>";

		if (document.getElementById('JT')){
			$('#JT').remove();
		}

		var clickElementy = getAbsoluteTop(linkId); // set Y position
		var clickElementx = getAbsoluteLeft(linkId) + getElementWidth(linkId); //set X position

		var arrowOffsetx=0;
		var arrowOffsety=0;
		var style='';

		if (clickElementx + params['width'] > w) {
			clickElementx = getAbsoluteLeft(linkId) - params['width'] + 2;
			style = 'left:100.5%; background: url(/images/administration/arrow_right.gif) right top;';
//			arrowOffsetx = clickElementx - getAbsoluteLeft(linkId) - getElementWidth(linkId);
		}

		var quotedLinkId = '"'+linkId+'"';
		$("body").append("<div id='JT' onmouseout='JT_remove(event,"+quotedLinkId+",1)' style='width:"+params['width']*1+"px;'><div id='JT_arrow_left' style='" + style + "'></div><table cellpadding=0 cellspacing=0 style='width: "+params['width']+"px;'><tr><td><div id='JT_close_left'>"+title+"</div></td></tr><tr><td><div id='JT_copy' style='height:"+params['height']+"px'><div class='JT_loader'></div></div></td></tr></table></div>");
		var jtHeight = document.getElementById('JT').offsetHeight;

		if (clickElementy - parseInt(document.body.scrollTop) > h - jtHeight ) {
			clickElementy = h - jtHeight + parseInt(document.body.scrollTop);
			arrowOffsety = clickElementy - getAbsoluteTop(linkId);
		}

		//var offsetY = h - jtHeight + parseInt(document.body.scrollTop)

		//clickElementy = clickElementy - offsetY;

		$('#JT').css({left: clickElementx+"px", top: clickElementy+"px"});

		document.getElementById('JT_arrow_left').style.top = document.getElementById('JT_arrow_left').style.top - arrowOffsety + "px";

		//$('#JT').show();

		$('#JT_copy').load(url);
	}
}

function getElementWidth(objectId) {
	x = document.getElementById(objectId);
	return x.offsetWidth;
}

function getAbsoluteLeft(objectId) {
	// Get an object left position from the upper left viewport corner
	if (objectId) {
	o = document.getElementById(objectId)
	oLeft = o.offsetLeft            // Get left position from the parent object
	while(o.offsetParent!=null) {   // Parse the parent hierarchy up to the document element
		oParent = o.offsetParent    // Get parent object reference
		oLeft += oParent.offsetLeft // Add parent left position
		o = oParent
	}
	return oLeft;
	}
}

function getAbsoluteTop(objectId) {
	// Get an object top position from the upper left viewport corner
	o = document.getElementById(objectId)
	oTop = o.offsetTop            // Get top position from the parent object
	while(o.offsetParent!=null) { // Parse the parent hierarchy up to the document element
		oParent = o.offsetParent  // Get parent object reference
		oTop += oParent.offsetTop // Add parent top position
		o = oParent
	}
	return oTop
}

function parseQuery ( query ) {
   var Params = new Object ();
   if ( ! query ) return Params; // return empty object
   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) continue;
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}

function blockEvents(evt) {
	if (evt.target) {
		evt.preventDefault();
	} else {
		evt.returnValue = false;
	}
}