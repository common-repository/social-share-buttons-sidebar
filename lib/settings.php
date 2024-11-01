 <div style="width: 80%; padding: 10px; margin: 10px;"> 

	<h1>Share Buttons</h1>
<!-- Start Options Form -->

	<form action="options.php" method="post" id="wssbs-sidebar-admin-form">
		
	<div id="wssbs-tab-menu"><a id="wssbs-general" class="wssbs-tab-links active" >Floating Sidebar Settings</a>  <a  id="wssbs-share-buttons" class="wssbs-tab-links">Page/post buttons settings</a></div>
	<p align="right"><span class="submit-btn"><?php echo get_submit_button('Save Settings','button-primary extrabtn','submit','','');?></span></p>
	<div class="wssbs-setting">
	<!-- General Setting -->	
	<div class="first wssbs-tab" id="div-wssbs-general">
	<h2>Floating Sidebar Settings</h2>
    <p><input type="checkbox" id="wssbs_active" name="wssbs_active" value='1' <?php checked(get_option('wssbs_active'),1);?>/> <b><?php _e('Enable Sidebar');?> </b></p>
<hr>
	<p><h3><strong><?php _e('Social Share Button Publish Options:','wssbs');?></strong></h3></p>
	<p><input type="checkbox" id="publish1" value="yes" name="wssbs_fpublishBtn" <?php checked(get_option('wssbs_fpublishBtn'),'yes');?>/><b>Facebook Button</b></p>
				<p><input type="checkbox" id="publish2" name="wssbs_tpublishBtn" value="yes" <?php checked(get_option('wssbs_tpublishBtn'),'yes');?>/> <b>Twitter Button</b></p>
				<p><input type="checkbox" id="publish3" name="wssbs_gpublishBtn" value="yes" <?php checked(get_option('wssbs_gpublishBtn'),'yes');?>/> <b>Google Button</b></p>
				<p class="hide-for-admin"><input type="checkbox" id="publish4" name="wssbs_lpublishBtn" value="yes" <?php checked(get_option('wssbs_lpublishBtn'),'yes');?>/> <b>Linkedin Button</b></p>
				<p><input type="checkbox" id="publish6" name="wssbs_ppublishBtn" value="yes" <?php checked(get_option('wssbs_ppublishBtn'),'yes');?>/> <b>Pinterest Button</b></p>
				<p><input type="checkbox" id="publish7" name="wssbs_republishBtn" value="yes" <?php checked(get_option('wssbs_republishBtn'),'yes');?>/> <b>Reddit Button</b></p>
				<p class="hide-for-admin"> <input type="checkbox" id="publish8" name="wssbs_stpublishBtn" value="yes" <?php checked(get_option('wssbs_stpublishBtn'),'yes');?>/> <b>Stumbleupon Button</b></p>
				<p><input type="checkbox" id="publish5" name="wssbs_mpublishBtn" value="yes" <?php checked(get_option('wssbs_mpublishBtn'),'yes');?>/> <b>Mailbox Button</b></p>
				<?php if(get_option('wssbs_mpublishBtn')=='yes');{?> 
				<div class="hide-for-admin">				<p id="mailmsg"><input type="text" name="wssbs_mailMessage" id="wssbs_mailMessage" value="<?php echo get_option('wssbs_mailMessage');?>" placeholder="raghunath.0087@gmail.com" size="40" class="regular-text ltr"><br>Note:add the mail message like this format <b>your@email.com?subject=Your Subject</b></p></div>

				<?php } ?>
				<p class="hide-for-admin"><input type="checkbox" id="ytBtns" name="wssbs_ytpublishBtn" value="yes" <?php checked(get_option('wssbs_ytpublishBtn'),'yes');?>/> <b>Youtube Button</b></p>
				<?php if(get_option('wssbs_ytpublishBtn')=='yes'){?> 
				<p id="ytpath"><input type="text" name="wssbs_ytPath" id="wssbs_ytPath" value="<?php echo get_option('wssbs_ytPath');?>" placeholder="http://www.youtube.com" size="40" class="regular-text ltr"><br>add youtube channel url</p>
				<?php } ?>
			

		 <div class="hide-for-admin"><p><label><h3 ><strong><?php _e('Define your custom message:','wssbs');?></strong></h3></label></p>
			<p><label><?php _e('Show:');?></label><input type="text" id="wssbs_show_btn" name="wssbs_show_btn" value="<?php echo get_option('wssbs_show_btn'); ?>" placeholder="Show Buttons" size="40"/></p>
			<p><label><?php _e('Hide:');?></label><input type="text" id="wssbs_hide_btn" name="wssbs_hide_btn" value="<?php echo get_option('wssbs_hide_btn'); ?>" placeholder="Hide Buttons" size="40"/></p>
			<p><label><?php _e('Message:');?></label><input type="textbox" id="wssbs_share_msg" name="wssbs_share_msg" value="<?php echo get_option('wssbs_share_msg'); ?>" placeholder="Share This With Your Friends" size="40"/></p></div>	
	      <hr>
	      <span class="hide-for-admin">
	        <p><h3><strong><?php _e('Pinterest Share Image Setting :'); ?></strong></h3></p>
			<p><?php _e('Default Image :');?><input type="textbox" id="wssbs_defaultfeaturedshrimg" name="wssbs_defaultfeaturedshrimg" value="<?php echo get_option('wssbs_defaultfeaturedshrimg'); ?>" placeholder="" size="55"/></p>
			<p><input type="checkbox" id="featuredshrimg" name="wssbs_featuredshrimg" value="yes" <?php checked(get_option('wssbs_featuredshrimg'),'yes');?>/> <?php _e('Make post/page featured image as pinterest share image');?></p>
		</span>
	<table>
			<tr class="hide-for-admin">
				<th nowrap><?php echo 'Siderbar Position:';?></th>
				<td>
				<select id="wssbs_position" name="wssbs_position" >
				<option value="left" <?php selected(get_option('wssbs_position'),'left');?>>Left</option>
				<option value="right" <?php selected(get_option('wssbs_position'),'right');?>>Right</option>
				<option value="bottom" <?php selected(get_option('wssbs_position'),'bottom');?>>Bottom</option>
				</select>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td><input type="checkbox" id="wssbs_rmSHBtn" name="wssbs_rmSHBtn" value="yes" <?php checked(get_option('wssbs_rmSHBtn'),'yes');?>/> <strong><?php _e('Remove Show/Hide Button:','wssbs');?></strong></td>
			</tr>
			<tr class="hide-for-admin"><th nowrap valign="top"><?php echo 'Delay Time: '; ?></th><td><input type="text" name="wssbs_delayTimeBtn" id="wssbs_delayTimeBtn" value="<?php echo get_option('wssbs_delayTimeBtn')?get_option('wssbs_delayTimeBtn'):0;?>"  size="40" class="regular-text ltr"><br><i>Publish share buttons after given time(millisecond)</i></td></tr>

				<tr class="hide-for-admin">
				<th>&nbsp;</th>
				<td><input type="checkbox" id="wssbs_deactive_for_mob" name="wssbs_deactive_for_mob" value="yes" <?php checked(get_option('wssbs_deactive_for_mob'),'yes');?>/><?php _e('Disable Sidebar For Mobile','wssbs');?></td>
			</tr>
			<tr class="hide-for-admin"><th></th>
				<td><input type="checkbox" id="wssbs_auto_hide" name="wssbs_auto_hide" value="yes" <?php checked(get_option('wssbs_auto_hide'),'yes');?>/><?php _e('Auto Hide Sidebar On Page Load','wssbs');?></td>
			</tr>
			<tr class="hide-for-admin"><th>&nbsp;</th><td><input type="checkbox" id="wssbs_hide_home" value="yes" name="wssbs_hide_home" <?php checked(get_option('wssbs_hide_home'),'yes');?>/>Hide Sidebar On Home Page</td></tr>
			
			<tr><td colspan="2">
				<strong class="hide-for-admin"><h4>Social Share Button Images 32X32 (Optional) :</h4></strong></td></tr>
			<tr class="hide-for-admin"><td colspan="2" align="right"><input type="button" id="wssbs_resetpage" value="Reset"></td></tr>
			<tr class="hide-for-admin">
			<th><?php echo 'Facebook:';?></th>
			<td class="wssbsButtonsImg" id="wssbsButtonsFbImg">
	       <input type="text" id="wssbs_fb_image" name="wssbs_fb_image" value="<?php echo get_option('wssbs_fb_image'); ?>" placeholder="Insert facebook button image path" size="30" class="inputButtonid"/> <input id="wssbs_fb_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_fb_bg" data-default-color="#305891" class="color-field" name="wssbs_fb_bg" value="<?php echo get_option('wssbs_fb_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="wssbs_fb_title"  name="wssbs_fb_title" value="<?php echo get_option('wssbs_fb_title'); ?>" placeholder="Share on facebook" size="20" class="wssbs_title"/>
			</td>
			</tr>
			<tr class="hide-for-admin"><th><?php echo 'Twitter:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsTwImg">		
				<input type="text" id="wssbs_tw_image" name="wssbs_tw_image" value="<?php echo get_option('wssbs_tw_image'); ?>" placeholder="Insert twitter button image path" size="30" class="inputButtonid"/><input id="wssbs_tw_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_tw_bg" name="wssbs_tw_bg" value="<?php echo get_option('wssbs_tw_bg'); ?>" data-default-color="#2ca8d2" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="wssbs_tw_title"  name="wssbs_tw_title" value="<?php echo get_option('wssbs_tw_title'); ?>" placeholder="Share on twitter" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin">
				<th><?php echo 'Linkedin:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsLiImg">
				<input type="text" id="wssbs_li_image" name="wssbs_li_image" value="<?php echo get_option('wssbs_li_image'); ?>" placeholder="Insert Linkedin button image path" class="inputButtonid" size="30" class="buttonimg"/><input id="wssbs_li_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_li_bg" name="wssbs_li_bg" value="<?php echo get_option('wssbs_li_bg'); ?>" data-default-color="#dd4c39" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="wssbs_li_title"  name="wssbs_li_title" value="<?php echo get_option('wssbs_li_title'); ?>" placeholder="Share on Linkedin" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin"><th><?php echo 'Pintrest:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsPiImg">			
				<input type="text" id="wssbs_pin_image" name="wssbs_pin_image" value="<?php echo get_option('wssbs_pin_image'); ?>" class="inputButtonid" placeholder="Insert pinterest button image path" size="30" class="buttonimg"/><input id="wssbs_pin_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_pin_bg" name="wssbs_pin_bg" value="<?php echo get_option('wssbs_pin_bg'); ?>" data-default-color="#ca2027" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="wssbs_pin_title"  name="wssbs_pin_title" value="<?php echo get_option('wssbs_pin_title'); ?>" placeholder="Share on pintrest" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin"><th><?php echo 'Google Plus:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsGoImg">
				<input type="text" id="wssbs_gp_image" name="wssbs_gp_image" value="<?php echo get_option('wssbs_gp_image'); ?>" placeholder="Insert google button image path" size="30" class="inputButtonid"/><input id="wssbs_gp_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_gp_image" name="wssbs_gp_bg" value="<?php echo get_option('wssbs_gp_bg'); ?>" data-default-color="#dd4c39" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="wssbs_gp_title"  name="wssbs_gp_title" value="<?php echo get_option('wssbs_gp_title'); ?>" placeholder="Share on google" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin"><th><?php echo 'Reddit:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsReImg">
				<input type="text" id="wssbs_re_image" name="wssbs_re_image" value="<?php echo get_option('wssbs_re_image'); ?>" placeholder="Insert reddit button image path" size="30" class="inputButtonid"/><input id="wssbs_re_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_re_bg" name="wssbs_re_bg" value="<?php echo get_option('wssbs_re_bg'); ?>" data-default-color="#ff1a00" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="wssbs_re_title"  name="wssbs_re_title" value="<?php echo get_option('wssbs_re_title'); ?>" placeholder="Share on reddit" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin"><th><?php echo 'Stumbleupon:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsStImg">
				<input type="text" id="wssbs_st_image" name="wssbs_st_image" value="<?php echo get_option('wssbs_st_image'); ?>" placeholder="Insert stumbleupon button image path" size="30" class="inputButtonid"/><input id="wssbs_st_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_st_bg" name="wssbs_st_bg" value="<?php echo get_option('wssbs_st_bg'); ?>" data-default-color="#eb4924" class="color-field"  size="20"/>
				&nbsp;&nbsp;<input type="text" id="wssbs_st_title"  name="wssbs_st_title" value="<?php echo get_option('wssbs_st_title'); ?>" placeholder="Share on stumbleupon" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin"><th><?php echo 'Mail:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsMaImg">
				<input type="text" id="wssbs_mail_image" name="wssbs_mail_image" value="<?php echo get_option('wssbs_mail_image'); ?>" placeholder="Insert mail button image path" size="30" class="inputButtonid"/><input id="wssbs_mail_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_mail_bg" name="wssbs_mail_bg" value="<?php echo get_option('wssbs_mail_bg'); ?>" data-default-color="#738a8d" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="wssbs_mail_title"  name="wssbs_mail_title" value="<?php echo get_option('wssbs_mail_title'); ?>" placeholder="Send contact request" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin"><th><?php echo 'Youtube:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsYtImg">
				<input type="text" id="wssbs_yt_image" name="wssbs_yt_image" value="<?php echo get_option('wssbs_yt_image'); ?>" placeholder="Insert youtube button image path" size="30" class="inputButtonid"/><input id="wssbs_yt_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_yt_bg" name="wssbs_yt_bg" value="<?php echo get_option('wssbs_yt_bg'); ?>" data-default-color="#ffffff" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="wssbs_yt_title"  name="wssbs_yt_title" value="<?php echo get_option('wssbs_yt_title'); ?>" placeholder="Youtube" size="20" class="wssbs_title"/>
				</td>
			</tr>		
			<tr><td colspan="2">
	<hr>
				<h3 class="hide-for-admin"><strong>Positioning</strong></h3></td></tr>
			
			<tr class="hide-for-admin">
				<th><?php echo 'Top Margin:';?></th>
				<td>
			
				<input type="textbox" id="wssbs_top_margin" name="wssbs_top_margin" value="<?php echo get_option('wssbs_top_margin'); ?>" placeholder="10px" size="10"/>
				</td>
			</tr>
	</table>
	</div>
	<!-- Share Buttons -->
	<div class="wssbs-tab" id="div-wssbs-share-buttons">
	<h2 style="line-height: 150%; text-align: center; font-size: 22px;">To enable share buttons above/under posts and pages <br>please purchase the ultra version</h2>
			<a href="https://goo.gl/QO4bVx" target="_blank" style="text-align: center; margin: auto; float: none; display: block; max-width: 200px; background: #27d644; padding: 17px 20px; text-decoration: none; color: #fff; font-weight: 900; font-size: 16px;">
		Upgrade now
	</a>

	<table class="hide-for-admin">
		    <td><?php _e('Enable:','wssbs');?></td>
				<td colspan="2">
					<input type="checkbox" id="wssbs_buttons_active" name="wssbs_buttons_active" value='1' <?php checked(get_option('wssbs_buttons_active'),1);?>/>
				</td>
		    </tr>
			<tr>
				<th nowrap><?php echo 'Share Button Position:';?></th>
				<td>
				<select id="wssbs_btn_position" name="wssbs_btn_position" >
				<option value="left" <?php selected(get_option('wssbs_btn_position'),'left');?>>Left</option>
				<option value="right" <?php selected(get_option('wssbs_btn_position'),'right');?>>Right</option>
				</select>
				</td>
			</tr>
			<tr>
				<th nowrap><?php echo 'Display Buttons On ';?></th>
				<td>
				<select id="wssbs_btn_display" name="wssbs_btn_display" >
				<option value="below" <?php selected(get_option('wssbs_btn_display'),'below');?>>Bottom Of The Content</option>
				<option value="above" <?php selected(get_option('wssbs_btn_display'),'above');?>>Top Of The Content</option>
				</select>
				</td>
			</tr>
			<tr>
				<th nowrap><?php echo 'Share Button Text:';?></th>
				<td>
				<input type="textbox" id="wssbs_btn_text" name="wssbs_btn_text" value="<?php echo get_option('wssbs_btn_text'); ?>" placeholder="Share This!" size="20"/>
				<i>(Leave blank if you want hide button)</i></td>
			</tr>
			<tr><td colspan="2">Show Share Buttons On: Home <input type="checkbox" id="wssbs_page_hide_home" value="yes" name="wssbs_page_hide_home" <?php checked(get_option('wssbs_page_hide_home'),'yes');?>/> 
				<br>Show Share Buttons On: Page <input type="checkbox" id="wssbs_page_hide_page" value="yes" name="wssbs_page_hide_page" <?php checked(get_option('wssbs_page_hide_page'),'yes');?>/> 
