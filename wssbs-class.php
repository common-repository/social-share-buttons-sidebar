<?php
/*
 * 
 * @get_wssbs_sidebar_options()
 * @get_wssbs_sidebar_content()
 * */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
// get all options value for "Share Buttons"
	function get_wssbs_sidebar_options() {
		global $wpdb;
		$ctOptions = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE 'wssbs_%'");
								
		foreach ($ctOptions as $option) {
			$ctOptions[$option->option_name] =  $option->option_value;
		}
	
		return $ctOptions;	
	}
/** Get the current url*/
if(!function_exists('wssbs_current_path_protocol')):
function wssbs_current_path_protocol($s, $use_forwarded_host=false)
{
    $pwahttp = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $pwasprotocal = strtolower($s['SERVER_PROTOCOL']);
    $pwa_protocol = substr($pwasprotocal, 0, strpos($pwasprotocal, '/')) . (($pwahttp) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$pwahttp && $port=='80') || ($pwahttp && $port=='443')) ? '' : ':'.$port;
    $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $pwa_protocol . '://' . $host;
}
endif;
if(!function_exists('wssbs_get_current_page_url')):
function wssbs_get_current_page_url($s, $use_forwarded_host=false)
{
    return wssbs_current_path_protocol($s, $use_forwarded_host) . $s['REQUEST_URI'];
}
endif;
/* 
 * Site is browsing in mobile or not
 * @wssbsIsMobile()
 * */
 if(!function_exists('wssbsIsMobile')):
function wssbsIsMobile() {
// Check the server headers to see if they're mobile friendly
if(isset($_SERVER["HTTP_X_WAP_PROFILE"])) {
    return true;
}
// Let's NOT return "mobile" if it's an iPhone, because the iPhone can render normal pages quite well.
if(isset($_SERVER["HTTP_USER_AGENT"])):
if(strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
    return false;
}
endif;

// If the http_accept header supports wap then it's a mobile too
if(isset($_SERVER["HTTP_ACCEPT"])):
if(preg_match("/wap\.|\.wap/i",$_SERVER["HTTP_ACCEPT"])) {
    return true;
}
endif;
// Still no luck? Let's have a look at the user agent on the browser. If it contains
// any of the following, it's probably a mobile device. Kappow!
if(isset($_SERVER["HTTP_USER_AGENT"])){
    $user_agents = array("midp", "j2me", "avantg", "docomo", "novarra", "palmos", "palmsource", "240x320", "opwv", "chtml", "pda", "windows\ ce", "mmp\/", "blackberry", "mib\/", "symbian", "wireless", "nokia", "hand", "mobi", "phone", "cdm", "up\.b", "audio", "SIE\-", "SEC\-", "samsung", "HTC", "mot\-", "mitsu", "sagem", "sony", "alcatel", "lg", "erics", "vx", "NEC", "philips", "mmm", "xx", "panasonic", "sharp", "wap", "sch", "rover", "pocket", "benq", "java", "pt", "pg", "vox", "amoi", "bird", "compal", "kg", "voda", "sany", "kdd", "dbt", "sendo", "sgh", "gradi", "jb", "\d\d\di", "moto");
    foreach($user_agents as $user_string){
        if(preg_match("/".$user_string."/i",$_SERVER["HTTP_USER_AGENT"])) {
            return true;
        }
    }
}
// None of the above? Then it's probably not a mobile device.
return false;
}	
endif;
// Get plugin options
$pluginOptionsVal=get_wssbs_sidebar_options();
//check plugin in enable or not
if(isset($pluginOptionsVal['wssbs_active']) && $pluginOptionsVal['wssbs_active']==1){
	
if((wssbsIsMobile()) && 
isset($pluginOptionsVal['wssbs_deactive_for_mob']) && $pluginOptionsVal['wssbs_deactive_for_mob']!='')
{
// silent is Gold;
}else
{
add_action('wp_footer','get_wssbs_sidebar_content');
add_action( 'wp_enqueue_scripts', 'wssbs_sidebar_scripts' );
add_action('wp_footer','wssbs_sidebar_load_inline_js');
add_action('wp_footer','wssbs_cookie');
}

}

function wssbs_cookie()
{
echo $cookieVal='<script>wssbsCheckCookie();function wssbsSetCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function wssbsGetCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(\';\');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==\' \') c = c.substring(1);
        if (c.indexOf(name) != -1) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function wssbsCheckCookie() {
    var button_status=wssbsGetCookie("wssbs_show_hide_status");
    if (button_status != "") {
        
    } else {
        wssbsSetCookie("wssbs_show_hide_status", "active",1);
    }
}

</script>';


}

if(isset($pluginOptionsVal['wssbs_buttons_active']) && $pluginOptionsVal['wssbs_buttons_active']==1){
add_filter( 'the_content', 'csbfs_the_content_filter', 20);
add_action( 'wp_enqueue_scripts', 'wssbs_sidebar_scripts' );
}

