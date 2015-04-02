<!-- The Scripts -->
<script src="/js/jquery.min.js"></script>
<script src="/css/bs/bootstrap.min.js"></script>
<!-- <script src="/js/bootstrap.js"></script> -->
<script src="/js/jquery.parallax.js"></script> 
<script src="/js/modernizr-2.6.2.min.js"></script> 
<script src="/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
<script src="js/jquery.nivo.slider.pack.js"></script>
<script src="/js/jquery.prettyPhoto.js"></script>
<script src="/js/superfish.js"></script>
<script src="/js/tytabs.js"></script>
<script src="/js/jquery.sticky.js"></script>
<script src="/js/jflickrfeed.js"></script>
<script src="/js/imagesloaded.pkgd.min.js"></script>
<script src="/js/waypoints.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.1.0/bootbox.min.js"></script>
<script src="/js/custom.js"></script>
@if(Auth::check())
@if((Auth::check()) 
	&& (Auth::user()->access_level == 3))
<script type="text/javascript" src="/ck/ckeditor.js"></script>
<script type="text/javascript" src="/ck/adapters/jquery.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.49/jquery.form.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/1.6.5/jquery.contextMenu.min.js"></script>
<script type="text/javascript" src="/js/contextmenu/jquery.ui.position.js"></script>
<script type="text/javascript" src="/js/jquery.sortable.min.js"></script>
<script>
CKEDITOR.disableAutoInline = true;

function showResponse(responseText, statusText, xhr, $form)  {
	x = $("#theeditmsg").html();
	$.pnotify({
        icon: false,
        type: 'success',
        text: x,
        nonblock: true,
		nonblock_opacity: .2
    });
}

var editor;

function makePageEditable(item){
	
	if (($(".editablecontent").length != 0) || ($('.editable').length != 0)){
		$("#postdate").addClass("hidden");
		$(".admin-hidden").addClass('admin-display').removeClass('admin-hidden');
		$(item).attr("onclick","turnOffEditing(this)");
		$(item).html("Turn off editing");
    	$(".editablecontent").attr("contenteditable","true");
    	$(".editablecontenttitle").attr("contenteditable","true");
    	$(".editablecontent").addClass("outlined");
    	$(".editablecontenttitle").addClass("outlined");
    	$("#old").val($("#editablecontent").html());
    	$("#oldtitle").val($("#editablecontenttitle").html());
    	
    	$('.editable').attr('contenteditable','true');
    	$('.editable').addClass('outlined');
    	
    	$(".editablefragment").addClass("outlined");
		$(".editablefragment").attr("contenteditable","true");
    	
    	var editoroptions = { 
    		toolbar: 'MiniToolbar', 
    		filebrowserImageBrowseUrl: "/filemgmt/browse.php?type=images",
    		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
    		allowedContent: true,
    		floatSpaceDockedOffsetX: 150
    	}
    	
    	var elements = document.getElementsByClassName( 'editablecontent' );
		for ( var i = 0; i < elements.length; ++i ) {
		    CKEDITOR.inline( elements[ i ], editoroptions );
		}
		
		var elements = document.getElementsByClassName( 'editablefragment' );
		for ( var i = 0; i < elements.length; ++i ) {
		    CKEDITOR.inline( elements[ i ], editoroptions );
		}
		
		CKEDITOR.on( 'instanceLoaded', function(event) {
				editor = event.editor;
		});
    	
    	
	} else if ($(".editablefragment").length != 0 ) {
		$(item).attr("onclick","turnOffEditing(this)");
		$(item).html("Turn off editing");
		
		$("#oldcontent1").val($("#f1").html());
		$("#oldcontent2").val($("#f2").html());
		$("#oldcontent3").val($("#f3").html());
		$("#oldcontent4").val($("#f4").html());
		
		$(".admin-hidden").addClass('admin-display').removeClass('admin-hidden');
		
		$(".editablefragment").addClass("outlined");
		$(".editablefragment").attr("contenteditable","true");
		var editoroptions = { 
    		toolbar: 'MiniToolbar', 
    		filebrowserImageBrowseUrl: "/filemgmt/browse.php?type=images",
    		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
    		allowedContent: true,
    		floatSpaceDockedOffsetX: 150
    	}
    	var elements = document.getElementsByClassName( 'editablefragment' );
		for ( var i = 0; i < elements.length; ++i ) {
		    CKEDITOR.inline( elements[ i ], editoroptions );
		}
    	
    	CKEDITOR.on( 'instanceLoaded', function(event) {
				editor = event.editor;
		});
	} else {
		bootbox.alert("No editable content on this page!");
	}
}

function saveChanges(){
        var data = CKEDITOR.instances['editablecontent'].getData();
        // save the changed data
        $("#thedata").val(data);
        var options = { target: '#theeditmsg', success: showResponse };
        $("#savedata").unbind('submit').ajaxSubmit(options);
        $("#old").val('');
        turnOffEditing();
        return false;
}

