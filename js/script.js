var w3c = (document.getElementById) ? 1:0
var ns4 = (document.layers) ? 1:0  //browser detect for NS4 & W3C standards
var hasCookies = false;
  
//tests whether the user accepts cookies, and sets a flag.
if(document.cookie == '') {
    document.cookie = 'hasCookies=yes';
    if (document.cookie.indexOf('hasCookies=yes') != -1) hasCookies = true;
}
else hasCookies = true;

// sets a cookie in the browser.
function setCookie(name, value, hours, path) {
    if (hasCookies) {
        if(hours) {
            if ( (typeof(hours) == 'string') && Date.parse(hours) ) var numHours = hours;
            else if (typeof(hours) == 'number') var numHours = (new Date((new Date()).getTime() + hours*3600000)).toGMTString();
        }
        document.cookie = name + '=' + escape(value) + ((numHours)?(';expires=' + numHours):'') + ((path)?';path=' + path:'');
    }
}
 
// reads a cookie from the browser
function readCookie(name) {
    if (document.cookie == '') return '';
    else {
        var firstChar, lastChar;
        var theBigCookie = document.cookie;
        firstChar = theBigCookie.indexOf(name);
        if (firstChar != -1) {
            firstChar += name.length + 1;
            lastChar = theBigCookie.indexOf(';', firstChar);
            if (lastChar == -1) lastChar = theBigCookie.length;
            return unescape(theBigCookie.substring(firstChar, lastChar));
        }
        else return '';
    }
}

function toggleFoldyPersistState(divID) {
    var theCookie = readCookie(divID);
    var state='none';
    if (theCookie == 'none') {
        state='block';
    }
    setCookie(divID, state, 'Wed 01 Jan 2020 00:00:00 GMT', '/');
    return state;
}

function MM_findObj(n, d) { //v4.0
    var p,i,x;
    if (!d) d=document;
    if ((p=n.indexOf("?"))>0&&parent.frames.length) {
        d=parent.frames[n.substring(p+1)].document;
        n=n.substring(0,p);
    }
    if (!(x=d[n]) && d.all)
        x=d.all[n];
    for (i=0; !x && i<d.forms.length; i++)
        x=d.forms[i][n];
    for (i=0; !x && d.layers && i<d.layers.length; i++)
        x=MM_findObj(n,d.layers[i].document);
    if (!x && document.getElementById)
        x=document.getElementById(n);
    return x;
}

function showHideModuleMouseOver(divID) {
    var theCookie = readCookie(divID);
    if (theCookie == 'none') {
        window.status = 'Hide';
    }
    else {
        window.status = 'Show';
    }
}

function showHideModule(divID) {      
    var state = toggleFoldyPersistState(divID);
    var ok=false;                     
    if(w3c) {                         
        var divIDobj = MM_findObj(divID);
        var toggleobj = MM_findObj(divID + 'Bullet');
        if(divIDobj != null && toggleobj != null) {
            ok = true;
            if (state == 'none') {
                toggleobj.src = '/images/administration/bulletRight.gif';
                divIDobj.style.display = 'none';
            } else {  
                toggleobj.src = '/images/administration/bulletDown.gif';
                divIDobj.style.display = 'block';
            }
        }
    }

    if(!ok){
        document.location = document.location;
    }

    showHideModuleMouseOver(divID);
}

function MM_swapImage() { //v3.0
    var i,j=0,x,a=MM_swapImage.arguments;
    document.MM_sr=new Array;
    for(i=0; i<(a.length-2); i+=3)
        if ((x=MM_findObj(a[i]))!=null){
            document.MM_sr[j++]=x;
            if(!x.oSrc) x.oSrc=x.src;
            x.src=a[i+2];
        }
}

function MM_swapImgRestore() { //v3.0
    var i,x,a=document.MM_sr;
    for(i=0;a && i<a.length && (x=a[i]) && x.oSrc;i++)
        x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
    var d=document;
    if(d.images) {
        if(!d.MM_p)
            d.MM_p=new Array();
        var i,j=d.MM_p.length,a=MM_preloadImages.arguments;
        for(i=0; i<a.length; i++)
            if (a[i].indexOf("#")!=0) {
                d.MM_p[j]=new Image;
                d.MM_p[j++].src=a[i];
            }
    }
}