//register style and scrip files
function wssbs_sidebar_scripts() {
wp_enqueue_script( 'jquery' ); // wordpress jQuery
wp_register_style( 'wssbs_sidebar_style', plugins_url( 'css/wssbs.css',__FILE__ ) );
wp_enqueue_style( 'wssbs_sidebar_style' );
}

/*
-----------------------------------------------------------------------------------------------
                              "Add the jQuery code in head section using hooks"
-----------------------------------------------------------------------------------------------
*/


function wssbs_sidebar_load_inline_js()
{
   $pluginOptionsVal=get_wssbs_sidebar_options();
	$jscnt='<script>
	  var windWidth=jQuery( window ).width();
	  //alert(windWidth);
	  var animateWidth;
	  var defaultAnimateWidth;';
  $jscnt.='
	jQuery(document).ready(function()
  { 
	animateWidth="55";
    defaultAnimateWidth= animateWidth-10;
	animateHeight="49";
	defaultAnimateHeight= animateHeight-2;';
  if($pluginOptionsVal['wssbs_delayTimeBtn']!='0'):
     $jscnt.='jQuery("#wssbs-delaydiv").hide();
	  setTimeout(function(){
	  jQuery("#wssbs-delaydiv").fadeIn();}, '.$pluginOptionsVal['wssbs_delayTimeBtn'].');';
  endif;  
  
if($pluginOptionsVal['wssbs_position']=='right' || $pluginOptionsVal['wssbs_position']=='left'){
 
  $jscnt.='jQuery("div.wssbsbtns a").hover(function(){
  jQuery(this).animate({width:animateWidth});
  },function(){
    jQuery(this).stop( true, true ).animate({width:defaultAnimateWidth});
  });';
}else
{  
 //silent
  
}

if(isset($pluginOptionsVal['wssbs_auto_hide']) && $pluginOptionsVal['wssbs_auto_hide']!=''):
$jscnt.='wssbsSetCookie("wssbs_show_hide_status","in_active","1");';
endif;

  $jscnt.='jQuery("div.wssbs-show").hide();
  jQuery("div.wssbs-show a").click(function(){
    jQuery("div#wssbs-social-inner").show(500);
     jQuery("div.wssbs-show").hide(500);
    jQuery("div.wssbs-hide").show(500);
    wssbsSetCookie("wssbs_show_hide_status","active","1");
  });
  
  jQuery("div.wssbs-hide a").click(function(){
     jQuery("div.wssbs-show").show(500);
      jQuery("div.wssbs-hide").hide(500);
     jQuery("div#wssbs-social-inner").hide(500);
     wssbsSetCookie("wssbs_show_hide_status","in_active","1");
  });';
  
   $jscnt.='var button_status=wssbsGetCookie("wssbs_show_hide_status");
    if (button_status =="in_active") {
      jQuery("div.wssbs-show").show();
      jQuery("div.wssbs-hide").hide();
     jQuery("div#wssbs-social-inner").hide();
    } else {
      jQuery("div#wssbs-social-inner").show();
     jQuery("div.wssbs-show").hide();
    jQuery("div.wssbs-hide").show();
    }';

  
$jscnt.='});

</script>';
	
	echo $jscnt;
}	
 
/*
-----------------------------------------------------------------------------------------------
                              "Share Buttons" HTML
-----------------------------------------------------------------------------------------------
*/


