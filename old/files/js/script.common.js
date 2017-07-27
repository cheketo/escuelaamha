
// JavaScript Document

//////////////////////////////////////////////////// Submit Data //////////////////////////////////////////////////////
function submitData()
{
	var formFiles;
	var checkValue;
	var checkID;
	var elementID;
	var checkbox    = [];
	var checkboxID 	= [];
	var variables 	= [];
	var data 		= new FormData();
	var i 			= 0;
	var element;
	var id;
	tinyMCE.triggerSave(); // Save trigger for TinyMCE editor
	$('textarea,select,input[type!="checkbox"]').each(function()
	{
		elementID	= $(this).attr("id");
		if($(this).attr("type")=="file")
		{
			formFiles		= document.getElementById(elementID).files;
			element = {id:elementID,value:formFiles[0]}
			variables[variables.length] = element;
		}else{
			element = {id:elementID,value:$(this).val()};
			variables[variables.length] = element;
		}
		
    });

    $('input[type="checkbox"]:checked').each(function()
    {
    	checkID = $(this).attr("id");
    	if(checkboxID.indexOf(checkID)==-1)
    	{
    		checkboxID[checkboxID.length] = checkID;
    		checkValue="";
    		$('input[type="checkbox"][name="'+checkID+'"]:checked').each(function()
    		{
    			if(checkValue!="")
    			{
    				checkValue = checkValue + "," + $(this).val();
    			}else{
    				checkValue = $(this).val();
    			}
    		});
    		variables[variables.length] = {id:checkID,value:checkValue};
    	}
    });

    while(element= variables[i++])
    {
		data.append(element.id,element.value);
	}
	return data;
}

function sumbitFields(process,haveData,noData){
	var data	= submitData();
	$.ajax({
		url: process,
		type:'POST',
		contentType:false,
		data:data,
		processData:false,
		cache:false,
		success: function(rs){
			if(rs)
			{
				haveData(rs);
			}else{
				noData();
			}
		}
	});
}

///////////////////////////////////////////////////// Attach a Selector //////////////////////////////////////////////////
$(function(){	
	$("select,input,textarea").change(function(){
		var attach = $(this).attr("attach");
		if(attach){
			var string = 'value=' + $(this).val();
			var data = attach.split("/");
			var target = $("#"+data[0]);
			var process = data[1];
			var noData = target.attr("default");
			if(target.prop("tagName")=="SELECT") noData = '<option value="' + target.attr("firstvalue") + '">' + target.attr("firsttext") + '</option>';
			$.ajax({
				url: process,
				type:'POST',
				contentType:false,
				data:string,
				processData:false,
				cache:false,
				success: function(rs){
					if(rs)
					{
						target.html(rs);
					}else{
						target.html(noData);
					}
				}
			});
		}

	});
});



//////////////////////////////////////////////////// Pop Up Confirm /////////////////////////////////////////////////////
$(function(){
	$("#PopUpConfirm").click(function(){
		$("#BodyOverlay").fadeOut();
		$("#PopUpWrapper").fadeOut();
	});
	
	$("#PopUpCancel").click(function(){
		$("#BodyOverlay").fadeOut();
		$("#PopUpWrapper").fadeOut();
	});
	
	$("#BodyOverlay").click(function(){
		$("#PopUpCancel").click();
	});
});

function showPopUpConfirm(html)
{
	$("#PopUpBody").html('');
	$("#PopUpBody").html(utf8_decode(html));
	
	var finalHeight		= 0;
	var windowHeight	= window.innerHeight;
	if(!windowHeight) windowHeight	= window.outerHeight;
	if(windowHeight) 
	{
		finalHeight		= (parseInt(windowHeight) - (parseInt($("#PopUpWrapper").css("height"))))/3;
		$("#PopUpWrapper").css("top",finalHeight+"px");
	}else{
		$("#PopUpWrapper").css("top","20%");
	}
	
	var finalWidth		= 0;
	var windowWidth		= window.innerWidth;
	if(!windowWidth) 
			windowWidth	= window.outerWidth;
	if(windowWidth) 
	{
		finalWidth		= (parseInt(windowWidth) - (parseInt($("#PopUpWrapper").css("width"))))/2;
		$("#PopUpWrapper").css("left",finalWidth+"px");
	}else{
		$("#PopUpWrapper").css("left","30%");
	}
	
	$("#BodyOverlay").show();
	$("#PopUpWrapper").show();
}