function MM_getButtonWithName(form, buttonName) {
    if (form.buttons) {
        var buttonCount = form.buttons.length;
        for (i = 0; i < buttonCount; i++) {
            var button = form.buttons[i];
            if (button.mName == buttonName) {
                return button;
            }
        }
    }
    return null;
}

function MMCommandButton(name,
    form,
    action,
    enabledImage,
    overImage,
    downImage,
    disabledImage,
    enabled,
    enableOnNoSelection,
    enableOnSingleSelection,
    enableOnMultipleSelection,
    altText,
    confirmation,
    confirmationMessage) {
    this.mName = name;						// Name of the image
    this.mForm = form;						// The form object enclosing this button (to retrieve selections)
    this.mAction = action;					// Action to perform when clicking
    this.mEnabledImage = enabledImage;		// enabled image (String)
    this.mOverImage = overImage;			// over image (String)
    //this.mDownImage = downImage;			// down image (String)
    this.mDisabledImage = disabledImage;	// disabled image (String)
    this.mEnableOnNoSelection = enableOnNoSelection;
    this.mEnableOnSingleSelection = enableOnSingleSelection;
    this.mEnableOnMultipleSelection = enableOnMultipleSelection;
    this.mAltText = altText;
    this.mConfirmation = confirmation;
    this.mConfirmationMessage = confirmationMessage;
    this.mEnabled = enabled;

    this.update = MMCommandButton_update;
    this.over = MMCommandButton_over;
    this.out = MMCommandButton_out;
    this.click = MMCommandButton_click;
}

function MMCommandButton_update(selectedItems) {

    if (selectedItems == 0) {
        if (this.mEnableOnNoSelection == true) {
            document[this.mName].src = this.mEnabledImage;
            this.mEnabled = true;
        } else {
            document[this.mName].src = this.mDisabledImage;
            this.mEnabled = false;
        }
    }

    if (selectedItems == 1) {
        if (this.mEnableOnSingleSelection == true) {
            document[this.mName].src = this.mEnabledImage;
            this.mEnabled = true;
        } else {
            document[this.mName].src = this.mDisabledImage;
            this.mEnabled = false;
        }
    }

    if (selectedItems > 1) {
        if (this.mEnableOnMultipleSelection == true) {
            document[this.mName].src = this.mEnabledImage;
            this.mEnabled = true;
        } else {
            document[this.mName].src = this.mDisabledImage;
            this.mEnabled = false;
        }
    }
}

// returns an object reference.
function getObject(obj) {
    if (w3c) {
        var theObj = document.getElementById(obj);
    } else
    if (ns4)
        var theObj = eval('document.' + obj);
    return theObj;
}

// swaps text in a layer.
function swapText(text, divID, innerDivID) {
    var innerDivID=divID + 'NN';

    if (w3c) {
        var theObj = getObject(divID);
        if (theObj) {
            theObj.innerHTML = text;
        }
    }
    else if (ns4) {
        var innerObj = divID + '.document.' + innerDivID;
        var theObj = getObject(innerObj);
        if (theObj) {
            theObj.document.open();
            theObj.document.write(text);
            theObj.document.close();
        }
    }
}

function MMCommandButton_over() {
    if (this.mEnabled) {
        document[this.mName].src = this.mOverImage;
    }

    // To whom it may concern. If you are revisiting this code in order
    // to speed it up, note that the thing slowing down the rollovers is
    // this call to swapText.
    swapText(this.mAltText, this.mForm.actionDescription);

    window.status= this.mAltText;
}

function MMCommandButton_out() {
    if (this.mEnabled) {
        document[this.mName].src = this.mEnabledImage;
    }
    swapText('', this.mForm.actionDescription);
    window.status = '';
}

function submitAction(form, value) {
    if (value.indexOf('previewInWindow') != -1) {
        form.target = 'previewInWindow'
        windowOpen('previewInWindow', '', 700, 650, 0, 0, 0, 1, 1);
    }

    for (i=0; i<form.lenght; i++) {
        if (form.elements[i].name == 'do')
            break;
    }

    if (i != form.length) {
        old = form.elements[i].value;
        form.elements[i].value = value;
        form.submit();
        form.elements[i].value = old;
    }
}