function saveEditedFaq(x){
	// get the changed data;
    var data = $('#labeldata_'+x).html();
    $("#thelabeldata_"+x).val(data);
    data = $('#questiondata_'+x).html();
    $("#thequestiondata_"+x).val(data);
    data = $("#answerdata_"+x).html();
    $("#theanswerdata_"+x).val(data);
    
    var options = { target: '#theeditmsg', success: showResponse };
    $("#faqform_"+x).ajaxSubmit(options);
    $("#oldtitle").val('');
    $("#old").val('');
    turnOffEditing();
    return false;
}

function saveEditedCI(x){
	// get the changed data;
    var data = $('#labeldata_'+x).html();
    $("#thelabeldata_"+x).val(data);
    data = $("#contentdata_"+x).html();
    $("#thecontentdata_"+x).val(data);
    
    var options = { target: '#theeditmsg', success: showResponse };
    $("#ciform_"+x).ajaxSubmit(options);
    $("#oldtitle").val('');
    $("#old").val('');
    turnOffEditing();
    return false;
}

function saveEditedPage(){
	// get the changed data;
    var data = $('#editablecontenttitle').html();
    $("#thetitledata").val(data);
    
    // get the changed data;
    var pagedata = editor.getData();
    // save the changed data
    $("#thedata").val(pagedata);
    
    var options = { target: '#theeditmsg', success: showResponse };
    $("#savetitledata").unbind('submit').ajaxSubmit(options);
    $("#oldtitle").val('');
    $("#old").val('');
    turnOffEditing();
    return false;
}

function turnOffEditing(item) {
	var maxfrags = 5;
	for (name in CKEDITOR.instances) {
    	CKEDITOR.instances[name].destroy()
	}
	$(".admin-display").addClass('admin-hidden').removeClass('admin-display');
	$("#postdate").removeClass("hidden");
	$(".menu-item").attr("onclick","makePageEditable(this)");
	$(".menu-item").html("Edit content");
	$(".editablecontent").attr("contenteditable","false");
	$(".editablecontenttitle").attr("contenteditable","false");
	$(".editablecontenttitle").removeClass("outlined");
	$(".editablecontent").removeClass("outlined");
	$('.editable').attr('contenteditable','false');
    $('.editable').removeClass('outlined');
	if ($('#oldtitle').val() != ''){
		$("#editablecontenttitle").html($("#oldtitle").val());
	}
	if ($('#old').val() != ''){
		$(".editablecontent").html($("#old").val());
	}
	for (i=1;i<=maxfrags;i++){
		if ($("#oldcontent"+i).val() != 0) {
			$("#f"+i).html($("#oldcontent"+i).val());
		}
	}
	
	$(".editablefragment").removeClass("outlined");
	$(".editablefragment").attr("contenteditable","false");
}

function stub() {
	bootbox.alert("This functionality is not yet implemented!");
}

function saveEditedFragment(x){
	var value = CKEDITOR.instances['f'+x].getData();
	$("#thedata"+x).val(value);
	if ($("#thetitledata"+x).length != 0){
		$("#thetitledata"+x).val($("#thetitle"+x).html());
	}
    var options = { target: '#theeditmsg', success: showResponse };
    $("#savefrag"+x).unbind('submit').ajaxSubmit(options);
    $("#oldcontent"+x).val('');
    turnOffEditing();
    return false;
}

// start of ddmenu

$(function(){
    $.contextMenu({
        selector: '.ddmitem', 
        callback: function(key, options) {
           // get the id of the menu item
           var id = $(this).data('ddmitem-id');
           var mid = $(this).data('mitem-id')
           // call ajax to get menu item details;
           getDataForDDMenuItem(id, mid);
           $("#ddplacement").removeClass("hidden");
           $("#ddsortmenuitems").removeClass("hidden");
           $("#dddeletebutton").removeClass("hidden");
           $('#ddmenuItemModal').modal();
        },
        items: {
            "edit": {name: " Edit", icon: "edit"}
        }
    });
});