$(function(){

	////////////////////////////////////////////////////////////////// LIST ACTIONS //////////////////////////////////////////////
	$(".actionImg").click(function(){
		var info	= $(this).attr("id").split('_');
		var action	= $(this).attr("action");
		var process	= $(this).attr("process");
		var target	= $(this).attr("target");
		var id		= info[1];
		listActions(action,id,process,target);
	});

	function listActions(action,id,process,target)
	{
		
		switch(action){
			case "view": 	window.location.href = target + "?id="+id; break;
			case "edit": 	window.location.href = target + "?id="+id; break;
			case "delete": 	
				alertify.confirm(utf8_decode("¿Desea eliminar este registro?"), function(e){
					if(e){
						var string		= 'id='+ id + '&action=delete';
						$.ajax({
							type: "POST",
							url: process,
							data: string,
							cache: false,
							success: function(data){
								if(data){
									$("#Row"+id).slideUp();
									msg.success("Registro eliminado correctamente",5000);
								}
								
							}
						});
					}else{
						//alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
					}
				}); 
				return false;
				/*showPopUpConfirm('<div style="padding:10px;">¿Desea eliminar este registro?</div>');
				$("#PopUpConfirm").click(function(){
					var string		= 'id='+ id + '&action=delete';
					
					$.ajax({
						type: "POST",
						url: process,
						data: string,
						cache: false,
						success: function(data){
							if(data){
								$("#Row"+id).slideUp();
							}
							
						}
					});
				});*/
			break;
		}
	}

	//////////////////////////////////////////////////// Pager /////////////////////////////////////////////////////////////////
	function fillPagerDestiny(parent,page)
	{
		var pagerid			= parent.attr("id");
		var string			= 'page='+ page +'&action=pager&pagerid='+pagerid;
		var	process			= parent.attr("process");
		var destiny			= parent.attr("destiny");
		var activeclass 	= parent.attr("activeclass");
		var inactiveclass 	= parent.attr("inactiveclass");
		var totalpages		= parent.attr("totalpages");

		$.ajax({
			type: "POST",
			url: process,
			data: string,
			cache: false,
			success: function(data){
				$("#"+destiny).html(data);
				$("#"+pagerid+" .ActivePage").each(function(){
					$(this).removeClass(activeclass);
					$(this).addClass(inactiveclass);
				});
				$("#"+pagerid+" #page"+page).removeClass(inactiveclass);
				$("#"+pagerid+" #page"+page).addClass(activeclass);
				$("#BtnFoward"+pagerid).attr("page",parseInt(page)+1);
				$("#BtnBack"+pagerid).attr("page",parseInt(page)-1);
				
				switch(page)
				{
					case "1":
						$("#BtnBack"+pagerid).removeClass($("#BtnBack"+pagerid).attr("classon"));
						$("#BtnBack"+pagerid).addClass($("#BtnBack"+pagerid).attr("classoff"));
						$("#BtnFoward"+pagerid).removeClass($("#BtnFoward"+pagerid).attr("classoff"));
						$("#BtnFoward"+pagerid).addClass($("#BtnFoward"+pagerid).attr("classon"));
					break;

					case totalpages:
						$("#BtnFoward"+pagerid).removeClass($("#BtnFoward"+pagerid).attr("classon"));
						$("#BtnFoward"+pagerid).addClass($("#BtnFoward"+pagerid).attr("classoff"));
						$("#BtnBack"+pagerid).addClass($("#BtnBack"+pagerid).attr("classon"));
						$("#BtnBack"+pagerid).removeClass($("#BtnBack"+pagerid).attr("classoff"));
					break;

					default:
						$("#BtnFoward"+pagerid).addClass($("#BtnFoward"+pagerid).attr("classon"));
						$("#BtnFoward"+pagerid).removeClass($("#BtnFoward"+pagerid).attr("classoff"));
						$("#BtnBack"+pagerid).addClass($("#BtnBack"+pagerid).attr("classon"));
						$("#BtnBack"+pagerid).removeClass($("#BtnBack"+pagerid).attr("classoff"));
					break;
				}
				///// LIST ACTIONS ////
				$("img").click(function(){
					var info	= $(this).attr("id").split('_');
					var action	= $(this).attr("action");
					var process	= $(this).attr("process");
					var target	= $(this).attr("target");
					var id		= info[1];
					listActions(action,id,process,target);
				});
			}
		});

	}

	$(".ActivePageLink").click(function(){
		fillPagerDestiny($(this).parent(),$(this).attr("page"));
	});

	$(".BtnFoward,.BtnBack").click(function(){
		var arrayid;
		var pagerid;
		var buttonclass;
		if($(this).hasClass("BtnFoward"))
			buttonclass = "Foward";
		else 
			buttonclass = "Back";
		arrayid			= $(this).attr("id").split(buttonclass);
		pagerid			= arrayid[1];
		$("#"+pagerid+" #page"+$(this).attr("page")).click();
	});


	function changePagerView(selectPager)
	{
		var pagerid			= selectPager.attr("parentid");
		var parent 			= $("#"+pagerid);
		var string			= 'regs='+ selectPager.val() +'&action=changepagerview&pagerid='+pagerid;
		var	process			= parent.attr("process");

		$.ajax({
			type: "POST",
			url: process,
			data: string,
			cache: false,
			success: function(data){
				//alert(data);
				fillPagerDestiny(parent,"1");
				if(data=="erase")
				{
					parent.hide();
					$("#BtnFoward"+pagerid).addClass("Hidden");
					$("#BtnBack"+pagerid).addClass("Hidden");

				}else{
					parent.addClass("MustBeRemoved");
					parent.after(data);
					$(".MustBeRemoved").remove();
					$("#BtnFoward"+pagerid).removeClass("Hidden");
					$("#BtnBack"+pagerid).removeClass("Hidden");
				}

				$(".ActivePageLink").click(function(){
					fillPagerDestiny($(this).parent(),$(this).attr("page"));
				});
			}
		});
	}

	$(".RegsPerPage").change(function(){
		changePagerView($(this));
	});


//////////////////////////////////////////////////// Searcher /////////////////////////////////////////////////////////////////

	
	function startSearch(field)
	{
		var parent  = field.parent().parent().parent();
		var value  	= field.val();
		var fieldid	= field.attr("id");
		var process = parent.attr("process");
		var pagerid	= parent.attr("pagerid");
		var string 	= "action=searcher&pagerid="+ pagerid + "&field=" + fieldid + "&value=" + value;

		$.ajax({
			type: "POST",
			url: process,
			data: string,
			cache: false,
			success: function(data){
				if(!data)
				{
					changePagerView($("#select"+pagerid+" #regsperpage"));
				}else{
					alert(data);
				}
			}
		});
	}

	$(".StartSearch").keyup(function(){
		startSearch($(this));
	});

	$(".StartSearch").change(function(){
		startSearch($(this));
	});



});