function MMCommandButton_click() {
    if (this.mEnabled) {
        //document[this.mName].src = this.mDownImage;

        if (this.mConfirmation) {
            if (!confirm(this.mConfirmationMessage)) {
                return;
            }
        }
        submitAction(this.mForm, this.mAction);
    }
    swapText('', this.mForm.actionDescription);
    window.status = '';
}

function MM_toggleItem(form, itemName) {
    count = 0;

    for ($i=0; $i<form.length; $i++) {
        if (form.elements[$i].name == itemName &&
            form.elements[$i].checked == true &&
            (form.elements[$i].type.toLowerCase() == 'checkbox' || form.elements[$i].type.toLowerCase() == 'radio')) {
            count++;
        }
    }

    MM_updateButtonsState(form, count);
}

function MM_updateButtonsState(form, selectedItems) {
    if (form.buttons) {
        var buttonCount = form.buttons.length;

        for (i = 0; i < buttonCount; i++) {
            var button = form.buttons[i];
            if (button) {
                button.update(selectedItems);
            }
        }
    }
}

//common functions
function selectAll(form, itemName, mark) {
    for (i = 0; i < form.elements.length; i++) {
        if (form.elements[i].name == itemName) {
            form.elements[i].checked = mark;
        };
    }
}

function installSelectElement(element, value) {
    for(i=0; i<element.length; i++) {
        if (element.options[i].value == value)
            element.options[i].selected = true;
    }
}

function sendOrderForm(pathForm, objectName, orderPosition, defaultOrderDirection) {
    cookieOrderPosition		= readCookie(objectName + '[orderPosition]');
    cookieOrderDirection	= readCookie(objectName + '[orderDirection]');

    if (cookieOrderPosition == '') {
        cookieOrderDirection = defaultOrderDirection;
    } else if (cookieOrderPosition == orderPosition) {
        if (cookieOrderDirection == 'desc') {
            cookieOrderDirection = 'asc';
        } else {
            cookieOrderDirection = 'desc';
        }
    }

    var path = '' + document.location;
    path = path.substr(path.indexOf('/', 10), path.indexOf('index.php') - path.indexOf('/', 10));

    setCookie(objectName + '[orderPosition]', orderPosition, 'Wed 01 Jan 2020 00:00:00 GMT', path);
    setCookie(objectName + '[orderDirection]', cookieOrderDirection, 'Wed 01 Jan 2020 00:00:00 GMT', path);

    pathForm.submit();
}