<br>Show Share Buttons On:
				Post <input type="checkbox" id="wssbs_page_hide_post" value="yes" name="wssbs_page_hide_post" <?php checked(get_option('wssbs_page_hide_post'),'yes');?>/>
				<br> Show Share Buttons On: Category/Archive <input type="checkbox" id="wssbs_page_hide_archive" value="yes" name="wssbs_page_hide_archive" <?php checked(get_option('wssbs_page_hide_archive'),'yes');?>/> <br>
			</td></tr>
			
			<tr><td colspan="2">
<hr>
				<strong class="hide-for-admin"><h4>Social Share Button Images 32X32 (Optional) :</h4></strong></td></tr>
			<tr class="hide-for-admin"><td colspan="2" align="right"><input type="button" id="wssbsresetpage" value="RESET"></td></tr>
			<tr class="hide-for-admin"><th><?php echo 'Facebook:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsFbImg2"><input type="text" id="wssbs_page_fb_image" name="wssbs_page_fb_image" value="<?php echo get_option('wssbs_page_fb_image'); ?>" placeholder="Insert facebook button image path" size="40"  class="inputButtonid"/>
                <input id="wssbs_fb_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_fb_title"  name="wssbs_page_fb_title" value="<?php echo get_option('wssbs_page_fb_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin">
				<th><?php echo 'Twitter:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsTwImg2">
				<input type="text" id="wssbs_page_tw_image" name="wssbs_page_tw_image" value="<?php echo get_option('wssbs_page_tw_image'); ?>" placeholder="Insert twitter button image path" size="40" class="inputButtonid"/>
				<input id="wssbs_tw_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_tw_title"  name="wssbs_page_tw_title" value="<?php echo get_option('wssbs_page_tw_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin"><th><?php echo 'Linkedin:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsLiImg2"><input type="text" id="wssbs_page_li_image" name="wssbs_page_li_image" value="<?php echo get_option('wssbs_page_li_image'); ?>" placeholder="Insert Linkedin button image path" size="40" class="inputButtonid"/>
				<input id="wssbs_li_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_li_title"  name="wssbs_page_li_title" value="<?php echo get_option('wssbs_page_li_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin">
				<th><?php echo 'Pintrest:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsPiImg2"><input type="text" id="wssbs_page_pin_image" name="wssbs_page_pin_image" value="<?php echo get_option('wssbs_page_pin_image'); ?>" placeholder="Insert pinterest button image path" size="40" class="inputButtonid"/>
				<input id="wssbs_pi_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_pin_title"  name="wssbs_page_pin_title" value="<?php echo get_option('wssbs_page_pin_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin">
				<th><?php echo 'Google Plus:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsGpImg2">
				<input type="text" id="wssbs_page_gp_image" name="wssbs_page_gp_image" value="<?php echo get_option('wssbs_page_gp_image'); ?>" placeholder="Insert google button image path" size="40" class="inputButtonid"/>
				<input id="wssbs_gp_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_gp_title"  name="wssbs_page_gp_title" value="<?php echo get_option('wssbs_page_gp_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin">
				<th><?php echo 'Reddit:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsReImg2">
				<input type="text" id="wssbs_page_re_image" name="wssbs_page_re_image" value="<?php echo get_option('wssbs_page_re_image'); ?>" placeholder="Insert reddit button image path" size="40" class="inputButtonid"/>
				<input id="wssbs_re_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_re_title"  name="wssbs_page_re_title" value="<?php echo get_option('wssbs_page_re_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin">
				<th><?php echo 'Stumbleupon:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsStImg2">
				<input type="text" id="wssbs_page_st_image" name="wssbs_page_st_image" value="<?php echo get_option('wssbs_page_st_image'); ?>" placeholder="Insert stumbleupon button image path" size="40" class="inputButtonid"/>
				<input id="wssbs_st_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_st_title"  name="wssbs_page_st_title" value="<?php echo get_option('wssbs_page_st_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin">
				<th><?php echo 'Mail:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsMlImg2">
				<input type="text" id="wssbs_page_mail_image" name="wssbs_page_mail_image" value="<?php echo get_option('wssbs_page_mail_image'); ?>" placeholder="Insert mail button image path" size="40" class="inputButtonid"/>
				<input id="wssbs_ml_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_mail_title"  name="wssbs_page_mail_title" value="<?php echo get_option('wssbs_page_mail_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
			<tr class="hide-for-admin">
				<th><?php echo 'Youtube:';?></th>
				<td class="wssbsButtonsImg" id="wssbsButtonsYtImg2">
				<input type="text" id="wssbs_page_yt_image" name="wssbs_page_yt_image" value="<?php echo get_option('wssbs_page_yt_image'); ?>" placeholder="Insert youtube button image path" size="40" class="inputButtonid"/>
				<input id="wssbs_yt_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="wssbs_page_yt_title"  name="wssbs_page_yt_title" value="<?php echo get_option('wssbs_page_yt_title'); ?>" placeholder="Alt Text" size="20" class="wssbs_title"/>
				</td>
			</tr>
	</table>
	
	</div>
	
	</div>
	<span class="submit-btn"><?php echo get_submit_button('Save Settings','button-primary','submit','','');?></span>
		
    <?php settings_fields('wssbs_sidebar_options'); ?>
	
	</form>
	<a href="https://goo.gl/QO4bVx" target="_blank">
		<img src="https://goo.gl/Ve6Zg1">
	</a>

<!-- End Options Form -->
	</div>