//////////////////////////////////////////////////// Validation ///////////////////////////////////////////////////////////////
var validate	= new ValidateFields();
	
$(function(){	
	validate.createErrorDivs();
	
	$(validateElements).change(function(){
		validate.validateOneField(this);
	});
});

//////////////////////////////////////////////////// Dropdown Menu ////////////////////////////////////////////////////////////
$(function(){

    $("ul.dropdown li").hover(function(){
    
        $(this).addClass("hover");
        $('ul:first',this).css('visibility', 'visible');
    
    }, function(){
    
        $(this).removeClass("hover");
        $('ul:first',this).css('visibility', 'hidden');
    
    });
    
    $("ul.dropdown li ul li:has(ul)").find("a:first").append(" &raquo; ");

});

//////////////////////////////////////////////////// Logout ////////////////////////////////////////////////////
$(function(){
	
		$("#Logout").click(function(){
			alertify.confirm(utf8_decode("¿Desea salir?"), function(e){
				if(e){
					var target		= '../login/login.php';
					var process		= '../login/process.logout.php';
					
					$.ajax({
						type: "POST",
						url: process,
						cache: false,
						success: function(){
							document.location = target;
						}
					});
				}else{
					//alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
				}
			}); 
		});
	
});


//////////////////////////////////////////////////// Message ////////////////////////////////////////////////////
var msg	= new Message();


//////////////////////////////////////////////////// Default Msg Value for Form Fields //////////////////////////
$(document).ready(function() {
    $("input,textarea,select").each(function() {
		$(this).defaultMsg();
	});
});
$(function(){
	$("input,textarea,select").focusout(function() {
		$(this).defaultMsg();
	});
});