function windowOpen(name, url, width, height, toolbar, menubar, statusbar, scrollbar, resizable) {
    var wint = (screen.height - height) / 2;
    var winl = (screen.width - width) / 2;
    toolbar_str = toolbar ? 'yes' : 'no';
    menubar_str = menubar ? 'yes' : 'no';
    statusbar_str = statusbar ? 'yes' : 'no';
    scrollbar_str = scrollbar ? 'yes' : 'no';
    resizable_str = resizable ? 'yes' : 'no';
    window.open(url, name, 'left='+winl+',top='+wint+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}

function showGroupItems(action, objects, value, mForm) {

    setCookie(action + objects + 'Group', value, 'Wed 01 Jan 2020 00:00:00 GMT','/');

    for (i=0; i<mForm.elements.length; i++) {
        if (mForm.elements[i].name == 'offset' + objects + 'Block') {
            mForm.elements[i].value = '';
            break;
        }
    }
    mForm.submit();
}

function changeLocation(path, i) {
    path.position.value = i;
    path.submit();
}

function changeAction(form, action) {
    for(i=0; i < form.length; i++) {
        if (form.elements[i].name == 'do') {
            form.elements[i].value = action;
        }
    }
    message = 'Are you sure you want to delete it?';
    if (action.indexOf('delete') == -1 || (action.indexOf('delete') != -1 && confirm(message))) {
        myForm.submit();
    }
}

function showHideBlock(block) {
    obj = document.getElementById(block);
    obj.style.display = (obj.style.display == 'none') ? 'block' : 'none';
}

function showHideBlockByElement(element, block) {
    obj = document.getElementById(block);
    obj.style.display = (element.checked) ? 'block' : 'none';
}

function number_format(number, decimals, point, separator) {
    var number = Math.round(number * Math.pow(10, decimals)) / Math.pow(10, decimals);

    var e = number + '';
    var f = e.split('.');

    if (!f[0]) {
        f[0] = '0';
    }

    if (!f[1]) {
        f[1] = '';
    }

    if (f[1].length < decimals) {
        g = f[1];

        for (var i=f[1].length + 1; i <= decimals; i++) {
            g += '0';
        }

        f[1] = g;
    }

    if(separator != '' && f[0].length > 3) {
        var h = f[0];

        f[0] = '';

        for(var j = 3; j < h.length; j+=3) {
            i = h.slice(h.length - j, h.length - j + 3);
            f[0] = separator + i +  f[0] + '';
        }

        j = h.substr(0, (h.length % 3 == 0) ? 3 : (h.length % 3));

        f[0] = j + f[0];
    }

    point = (decimals <= 0) ? '' : point;

    return f[0] + point + f[1];
}

function getRateFormat(value, size) {
	if (!size) {
		size = 3;
	}
    return number_format(parseFloat(value), size, '.', '');
}

function getMoneyFormat(amount, value) {
    var result = number_format(parseFloat(amount), 2, ',', ' ');

    if (!value) {
        result += ' грн.';
    }

    return result;
}

function addListener(element, type, expression, bubbling) {
    bubbling = bubbling || false;

    if(window.addEventListener) {// Standard
        element.addEventListener(type, expression, bubbling);
        return true;
    } else if(window.attachEvent) {// IE
        element.attachEvent('on' + type, expression);
        return true;
    } else {
        return false;
    }
}

function setFocus(form, i) {
    while (i < form.length && form.elements[ i ].type == 'hidden') {
        i++;
    }

    if (i < form.length && !form.elements[ i ].readonly && !form.elements[ i ].disabled) {
        form.elements[ i ].focus();
    }
}

function sendFocus(event) {

    element = (this.name) ? this : event.srcElement;

    if (event.keyCode == 13) {
        for (var i=0; i < element.form.length; i++) {
            if (element.form.elements[i].name == element.name) {
                setFocus(element.form, i + 1);
            }
        }
    }
}

function applyPhoneFormat(event) {

    element = (this.name) ? this : event.srcElement;

    var str = element.value.replace('[()]', '');

    switch (str.indexOf(' ')) {
        case 3:
            var input	= /(\d{3}).*(\d{3}).*(\d{2}).*(\d{2})/;
            var output	= /^\((\d{3})\).(\d{3})-(\d{2})-(\d{2})$/;
            break;
        case 4:
            var input	= /(\d{4}).*(\d{2}).*(\d{2}).*(\d{2})/;
            var output	= /^\((\d{4})\).(\d{2})-(\d{2})-(\d{2})$/;
            break;
        case 5:
            var input	= /(\d{5}).*(\d{1}).*(\d{2}).*(\d{2})/;
            var output	= /^\((\d{5})\).(\d{1})-(\d{2})-(\d{2})$/;
            break;
    }

    if (!element.value.match(output)) {

        var result = element.value.match(input);

        if (result != null) {
            element.value = element.value.replace(/[^\d]/gi, '');
            element.value = '(' + result[1] + ') ' + result[2] + '-' + result[3] + '-' + result[4];
        } else if (element.value.match(/[^\d\ ]/gi)) {
            element.value = element.value.replace(/[^\d\ ]/gi, '');
        }
    }
}

function initFocus(form) {
    for(var i=0; i < form.elements.length; i++) {
        switch (form.elements[ i ].type) {
            case 'text':
                addListener(form.elements[ i ], 'keypress', sendFocus, false);
                if (form.elements[ i ].className.indexOf('phone') > 0) {
                    addListener(form.elements[ i ], 'keyup', applyPhoneFormat, false);
                }
                break;
            case 'select':
                addListener(form.elements[ i ], 'change', sendFocus, false)
                break;
        }
    }

    setFocus(form, 0);
}

function getElementValue(id) {

        var element;
        if (document.getElementById( id ))
        {
            element = $('#'+id);
        }
        else
        {
            element = $('input[name="'+id+'"]');
            if (!element.attr('name')) element = $('select[name="'+id+'"]');
        }

        if(element.is("select"))
        {
            return element.val();
        }
        else if(element.is("input") && element.attr('type')=='checkbox')
        {
            var val = element.attr('checked') ?  element.val() : 0;
            return val;
        }
        else
             return element.val();
}

Date.prototype.lastday = function() {
    var d = new Date(this.getFullYear(), this.getMonth() + 1, 0);
    return d.getDate();
}

Date.prototype.addDays = function(d) {
    this.setDate( this.getDate() + d );
    return this;
}

Date.prototype.addMonths= function(m) {

    var d = this.getDate();
    this.setMonth(this.getMonth() + m);

    if (this.getDate() < d)
        this.setDate(0);
    return this;
}

Date.prototype.addYears = function(y) {

    var m = this.getMonth();
    this.setFullYear(this.getFullYear() + y);

    if (m < this.getMonth()) {
        this.setDate(0);
    }
    return this;
}

function setSelect(from, to) {
    var fromValue = getElementValue(from);
	var element;
	if (document.getElementById( to ))
    {
         element = $('#'+to);
    }
    else
    {
          element = $('input[name="'+to+'"]');
          if (!element.attr('name')) element = $('select[name="'+to+'"]');
    }
	element.val(fromValue);
}

function setSelectValues(from, to) {
    var fromValue = getElementValue(from);
	var element;
	if (document.getElementById( to ))
    {
         element = $('#'+to);
    }
    else
    {
          element = $('input[name="'+to+'"]');
          if (!element.attr('name')) element = $('select[name="'+to+'"]');
    }
	element.val(fromValue);
}
function explode (delimiter, string, limit) {
    // Splits a string on string separator and return array of components. If limit is positive only limit number of components is returned. If limit is negative all components except the last abs(limit) are returned.  
    // 
    // version: 909.322
    // discuss at: http://phpjs.org/functions/explode
    // +     original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: kenneth
    // +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: d3x
    // +     bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: explode(' ', 'Kevin van Zonneveld');
    // *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
    // *     example 2: explode('=', 'a=bc=d', 2);
    // *     returns 2: ['a', 'bc=d']
 
    var emptyArray = { 
        0: ''
    };
    
    // third argument is not required
    if ( arguments.length < 2 ||
        typeof arguments[0] == 'undefined' ||
        typeof arguments[1] == 'undefined' )
        {
        return null;
    }
 
    if ( delimiter === '' ||
        delimiter === false ||
        delimiter === null )
        {
        return false;
    }
 
    if ( typeof delimiter == 'function' ||
        typeof delimiter == 'object' ||
        typeof string == 'function' ||
        typeof string == 'object' )
        {
        return emptyArray;
    }
 
    if ( delimiter === true ) {
        delimiter = '1';
    }
    
    if (!limit) {
        return string.toString().split(delimiter.toString());
    } else {
        // support for limit argument
        var splitted = string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;
    }	
}

function holdSession() {
	$.ajax({
		type:  'POST',
		url:  'index.php',
		dataType: 'html',
		async:  false,
		data:  'do=Users|workInWindow',
		success: function(result) {
			}
	});

	setTimeout("holdSession()", 60000*5);
}

/*function roundNumber(number, decimal) {
	var one = Math.floor(number);

    var parts = number.toString().split('.'.toString());
	var two = parseFloat('0.'+parts[1]);
    if (parts.length == 2 && parts[1].length > decimal) {
        //i = parts[1].length - 1;
        //number = roundNumber(Math.round(parseFloat(number) * Math.pow(10,i)) / Math.pow(10,i), decimal);
	for(i=parts[1].length;i>=decimal;i--){
		buf = two * Math.pow(10,i) - Math.floor(two * Math.pow(10,i));
//alert(buf);
		if (buf < 0.5) {
			two = (two * Math.pow(10,i) - buf) / Math.pow(10,i);
		} else {
			two = (two * Math.pow(10,i) - buf + 1) / Math.pow(10,i);
		}
	}
		//two = parseFloat(two).toFixed(i);
    }
	return parseFloat(one)+parseFloat(two);
    //return number;
}*/

function roundNumber(number, decimal) {
	var one = Math.floor(number);

    var parts = number.toString().split('.'.toString());
	var two = parseFloat('0.'+parts[1]);
    if (parts.length == 2 && parts[1].length > decimal) {
		two = parseInt(parts[1]);
		
        //i = parts[1].length - 1;
        //number = roundNumber(Math.round(parseFloat(number) * Math.pow(10,i)) / Math.pow(10,i), decimal);
	for(i=parts[1].length;i>decimal;i--){
		//buf = two * Math.pow(10,i) - Math.floor(two * Math.pow(10,i));
		//alert(parseInt(parts[1]) % 10);
		//buf = parseInt(parts[1]) - Math.floor(parseInt(parts[1]));

		if (two % 10 < 5) {
			//two = (two * Math.pow(10,i) - buf) / Math.pow(10,i);
			two = parseInt(two / 10);
		} else {
			two = parseInt(two / 10) + 1;
		}
	}
		//two = parseFloat(two).toFixed(i);
		return parseFloat(one)+parseFloat(two / Math.pow(10, decimal));
    }

	return number;
    //return number;
}

function isValidDate(year, month, day) {
    var d = new Date(year, month, day);

    return d.getFullYear() === year && d.getMonth() === month && d.getDate() === day;
}

String.prototype.replaceArray = function(find, replace) {
  var replaceString = this;
  for (var i = 0; i < find.length; i++) {
	regex = new RegExp(find[i], "g");
    replaceString = replaceString.replace(regex, replace[i]);
  }
  return replaceString;
}

function fixSignSimbols(sign) {
    sign = sign.toUpperCase();

    latin      = ['E', 'T', 'I', 'O', 'P', 'A', 'H', 'K', 'X', 'C', 'B', 'M'];
    ukraine    = ['Е', 'Т', 'І', 'О', 'Р', 'А', 'Н', 'К', 'Х', 'С', 'В', 'М'];

    //set latin symbols
    sign = sign.replaceArray(latin, ukraine);

    /*if (!isValidSign(sign)) {
        sign = sign.replaceArray(latin, ukraine);
		console.log(sign);
    }*/

    return sign;
}

function isValidSign(sign) {

    if (sign) {
        patterns = [//українські
                        '[0-9]{5}[А-ЯІЇЄ]{2}',
                        '[0-9]{4}[А-ЯІЇЄ]{2}',
                        '[А-ЯІЇЄ]{2}[0-9]{5}',
                        '[0-9]{4}[А-ЯІЇЄ]{3}',
                        '[А-ЯІЇЄ]{1}[0-9]{4}[А-ЯІЇЄ]{2}',
                        '[0-9]{4}',
                        '[0-9]{4}[А-ЯІЇЄ]{1}[0-9]{1}',
						
						'[A-Z]{2}[0-9]{4}[A-Z]{2}',
						
                        '[А-ЯІЇЄ]{2}[0-9]{4}[А-ЯІЇЄ]{2}',
                        '[0-9]{2}[А-ЯІЇЄ]{2}[0-9]{4}',
                        '[А-ЯІЇЄ]{1}[0-9]{1}[А-ЯІЇЄ]{2}[0-9]{4}',
                        //іноземні
						'[А-ЯІЇЄ]{1}[0-9]{3}[А-ЯІЇЄ]{2}[0-9]{3}',
                        'CDP[0-9]{4}',
                        '[0-9]{3}CDP[0-9]{4}',
                        'DP[0-9]{5}',
                        'DP[0-9]{4}',
                        '[0-9]{3}DP[0-9]{4}',
                        'F[0-9]{6}',
                        '[0-9]{3}F[0-9]{5}',
                        'S[0-9]{5}',
                        '[0-9]{3}S[0-9]{5}',
                        'CMD[0-9]{4}',
                        'B[0-9]{5}',
                        '[0-9]{3}B[0-9]{5}',
                        'C[0-9]{5}',
                        'C[0-9]{6}',
                        '[0-9]{3}C[0-9]{5}',
                        'CC[0-9]{4}',
                        '[0-9]{3}CC[0-9]{4}',
                        'D[0-9]{6}',
                        '[0-9]{3}D[0-9]{5}',
                        'T[0-9]{6}',
                        'M[0-9]{6}',
                        'K[0-9]{6}',
                        'H[0-9]{6}',
                        'P[0-9]{6}',
                        '[A-Z]{4}[0-9]{3}'];
console.log(sign);						
        for(pattern in patterns) {
            if (sign.search(patterns[pattern]) == 0) {
                return true;
            }			
        }

        return false;
    }
}