function getDataForDDMenuItem(menu_item_id, parent_item_id) {
	var theHtml = "";
	$("#ddmenu_item_id").val(menu_item_id);
	$("#dd_parent_menu_item_id").val(parent_item_id);
	getDDSortableList(parent_item_id);
    $.ajax({
		type: 'GET',
		url: '/menu/ddmenujson',
		data: {id: menu_item_id},
		dataType: 'json',
		success: function(_data) {
			var json = $.parseJSON(JSON.stringify(_data));
			$("#ddmenu_text").val(json.menu_text);
			$("#ddmenu_active").val(json.active);
			$("#ddmenu_page_id").val(json.page_id);
			$("#ddmenu_url").val(json.url);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}

function getDDSortableList(x){

    $.ajax({
		type: 'GET',
		url: '/menu/ddsortitems',
		data: {id: x},
		dataType: 'html',
		success: function(_data) {
			var theHtml = _data;
			$("#ddplacement").html(theHtml);
			var a = {};
			$("#ddsortable li").each(function(i, el){
	            a[$(el).data('id')] = $(el).index() + 1;
	        });
	        sorteda = JSON.stringify(a);
	        $("#ddoutput").val(sorteda);
	        
			$('#ddsortable').sortable().bind('sortupdate', function() {
				var a = {};
				$("#ddsortable li").each(function(i, el){
		            a[$(el).data('id')] = $(el).index() + 1;
		        });
		        sorteda = JSON.stringify(a);
		        $("#ddoutput").val(sorteda);
			});
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}

// end of ddmenu

// start of menu

$(function(){
    $.contextMenu({
        selector: '.mitem', 
        callback: function(key, options) {
           // get the id of the menu item
           var id = $(this).data('mitem-id');
           // call ajax to get menu item details;
           getDataForMenuItem(id);
        },
        items: {
            "edit": {name: " Edit", icon: "edit"}
        }
    });
});

function getDataForMenuItem(menu_item_id) {
	var theHtml = "";
	$("#menu_item_id").val(menu_item_id);
	getSortableList();
    $.ajax({
		type: 'GET',
		url: '/menu/menujson',
		data: {id: menu_item_id},
		dataType: 'json',
		success: function(_data) {
			var json = $.parseJSON(JSON.stringify(_data));
			$("#menu_text").val(json.menu_text);
			$("#menu_active").val(json.active);
			$("#menu_page_id").val(json.page_id);
			$("#menu_url").val(json.url);
			$("#has_children").val(json.has_children);
			$("#placement").removeClass("hidden");
			$("#sortmenuitems").removeClass("hidden");
			$("#deletebutton").removeClass("hidden");
			$('#menuItemModal').modal();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}

function getSortableList(){

    $.ajax({
		type: 'GET',
		url: '/menu/sortitems',
		dataType: 'html',
		success: function(_data) {
			var theHtml = _data;
			$("#placement").html(theHtml);
			var a = {};
			$("#sortable li").each(function(i, el){
	            a[$(el).data('id')] = $(el).index() + 1;
	        });
	        sorteda = JSON.stringify(a);
	        $("#output").val(sorteda);
	        
			$('#sortable').sortable().bind('sortupdate', function() {
				var a = {};
				$("#sortable li").each(function(i, el){
		            a[$(el).data('id')] = $(el).index() + 1;
		        });
		        sorteda = JSON.stringify(a);
		        $("#output").val(sorteda);
			});
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}

// end of menu

function addMenuItem(){
	$("#menu_text").val('');
	$("#menu_active").val(0);
	$("#menu_page_id").val(0);
	$("#menu_url").val('');
	$("#menu_item_id").val(0);
	$('#menuItemModal').modal();
	$('#deletebutton').addClass("hidden");
	$("#sortmenuitems").addClass("hidden");
	$("#placement").addClass("hidden");
}

function addDDMenuItem(x){
	$("#ddmenu_text").val('');
	$("#ddmenu_active").val(0);
	$("#ddmenu_page_id").val(0);
	$("#ddmenu_url").val('');
	$("#ddmenu_item_id").val(0);
	$("#ddsortmenuitems").addClass("hidden");
	$("#ddplacement").addClass("hidden");
	$('#ddmenuItemModal').modal();
	$("#dddeletebutton").addClass("hidden");
	$("#dd_parent_menu_item_id").val(x);
}

function deleteMenuItem(){
	bootbox.confirm("Are you sure?", function(result) {
		if (result==true)
		{
			$("#deleteid").val($("#menu_item_id").val())
			$("#deletemenuitemform").submit();
		}
	}); 
}

function deleteDDMenuItem(){
	bootbox.confirm("Are you sure?", function(result) {
		if (result==true)
		{
			$("#dddeleteid").val($("#ddmenu_item_id").val())
			$("#deleteddmenuitemform").submit();
		}
	}); 
}

$(document).ready(function () {

	$('#ddmenuItemModal').on('hidden', function () {
		$("#ddplacement").html('');
  	});
  	
  	$('#menuItemModal').on('hidden', function () {
		$("#placement").html('');
  	});
	
	$("#menuItemForm").validate({
		rules: {
			verify_email: {
				required: true,
				equalTo: "#email",
				email: true
			}
		},
		highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-inline',
	    errorPlacement: function(error, element) {
	        error.insertAfter(element.parent());
	    }
	});
	$("#ddmenuItemForm").validate({
		rules: {
			verify_email: {
				required: true,
				equalTo: "#email",
				email: true
			}
		},
		highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-inline',
	    errorPlacement: function(error, element) {
	        error.insertAfter(element.parent());
	    }
	});
});
</script>
@endif
@endif