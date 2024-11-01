/* Custom Share Buttons With Floting Sidebar admin js*/
jQuery(document).ready(function(){
	jQuery(".wssbs-tab").hide();
		jQuery("#div-wssbs-general").show();
	    jQuery(".wssbs-tab-links").click(function(){
		var divid=jQuery(this).attr("id");
		jQuery(".wssbs-tab-links").removeClass("active");
		jQuery(".wssbs-tab").hide();
		jQuery("#"+divid).addClass("active");
		jQuery("#div-"+divid).fadeIn();
		});
		jQuery("#publish5").click(function(){
		if(jQuery("#publish5").prop("checked"))
		{jQuery("#mailmsg").show();}else{jQuery("#mailmsg").hide();} 
	    });
	    
	    jQuery("#ytBtns").click(function(){
		if(jQuery("#ytBtns").prop("checked"))
		{jQuery("#ytpath").show();}else{jQuery("#ytpath").hide();} 
	    });
	/* add image upload image button */
	jQuery(".cswbfsUploadBtn").click(function() {
	var tdbuttonid = jQuery(this).parent("td").attr("id");
	//alert(tdbuttonid);
	inputfieldId = jQuery("#"+tdbuttonid+" .inputButtonid").attr("id");
	//alert(inputfieldId);
	formfield = jQuery("#"+inputfieldId).attr("name");
	tb_show( "", "media-upload.php?type=image&amp;TB_iframe=true" );
	return false;
	});
	window.send_to_editor = function(html) {
	imgurl = jQuery(html).attr("src");
	jQuery("#"+inputfieldId).val(imgurl);
	tb_remove();
   }
   
    /** reset share buttons settings */
   jQuery('#div-wssbs-share-buttons #wssbsresetpage').click(function(){
	   jQuery('#div-wssbs-share-buttons .inputButtonid').val('');
	   jQuery('#div-wssbs-share-buttons .wssbs_title').val('');
	   })
/** reset floating sidebar settings  */	   
   jQuery('#div-wssbs-sidebar #wssbs_resetpage').click(function(){
	   jQuery('#div-wssbs-sidebar .inputButtonid').val('');
	   jQuery('#div-wssbs-sidebar .wssbs_title').val('');
	   })
	   
   });
(function( ) {
 
    // Add Color Picker to all inputs that have 'color-field' class
    jQuery(function() {
        jQuery('.color-field').wpColorPicker();
    });
     
})( jQuery );