function get_wssbs_sidebar_content() {
global $post;
$pluginOptionsVal=get_wssbs_sidebar_options();

/*Default Pinit Share image */
if(isset($pluginOptionsVal['wssbs_defaultfeaturedshrimg']) && $pluginOptionsVal['wssbs_defaultfeaturedshrimg']!=''){
	$pinShareImg=$pluginOptionsVal['wssbs_defaultfeaturedshrimg'];
}else{
	$pinShareImg=plugins_url('images/mrweb-logo.jpg',__FILE__);
	}

if(is_category())
	{
	   $category_id = get_query_var('cat');
	   //$shareurl =get_category_link( $category_id );   
	   $cats = get_the_category();
	   $ShareTitle=$cats[0]->name;
	}elseif(is_page() || is_single())
	{
		if ( has_post_thumbnail() ) 
		{
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

			$pinShareImg= $large_image_url[0] ;
		}
			
	  // $shareurl=get_permalink($post->ID);
	   $ShareTitle=$post->post_title;
	}
	elseif(is_archive())
	{
	   global $wp;
       $current_url = get_home_url(null, $wp->request, null);
       
       if ( is_day() ) :
		 $ShareTitle='Daily Archives: '. get_the_date(); 
		elseif ( is_month() ) : 
		 $ShareTitle='Monthly Archives: '. get_the_date('F Y'); 
		elseif ( is_year() ) : 
		 $ShareTitle='Yearly Archives: '. get_the_date('Y'); 
		elseif ( is_author() ) : 
		 $ShareTitle='Author Archives: '. get_the_author(); 
		else :
		 $ShareTitle ='Blog Archives';
		endif;			
	   //$shareurl=$current_url;
	   
	   //$ShareTitle=$post->post_title;
	}
	else
	{
       // $shareurl =home_url('/');
        $ShareTitle=get_bloginfo('name');
		}
$shareurl = htmlspecialchars(wssbs_get_current_page_url($_SERVER), ENT_QUOTES, 'UTF-8');
/* Set title and url for home page */  
if(is_home() || is_front_page()) 
    {
	   $shareurl =home_url('/');
        $ShareTitle=get_bloginfo('name');	
		}	
			
$ShareTitle= htmlspecialchars(rawurlencode($ShareTitle));



/* Get All buttons Image */

//get facebook button image
if($pluginOptionsVal['wssbs_fb_image']!=''){ $fImg=$pluginOptionsVal['wssbs_fb_image'];} 
   else{$fImg='';}   
//get twitter button image  
if($pluginOptionsVal['wssbs_tw_image']!=''){ $tImg=$pluginOptionsVal['wssbs_tw_image'];} 
   else{$tImg='';}   
//get Linkedin button image
if($pluginOptionsVal['wssbs_li_image']!=''){ $lImg=$pluginOptionsVal['wssbs_li_image'];} 
   else{$lImg='';}   
//get mail button image  
if($pluginOptionsVal['wssbs_mail_image']!=''){ $mImg=$pluginOptionsVal['wssbs_mail_image'];} 
   else{$mImg='';}   
//get google plus button image 
if($pluginOptionsVal['wssbs_gp_image']!=''){ $gImg=$pluginOptionsVal['wssbs_gp_image'];} 
   else{$gImg='';}  
//get pinterest button image   
 
if($pluginOptionsVal['wssbs_pin_image']!=''){ $pImg=$pluginOptionsVal['wssbs_pin_image'];} 
   else{$pImg='';}   
   
//get youtube button image
if(isset($pluginOptionsVal['wssbs_yt_image']) && $pluginOptionsVal['wssbs_yt_image']!=''){ $ytImg=$pluginOptionsVal['wssbs_yt_image'];} 
   else{$ytImg='';}   
    
//get reddit plus button image 
if(isset($pluginOptionsVal['wssbs_re_image']) && $pluginOptionsVal['wssbs_re_image']!=''){ $reImg=$pluginOptionsVal['wssbs_re_image'];} 
   else{$reImg='';}  
   
//get stumbleupon button image   
if(isset($pluginOptionsVal['wssbs_st_image']) && $pluginOptionsVal['wssbs_st_image']!=''){ $stImg=$pluginOptionsVal['wssbs_st_image'];} 
   else{$stImg='';}   


/* Get All buttons Image Alt/Title */
//get facebook button image alt/title
if($pluginOptionsVal['wssbs_fb_title']!=''){ $fImgAlt=$pluginOptionsVal['wssbs_fb_title'];} 
else{$fImgAlt='Share On Facebook';}   
//get twitter button image alt/title
if($pluginOptionsVal['wssbs_tw_title']!=''){ $tImgAlt=$pluginOptionsVal['wssbs_tw_title'];} 
else{$tImgAlt='Share On Twitter';}   
//get Linkedin button image alt/title
if($pluginOptionsVal['wssbs_li_title']!=''){ $lImgAlt=$pluginOptionsVal['wssbs_li_title'];} 
else{$lImgAlt='Share On Linkedin';}   
//get mail button image alt/title 
if($pluginOptionsVal['wssbs_mail_title']!=''){ $mImgAlt=$pluginOptionsVal['wssbs_mail_title'];} 
else{$mImgAlt='Contact us';}   
//get google plus button image alt/title
if($pluginOptionsVal['wssbs_gp_title']!=''){ $gImgAlt=$pluginOptionsVal['wssbs_gp_title'];} 
else{$gImgAlt='Share On Google Plus';}  
//get pinterest button image alt/title  
if($pluginOptionsVal['wssbs_pin_title']!=''){ $pImgAlt=$pluginOptionsVal['wssbs_pin_title'];} 
else{$pImgAlt='Share On Pinterest';}   
//get youtube button image alt/title
if(isset($pluginOptionsVal['wssbs_yt_title']) && $pluginOptionsVal['wssbs_yt_title']!=''){ $ytImgAlt=$pluginOptionsVal['wssbs_yt_title'];} 
else{$ytImgAlt='Share On Youtube';}
//get reddit plus button image alt/title
if(isset($pluginOptionsVal['wssbs_re_title']) && $pluginOptionsVal['wssbs_re_title']!=''){ $reImgAlt=$pluginOptionsVal['wssbs_re_title'];} 
else{$reImgAlt='Share On Reddit';}  
//get stumbleupon button image alt/title  
if(isset($pluginOptionsVal['wssbs_st_title']) && $pluginOptionsVal['wssbs_st_title']!=''){ $stImgAlt=$pluginOptionsVal['wssbs_st_title'];} 
else{$stImgAlt='Share On Stumbleupon';}   
     
//get email message
if(is_page() || is_single() || is_category() || is_archive()){
	
		if($pluginOptionsVal['wssbs_mailMessage']!=''){ $mailMsg=$pluginOptionsVal['wssbs_mailMessage'];} else{
		 $mailMsg='?subject='.$ShareTitle.'&body='.$shareurl;}
 }else
 {
	 $mailMsg='?subject='.get_bloginfo('name').'&body='.home_url('/');
	 }
 

// Top Margin
if($pluginOptionsVal['wssbs_top_margin']!=''){
	$margin=$pluginOptionsVal['wssbs_top_margin'];
}else
{
	$margin='25%';
	}

//Sidebar Position
if($pluginOptionsVal['wssbs_position']=='right'){
$style=' style="top:'.$margin.';right:-5px;"';	$idName=' id="wssbs-right"'; $showImg='hide-r.png'; $hideImg='show.png';	
}else if($pluginOptionsVal['wssbs_position']=='bottom'){
$style=' style="bottom:0;"'; $idName=' id="wssbs-bottom"'; $showImg='hide-b.png'; $hideImg='show.png';
}
else
{
$idName=' id="wssbs-left"'; $style=' style="top:'.$margin.';left:0;"'; $showImg='hide-l.png';$hideImg='hide.png';
}
/* Get All buttons background color */
//get facebook button image background color 
if($pluginOptionsVal['wssbs_fb_bg']!=''){ $fImgbg=' style="background:'.$pluginOptionsVal['wssbs_fb_bg'].';"';} 
else{$fImgbg='';}   
//get twitter button image  background color 
if($pluginOptionsVal['wssbs_tw_bg']!=''){ $tImgbg=' style="background:'.$pluginOptionsVal['wssbs_tw_bg'].';"';} 
else{$tImgbg='';}   
//get Linkedin button image background color 
if($pluginOptionsVal['wssbs_li_bg']!=''){ $lImgbg=' style="background:'.$pluginOptionsVal['wssbs_li_bg'].';"';} 
else{$lImgbg='';}   
//get mail button image  background color 
if($pluginOptionsVal['wssbs_mail_bg']!=''){ $mImgbg=' style="background:'.$pluginOptionsVal['wssbs_mail_bg'].';"';} 
else{$mImgbg='';}   
//get google plus button image  background color 
if($pluginOptionsVal['wssbs_gp_bg']!=''){ $gImgbg=' style="background:'.$pluginOptionsVal['wssbs_gp_bg'].';"';} 
else{$gImgbg='';}  
//get pinterest button image   background color 
if($pluginOptionsVal['wssbs_pin_bg']!=''){ $pImgbg=' style="background:'.$pluginOptionsVal['wssbs_pin_bg'].';"';}
else{$pImgbg='';}  

//get youtube button image   background color 
if(isset($pluginOptionsVal['wssbs_yt_bg']) && $pluginOptionsVal['wssbs_yt_bg']!=''){ $ytImgbg=' style="background:'.$pluginOptionsVal['wssbs_yt_bg'].';"';}else{$ytImgbg='';}   
//get reddit button image   background color 
if(isset($pluginOptionsVal['wssbs_re_bg']) && $pluginOptionsVal['wssbs_re_bg']!=''){ $reImgbg=' style="background:'.$pluginOptionsVal['wssbs_re_bg'].';"';}else{$reImgbg='';}  
//get stumbleupon button image   background color 
if(isset($pluginOptionsVal['wssbs_st_bg']) && $pluginOptionsVal['wssbs_st_bg']!=''){ $stImgbg=' style="background:'.$pluginOptionsVal['wssbs_st_bg'].';"';} else{$stImgbg='';}
     
/** Message */ 
if($pluginOptionsVal['wssbs_show_btn']!=''){ $showbtn=$pluginOptionsVal['wssbs_show_btn'];} 
   else{$showbtn='Show Buttons';}   
//get show/hide button message 
if($pluginOptionsVal['wssbs_hide_btn']!=''){ $hidebtn=$pluginOptionsVal['wssbs_hide_btn'];} 
   else{$hidebtn='Hide Buttons';}   
//get mail button message 
if($pluginOptionsVal['wssbs_share_msg']!=''){ $sharemsg=$pluginOptionsVal['wssbs_share_msg'];} 
   else{$sharemsg='Share This With Your Friends';}   

/** Check display Show/Hide button or not*/
if(isset($pluginOptionsVal['wssbs_rmSHBtn']) && $pluginOptionsVal['wssbs_rmSHBtn']!=''):
$isActiveHideShowBtn='yes';
else:
$isActiveHideShowBtn='no';
endif;
$floatingSidebarContent='<div id="wssbs-delaydiv"><div class="wssbs-social-widget" '.$idName.' title="'.$sharemsg.'" '.$style.'>';

if($isActiveHideShowBtn!='yes') :
$floatingSidebarContent .= '<div class="wssbs-show"><a href="javascript:" title="'.$showbtn.'" id="wssbs-show"><img src="'.plugins_url('social-share-buttons-sidebar/images/'.$showImg).'" alt="'.$showbtn.'"></a></div>';
endif;

$floatingSidebarContent .= '<div id="wssbs-social-inner">';

/** FB */
if($pluginOptionsVal['wssbs_fpublishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-fb" class="wssbs-fb"><a href="javascript:" onclick="javascript:window.open(\'//www.facebook.com/sharer/sharer.php?u='.$shareurl.'\', \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;" target="_blank" title="'.$fImgAlt.'" '.$fImgbg.'>';

if($fImg!=''){
$floatingSidebarContent .='<img src="'.$fImg.'" alt="'.$fImgAlt.'" width="35" height="35" >';
}else{
$floatingSidebarContent .='<i class="wssbs_facebook"></i>';
}
$floatingSidebarContent .='</a></div></div>';
endif;

/** TW */
if($pluginOptionsVal['wssbs_tpublishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-tw" class="wssbs-tw"><a href="javascript:" onclick="window.open(\'//twitter.com/share?url='.$shareurl.'&text='.$ShareTitle.'\',\'_blank\',\'width=800,height=300\')" title="'.$tImgAlt.'" '.$tImgbg.'>';
	if($tImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$tImg.'" alt="'.$tImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="wssbs_twitter"></i>';
	}
$floatingSidebarContent .='</a></div></div>';

endif;

/** GP */
if($pluginOptionsVal['wssbs_gpublishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-gp" class="wssbs-gp"><a href="javascript:"  onclick="javascript:window.open(\'//plus.google.com/share?url='.$shareurl.'\',\'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800\');return false;" title="'.$gImgAlt.'" '.$gImgbg.'>';
	if($gImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$gImg.'" alt="'.$gImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="wssbs_plus"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

/**  LI */
if($pluginOptionsVal['wssbs_lpublishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-li" class="wssbs-li"><a href="javascript:" onclick="javascript:window.open(\'//www.linkedin.com/cws/share?mini=true&url='. $shareurl.'\',\'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800\');return false;" title="'.$lImgAlt.'" '.$lImgbg.'>';
	if($lImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$lImg.'" alt="'.$lImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="wssbs_linkedin"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

/** PIN */
if($pluginOptionsVal['wssbs_ppublishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-pin" class="wssbs-pin"><a onclick="window.open(\'//pinterest.com/pin/create/button/?url='.$shareurl.'&amp;media='.$pinShareImg.'&amp;description='.$ShareTitle.' :'.$shareurl.'\',\'pinIt\',\'toolbar=0,status=0,width=800,height=500\');" href="javascript:void(0);" '.$pImgbg.' title="'.$pImgAlt.'">';
	if($pImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$pImg.'" alt="'.$pImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="wssbs_pinterest"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

/** Reddit */
if(isset($pluginOptionsVal['wssbs_republishBtn']) && $pluginOptionsVal['wssbs_republishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-re" class="wssbs-re"><a onclick="window.open(\'//reddit.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Reddit\',\'toolbar=0,status=0,width=1000,height=800\');" href="javascript:void(0);" '.$reImgbg.' title="'.$reImgAlt.'">';
	if($reImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$reImg.'" alt="'.$reImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="wssbs_reddit"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

/** Stumbleupon */
if(isset($pluginOptionsVal['wssbs_stpublishBtn']) && $pluginOptionsVal['wssbs_stpublishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-st" class="wssbs-st"><a onclick="window.open(\'//www.stumbleupon.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Stumbleupon\',\'toolbar=0,status=0,width=1000,height=800\');"  href="javascript:void(0);" '.$stImgbg.' title="'.$stImgAlt.'">';
	if($stImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$stImg.'" alt="'.$stImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="wssbs_stumbleupon"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif; 
/** YT */	 	 
if(isset($pluginOptionsVal['wssbs_ytpublishBtn']) && $pluginOptionsVal['wssbs_ytpublishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-yt" class="wssbs-yt"><a onclick="window.open(\''.$pluginOptionsVal['wssbs_ytPath'].'\');" href="javascript:void(0);" '.$ytImgbg.' title="'.$ytImgAlt.'">';
	if($ytImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$ytImg.'" alt="'.$ytImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="wssbs_youtube"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;
/** Mail*/
if($pluginOptionsVal['wssbs_mpublishBtn']!=''):
$floatingSidebarContent .='<div class="wssbs-sbutton wssbsbtns"><div id="wssbs-ml" class="wssbs-ml"><a href="mailto:'.$mailMsg.'" title="'.$mImgAlt.'" '.$mImgbg.' >';
	if($mImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$mImg.'" alt="'.$mImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="wssbs_mail"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

$floatingSidebarContent .='</div>'; //End social-inner

if($isActiveHideShowBtn!='yes') :
$floatingSidebarContent .='<div class="wssbs-hide"><a href="javascript:" title="'.$hidebtn.'" id="wssbs-hide"><img src="'.plugins_url('social-share-buttons-sidebar/images/'.$hideImg).'" alt="'.$hidebtn.'"></a></div>';
endif;

$floatingSidebarContent .='</div></div>'; //End social-inner


/** Check conditions */
    // Returns the content.
    
if(isset($pluginOptionsVal['wssbs_hide_home'])){$hideOnHome=$pluginOptionsVal['wssbs_hide_home'];	}else{			$hideOnHome='';}
  
if((is_home() && is_front_page()) && $hideOnHome=='yes'):
$floatingSidebarContent='';
endif;
if(is_front_page() && $hideOnHome=='yes' ):
$floatingSidebarContent='';
endif;
/** hide on 404 pages */
if(is_404()):$floatingSidebarContent='';endif;

    
print $floatingSidebarContent;
  
    
}

/**
 * Add social share bottons to the end of every post/page.
 *
 * @uses is_home()
 * @uses is_page()
 * @uses is_single()
 */
function csbfs_the_content_filter( $content ) {

global $post;
$pluginOptionsVal=get_wssbs_sidebar_options();

/*Default Pinit Share image */
if(isset($pluginOptionsVal['wssbs_defaultfeaturedshrimg']) && $pluginOptionsVal['wssbs_defaultfeaturedshrimg']!=''){
	$pinShareImg=$pluginOptionsVal['wssbs_defaultfeaturedshrimg'];
}else{
	$pinShareImg=plugins_url('images/mrweb-logo.jpg',__FILE__);
}

if(is_category())
	{
	   $category_id = get_query_var('cat');
	   $shareurl =get_category_link( $category_id );   
	   $cats = get_the_category();
	   $ShareTitle=$cats[0]->name;
	}elseif(is_page() || is_single())
	{
		if ( has_post_thumbnail() ) 
		{
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

			$pinShareImg= $large_image_url[0] ;
		}
	   $shareurl=get_permalink($post->ID);
	   $ShareTitle=$post->post_title;
	}
	else
	{
        $shareurl =home_url('/');
        $ShareTitle=get_bloginfo('name');
		}
		
/* Set title and url for home page */  
if(is_home() || is_front_page()) 
    {
	   $shareurl =home_url('/');
        $ShareTitle=get_bloginfo('name');	
		}	

$shareurl = htmlspecialchars($shareurl, ENT_QUOTES, 'UTF-8');

$ShareTitle= htmlspecialchars(rawurlencode($ShareTitle));

/* Get All buttons Image */

//get facebook button image
if($pluginOptionsVal['wssbs_page_fb_image']!=''){ $fImg=$pluginOptionsVal['wssbs_page_fb_image'];} 
   else{$fImg=plugins_url('images/fb.png',__FILE__);}   
//get twitter button image  
if($pluginOptionsVal['wssbs_page_tw_image']!=''){ $tImg=$pluginOptionsVal['wssbs_page_tw_image'];} 
   else{$tImg=plugins_url('images/tw.png',__FILE__);}   
//get Linkedin button image
if($pluginOptionsVal['wssbs_page_li_image']!=''){ $lImg=$pluginOptionsVal['wssbs_page_li_image'];} 
   else{$lImg=plugins_url('images/in.png',__FILE__);}   
//get mail button image  
if($pluginOptionsVal['wssbs_page_mail_image']!=''){ $mImg=$pluginOptionsVal['wssbs_page_mail_image'];} 
   else{$mImg=plugins_url('images/ml.png',__FILE__);}   
//get google plus button image 
if($pluginOptionsVal['wssbs_page_gp_image']!=''){ $gImg=$pluginOptionsVal['wssbs_page_gp_image'];} 
   else{$gImg=plugins_url('images/gp.png',__FILE__);}  
//get pinterest button image   
if($pluginOptionsVal['wssbs_page_pin_image']!=''){ $pImg=$pluginOptionsVal['wssbs_page_pin_image'];} 
   else{$pImg=plugins_url('images/pinit.png',__FILE__);}   
   
//get youtube button image   
if(isset($pluginOptionsVal['wssbs_page_yt_image']) && $pluginOptionsVal['wssbs_page_yt_image']!=''){ $ytImg=$pluginOptionsVal['wssbs_page_yt_image'];} 
   else{$ytImg=plugins_url('images/youtube.png',__FILE__);}   
//get reddit plus button image 
if(isset($pluginOptionsVal['wssbs_page_re_image']) && $pluginOptionsVal['wssbs_page_re_image']!=''){ $reImg=$pluginOptionsVal['wssbs_page_re_image'];} 
   else{$reImg=plugins_url('images/reddit.png',__FILE__);}  
//get stumbleupon button image   
if(isset($pluginOptionsVal['wssbs_page_st_image']) && $pluginOptionsVal['wssbs_page_st_image']!=''){ $stImg=$pluginOptionsVal['wssbs_page_st_image'];} 
   else{$stImg=plugins_url('images/stumbleupon.png',__FILE__);}  

/* Get All buttons Image Alt/Title */
//get facebook button image alt/title
if($pluginOptionsVal['wssbs_page_fb_title']!=''){ $fImgAlt=$pluginOptionsVal['wssbs_page_fb_title'];} 
else{$fImgAlt='Share On Facebook';}   
//get twitter button image alt/title
if($pluginOptionsVal['wssbs_page_tw_title']!=''){ $tImgAlt=$pluginOptionsVal['wssbs_page_tw_title'];} 
else{$tImgAlt='Share On Twitter';}   
//get Linkedin button image alt/title
if($pluginOptionsVal['wssbs_page_li_title']!=''){ $lImgAlt=$pluginOptionsVal['wssbs_page_li_title'];} 
else{$lImgAlt='Share On Linkedin';}   
//get mail button image alt/title 
if($pluginOptionsVal['wssbs_page_mail_title']!=''){ $mImgAlt=$pluginOptionsVal['wssbs_page_mail_title'];} 
else{$mImgAlt='Contact us';}   
//get google plus button image alt/title
if($pluginOptionsVal['wssbs_page_gp_title']!=''){ $gImgAlt=$pluginOptionsVal['wssbs_page_gp_title'];} 
else{$gImgAlt='Share On Google Plus';}  
//get pinterest button image alt/title  
if($pluginOptionsVal['wssbs_page_pin_title']!=''){ $pImgAlt=$pluginOptionsVal['wssbs_page_pin_title'];} 
else{$pImgAlt='Share On Pinterest';}   
//get youtube button image alt/title
if(isset($pluginOptionsVal['wssbs_page_yt_title']) && $pluginOptionsVal['wssbs_page_yt_title']!=''){ $ytImgAlt=$pluginOptionsVal['wssbs_page_yt_title'];} 
else{$ytImgAlt='Share On Youtube';}
//get reddit plus button image alt/title
if(isset($pluginOptionsVal['wssbs_page_re_title']) && $pluginOptionsVal['wssbs_page_re_title']!=''){ $reImgAlt=$pluginOptionsVal['wssbs_page_re_title'];} 
else{$reImgAlt='Share On Reddit';}  
//get stumbleupon button image alt/title  
if(isset($pluginOptionsVal['wssbs_page_st_title']) && $pluginOptionsVal['wssbs_page_st_title']!=''){ $stImgAlt=$pluginOptionsVal['wssbs_page_st_title'];} 
else{$stImgAlt='Share On Stumbleupon';}
   
//get email message 
if(is_page() || is_single() || is_category() || is_archive()){
	
		if($pluginOptionsVal['wssbs_mailMessage']!=''){ $mailMsg=$pluginOptionsVal['wssbs_mailMessage'];} else{
		 $mailMsg='?subject='.get_the_title().'&body='.$shareurl;}
 }else
 {
	 $mailMsg='?subject='.get_bloginfo('name').'&body='.home_url('/');
	 }
if(isset($pluginOptionsVal['wssbs_btn_position']) && $pluginOptionsVal['wssbs_btn_position']!=''):
$btnPosition=$pluginOptionsVal['wssbs_btn_position'];
else:
$btnPosition='left';
endif;

if(isset($pluginOptionsVal['wssbs_btn_text']) && $pluginOptionsVal['wssbs_btn_text']!=''):
$btnText=$pluginOptionsVal['wssbs_btn_text'];
else:
$btnText='';
endif;

$shareButtonContent='<div id="socialButtonOnPage" class="'.$btnPosition.'SocialButtonOnPage">';
if($btnText!=''):
$shareButtonContent.='<div class="sharethis-arrow" title="'.$btnText.'"><span>'.$btnText.'</span></div>';
endif;
/* Facebook*/
if($pluginOptionsVal['wssbs_fpublishBtn']!=''):
	$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="fb-p" class="wssbs-fb"><a href="javascript:"  onclick="window.open(\'//www.facebook.com/sharer/sharer.php?u='.$shareurl.'\',\'Facebook\',\'width=800,height=300\');return false;"
   target="_blank" title="'.$fImgAlt.'">';
if($fImg!=''){
$shareButtonContent .='<img src="'.$fImg.'" alt="'.$fImgAlt.'" width="35" height="35" >';
}else{
$shareButtonContent .='<i class="wssbs_facebook"></i>';
}
$shareButtonContent .='</a></div></div>';
endif;

/* Twitter */
if($pluginOptionsVal['wssbs_tpublishBtn']!=''):
	$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="tw-p" class="wssbs-tw"><a href="javascript:" onclick="window.open(\'//twitter.com/share?url='.$shareurl.'&text='.$ShareTitle.'&nbsp;&nbsp;\', \'_blank\', \'width=800,height=300\')" title="'.$tImgAlt.'">';
	if($tImg!='')
	{
	  $shareButtonContent .='<img src="'.$tImg.'" alt="'.$tImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="wssbs_twitter"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;

/* Google Plus */
if($pluginOptionsVal['wssbs_gpublishBtn']!=''):
	$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="gp-p" class="wssbs-gp"><a href="javascript:"  onclick="javascript:window.open(\'//plus.google.com/share?url='.$shareurl.'\',\'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800\');return false;" title="'.$gImgAlt.'">';
	if($gImg!='')
	{
	  $shareButtonContent .='<img src="'.$gImg.'" alt="'.$gImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="wssbs_plus"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;

/* Linkedin */
if($pluginOptionsVal['wssbs_lpublishBtn']!=''):
$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="li-p" class="wssbs-li"><a href="javascript:" onclick="javascript:window.open(\'//www.linkedin.com/shareArticle?mini=true&url='.$shareurl.'\',\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" title="'.$lImgAlt.'">';
	if($lImg!='')
	{
	  $shareButtonContent .='<img src="'.$lImg.'" alt="'.$lImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="wssbs_linkedin"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;

/* Pinterest */
if($pluginOptionsVal['wssbs_ppublishBtn']!=''):
$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="pin-p" class="wssbs-pin"><a onclick="window.open(\'//www.pinterest.com/pin/create/button/?url='.$shareurl.'&amp;media='.$pinShareImg.'&amp;description='.$ShareTitle.':'.$shareurl.'\',\'pinIt\',\'toolbar=0,status=0,width=620,height=500\');" href="javascript:void(0);" title="'.$pImgAlt.'">';
	if($pImg!='')
	{
	  $shareButtonContent .='<img src="'.$pImg.'" alt="'.$pImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="wssbs_pinterest"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/* Reddit */
if(isset($pluginOptionsVal['wssbs_republishBtn']) && $pluginOptionsVal['wssbs_republishBtn']!=''):
$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="re-p" class="wssbs-re"><a onclick="window.open(\'//reddit.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Reddit\',\'toolbar=0,status=0,width=1000,height=800\');" href="javascript:void(0);" title="'.$reImgAlt.'">';
	if($reImg!='')
	{
	  $shareButtonContent .='<img src="'.$reImg.'" alt="'.$reImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="wssbs_reddit"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/* Stumbleupon */
if(isset($pluginOptionsVal['wssbs_stpublishBtn']) && $pluginOptionsVal['wssbs_stpublishBtn']!=''):
$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="st-p" class="wssbs-st"><a onclick="window.open(\'//www.stumbleupon.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Stumbleupon\',\'toolbar=0,status=0,width=1000,height=800\');"  href="javascript:void(0);" title="'.$stImgAlt.'">';
	if($stImg!='')
	{
	  $shareButtonContent .='<img src="'.$stImg.'" alt="'.$stImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="wssbs_stumbleupon"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/* Youtube */
if(isset($pluginOptionsVal['wssbs_ytpublishBtn']) && $pluginOptionsVal['wssbs_ytpublishBtn']!=''):
$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="yt-p" class="wssbs-yt"><a onclick="window.open(\''.$pluginOptionsVal['wssbs_ytPath'].'\');" href="javascript:void(0);" title="'.$ytImgAlt.'">';
	if($ytImg!='')
	{
	  $shareButtonContent .='<img src="'.$ytImg.'" alt="'.$ytImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="wssbs_youtube"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/* Email */
if($pluginOptionsVal['wssbs_mpublishBtn']!=''):
$shareButtonContent.='<div class="wssbs-sbutton-post"><div id="ml-p" class="wssbs-ml"><a href="mailto:'.$mailMsg.'" title="'.$mImgAlt.'">';
	if($mImg!='')
	{
	  $shareButtonContent .='<img src="'.$mImg.'" alt="'.$mImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="wssbs_mail"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
$shareButtonContent.='</div>';

	// Returns the content.
global $post;
    $shareButtonContentReturn='';
	/* DEFAULT HOME */
	if((is_home() && is_front_page()) && $pluginOptionsVal['wssbs_page_hide_home']=='yes'):
	$shareButtonContentReturn=$shareButtonContent;
    endif;
	/* STATIC front page */
	if(is_front_page() && $pluginOptionsVal['wssbs_page_hide_home']=='yes'):
    $shareButtonContentReturn=$shareButtonContent;
    endif;
	
    if(is_single() && $pluginOptionsVal['wssbs_page_hide_post']=='yes'):
     $shareButtonContentReturn=$shareButtonContent;
      // echo 'dfff case 6';
    endif;
    if(is_page() && $pluginOptionsVal['wssbs_page_hide_page']=='yes'):
	if(!is_front_page()):
     $shareButtonContentReturn=$shareButtonContent;
     endif;
    endif;
    if(is_archive() && $pluginOptionsVal['wssbs_page_hide_archive']=='yes'):
     $shareButtonContentReturn=$shareButtonContent;
      //echo 'dfff case 14';
    endif;
   
    if(is_404()):
     $shareButtonContentReturn='';
      //echo 'dfff case 17';
    endif;
	/** Buttons position on content */
  if(isset($pluginOptionsVal['wssbs_btn_display']) && $pluginOptionsVal['wssbs_btn_display']=='above')
    {return $shareButtonContentReturn.$content;
		}
		else {
			return $content.$shareButtonContentReturn;
			}
}
?>