jQuery.fn.defaultMsg	= function(){
	if($(this).attr("default")){
		if(!$(this).val())
		{
			if($(this).attr("type")=="password"){
				if (navigator.userAgent.toLowerCase().indexOf('msie ') < 0)
				{
					$(this).addClass("defaultpsd");
					$(this).val($(this).attr("default"));
					$(this).attr("type","text");
				}
			}else{
				$(this).addClass("default");
				$(this).val($(this).attr("default"));
			}
			
		}
	}
	if($(this).is("select"))
	{
		if($(this).val()=="" || $(this).val()==0)
		{
			$(this).addClass("default");
		}
	}
	
}

$(function(){
	$("input,textarea,select").focusin(function() {
		if($(this).is("select"))
		{
			if($(this).hasClass("default") && ($(this).val()=="" || $(this).val()==0))
			{
				$(this).removeClass("default");
			}
		}else{
			if($(this).hasClass("default") && $(this).val()==$(this).attr("default")){
					$(this).removeClass("default");
					$(this).val('');
			}
		}
		if($(this).hasClass("defaultpsd") && $(this).val()==$(this).attr("default") && navigator.userAgent.toLowerCase().indexOf('msie ') < 0){
				$(this).removeClass("defaultpsd");
				$(this).val('');
				$(this).attr("type","password");
		}
	});
	
	$("select").change(function() {
		if($(this).hasClass("default") && ($(this).val()!="" || $(this).val()!=0))
		{
			$(this).removeClass("default");
		}
	});

	$("input,textarea").change(function() {
		if($(this).hasClass("default") && $(this).val()!="")
		{
			$(this).removeClass("default");
		}
	});
});


//////////////////////////////////////////////////// Customized File Field ////////////////////////////////////////////////////
$(function(){
	$("input:file").change(function(){
		$("#File"+$(this).attr("id")).focus();
		$("#File"+$(this).attr("id")).val($(this).val());
		$("#File"+$(this).attr("id")).blur();
	});
	
	
	$("input").click(function(){
		
		if($(this).attr("id").substring(0,4)=="File"){
			$(this).blur();
			$("#"+$(this).attr("id").substring(4)).click();
		}
	});
});

//////////////////////////////////////////////////// DatePicker ////////////////////////////////////////////////////////
$(document).ready(function(){
	//$(".datepicker").datepicker();
	$(".datepciker").datepicker();
});
//$("#start_date").datepicker();
//$("#start_date").datepicker( "option", "showAnim", "slideDown" );

//////////////////////////////////////////////////// Tiny MCE //////////////////////////////////////////////////////////

tinymce.init({
	mode : "textareas",
	editor_selector : "tinymce",
	menubar:false,
	invalid_elements : "doctype,html,head,body,script",
    //selector: "textarea.tinymce",
    skin : "custom",
    elements : "description",
    width: '100%',
    plugins: [
            "advlist autolink autoresize autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality smileys template paste fullpage textcolor"
    ],

    toolbar1: "undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect",
    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | link unlink anchor image media code | inserttime preview | forecolor backcolor",
    toolbar3: "table | hr removeformat | subscript superscript | charmap smileys | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
    /*plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "table contextmenu directionality smileys template paste textcolor"
   			],
   	toolbar1: "insertfile undo redo | fontselect | fontsizeselect | bold italic forecolor backcolor smileys | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | template | link image | print preview media fullpage "
   	*/
 });


//////////////////////////////////////////////////// Resize ////////////////////////////////////////////////////

function resizeContent(){	
	var finalHeight		= 0;
	var windowHeight	= window.innerHeight;
	if(!windowHeight) windowHeight	= window.outerHeight;
	if(windowHeight) 
	{
		finalHeight		= parseInt(windowHeight) - (parseInt($("#Top").css("height")) +  parseInt($("#Content").css("padding-top"))+4);
		$("#Content").css("height",finalHeight+"px");
	}/*else{
		finalHeight	= parseInt(screen.availHeight) - (parseInt($("#Top").css("height"))+145);
	}
	//if(finalHeight>300)
	$("#Content").css("height",finalHeight+"px");*/
}

$(window).resize(function() {
	resizeContent();
});


//////////////////////////////////////////////////// Value In Array ////////////////////////////////////////////////////
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

//////////////////////////////////////////////////// Element Visible ////////////////////////////////////////////////////////

function isVisible(object)
{
	return $(object).is (':visible') && $(object).parents (':hidden').length == 0;
}

//////////////////////////////////////////////////// Get Vars From URL ////////////////////////////////////////////////////
function getVars(){
	var loc = document.location.href;
	var getString = loc.split('?');
	if(getString[1]){
		var GET = getString[1].split('&');
		var get = {};//This object will be filled with the key-value pairs and returned.
		
		for(var i = 0, l = GET.length; i < l; i++){
			var tmp = GET[i].split('=');
			get[tmp[0]] = unescape(decodeURI(tmp[1]));
		}
		return get;
	}else{
		return "";
	}
}
get	= getVars();

//////////////////////////////////////////////////// IE CSS Exceptions ////////////////////////////////////////////////////
$(document).ready(function(){
	if (navigator.userAgent.toLowerCase().indexOf('msie ') > -1)
	{
		$(".dropdown ul li").css("border-bottom","2px solid #484848");
	}
	
	resizeContent();
	
});

//////////////////////////////////////////////////// UTF8_ENCODE ////////////////////////////////////////////////////
function utf8_encode (argString) {

  if (argString === null || typeof argString === "undefined") {
    return "";
  }

  var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
  var utftext = '',
    start, end, stringl = 0;

  start = end = 0;
  stringl = string.length;
  for (var n = 0; n < stringl; n++) {
    var c1 = string.charCodeAt(n);
    var enc = null;

    if (c1 < 128) {
      end++;
    } else if (c1 > 127 && c1 < 2048) {
      enc = String.fromCharCode(
         (c1 >> 6)        | 192,
        ( c1        & 63) | 128
      );
    } else if (c1 & 0xF800 != 0xD800) {
      enc = String.fromCharCode(
         (c1 >> 12)       | 224,
        ((c1 >> 6)  & 63) | 128,
        ( c1        & 63) | 128
      );
    } else { // surrogate pairs
      if (c1 & 0xFC00 != 0xD800) { throw new RangeError("Unmatched trail surrogate at " + n); }
      var c2 = string.charCodeAt(++n);
      if (c2 & 0xFC00 != 0xDC00) { throw new RangeError("Unmatched lead surrogate at " + (n-1)); }
      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
      enc = String.fromCharCode(
         (c1 >> 18)       | 240,
        ((c1 >> 12) & 63) | 128,
        ((c1 >> 6)  & 63) | 128,
        ( c1        & 63) | 128
      );
    }
    if (enc !== null) {
      if (end > start) {
        utftext += string.slice(start, end);
      }
      utftext += enc;
      start = end = n + 1;
    }
  }

  if (end > start) {
    utftext += string.slice(start, stringl);
  }

  return utftext;
}


//////////////////////////////////////////////////// UTF8_DECODE ////////////////////////////////////////////////////
function utf8_decode (str_data) {

  var tmp_arr = [],
    i = 0,
    ac = 0,
    c1 = 0,
    c2 = 0,
    c3 = 0,
    c4 = 0;

  str_data += '';

  while (i < str_data.length) {
    c1 = str_data.charCodeAt(i);
    if (c1 <= 191) {
      tmp_arr[ac++] = String.fromCharCode(c1);
      i++;
    } else if (c1 <= 223) {
      c2 = str_data.charCodeAt(i + 1);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
      i += 2;
    } else if (c1 <= 239) {
      // http://en.wikipedia.org/wiki/UTF-8#Codepage_layout
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
      i += 3;
    } else {
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      c4 = str_data.charCodeAt(i + 3);
      c1 = ((c1 & 7) << 18) | ((c2 & 63) << 12) | ((c3 & 63) << 6) | (c4 & 63);
      c1 -= 0x10000;
      tmp_arr[ac++] = String.fromCharCode(0xD800 | ((c1>>10) & 0x3FF));
      tmp_arr[ac++] = String.fromCharCode(0xDC00 | (c1 & 0x3FF));
      i += 4;
    }
  }

  return tmp_arr.join('');
}

////////////////////////////////////////// ESCAPE //////////////////////
/*function htmlEscape(str) {
    return String(str)
            .replace("\xC1", '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
}*/