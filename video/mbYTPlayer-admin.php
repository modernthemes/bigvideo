<?php

// create the admin menu
function add_mbYTPlayer_option_page() {
    // hook in the options page function
   add_theme_page('Big Video Background', 'Big Video Background', 'manage_options', __FILE__, 'mbYTPlayer_options_page', "", 25 );
    // add_theme_page( 'mb.YTPlayer', 'mb.YTPlayer', 'manage_options', __FILE__, "mbYTPlayer_options_page", "", 100 );
}
// hook in the action for the admin options page
add_action('admin_menu', 'add_mbYTPlayer_option_page');

function mbYTPlayer_options_page() { 	// Output the options page
    global $mbYTPlayer_donate, $mbYTPlayer_version, $mbYTPlayer_home_video_url, $mbYTPlayer_show_controls, $mbYTPlayer_show_videourl, $mbYTPlayer_start_at, $mbYTPlayer_stop_at, $mbYTPlayer_mute, $mbYTPlayer_ratio, $mbYTPlayer_loop, $mbYTPlayer_opacity, $mbYTPlayer_quality, $mbYTPlayer_add_raster, $mbYTPlayer_realfullscreen, $mbYTPlayer_stop_onclick  ?>

    <!-- DONATE POPUP-->
    <style>
        #donate{ position: fixed; top: 20%; left: 0; width: 100%; height: 100%; padding: 30px; text-align: center; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; z-index: 10000; }
        #donateContent{ position: relative; margin: 30px auto; background: rgba(77, 71, 61, 0.88); color:white; padding: 30px; text-align: center; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; width: 450px; border-radius: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.5) }
        #donate h2{ font-size: 30px; line-height: 33px; }
        #donate p{ margin: 30px; font-size: 16px; line-height: 22px; display: block; float: none; }
        #donate p#follow{ margin: 30px; font-size: 16px; line-height: 33px; }
        #donate p#timer{ padding: 5px; font-size: 20px; line-height: 33px; background: #231d0c; border-radius: 30px; color: #ffffff; width: 30px; margin: auto; }
        #donateTxt{display:none;}
        hr{border: none; height: 1px; background: #dfd490}
    </style>

    <div class="wrap" style="width:800px">
    <style>
   
        .form-table th{ font-weight: bold!important; border-bottom: 1px solid gray; }
        .form-table td{ border-bottom: 1px solid gray; }
        .submit{ text-align: right; }
    </style>
    
    <h2><?php _e('Big Video Background Theme Settings', 'mbYTPlayer'); ?></h2>

    
        <!-- Begin MailChimp Signup Form -->
       
        <!--End mc_embed_signup-->
    </div>

    <form id="optionsForm" method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <h2><?php _e('Reference', 'mbYTPlayer'); ?></h2>

        <p><?php _e('Leave the <b>home video url</b> blank if you don’t want to display a background video on your homepage.', 'mbYTPlayer'); ?>
        </p> 
        <br>
        <h2><?php _e('Home page background video properties', 'mbYTPlayer'); ?>:</h2>
        <p><?php _e('These settings are used only for the Home istance of the Big Video theme component', 'mbYTPlayer'); ?>.</p>
        <br>
        <br>
        <input type="hidden" name="mbYTPlayer_donate" value="<?php echo $mbYTPlayer_donate;?>" />
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('url', 'mbYTPlayer'); ?></th>
                <td>
                    <input type="text" name="mbYTPlayer_home_video_url" style="width:70%" value="<?php if (!empty($mbYTPlayer_home_video_url)) {echo $mbYTPlayer_home_video_url; }?>"/>
                    <p><?php _e('Copy and paste here the URL of the Youtube video you want as your homepage background', 'mbYTPlayer'); ?>.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('opacity', 'mbYTPlayer'); ?></th>
                <td>
                    <select name="mbYTPlayer_opacity">
                        <option value=".3" <?php if ($mbYTPlayer_opacity==".3") {echo' selected'; }?> >0.3</option>
                        <option value=".5" <?php if ($mbYTPlayer_opacity==".5") {echo' selected'; }?>>0.5</option>
                        <option value=".8" <?php if ($mbYTPlayer_opacity==".8") {echo' selected'; }?>>0.8</option>
                        <option value="1" <?php if ($mbYTPlayer_opacity=="1") {echo' selected'; }?>>1</option>
                    </select>
                    <p><?php _e('Set the opacity of the background video', 'mbYTPlayer'); ?>.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('quality', 'mbYTPlayer'); ?></th>
                <td>
                    <select name="mbYTPlayer_quality">
                        <option value="default" <?php if ($mbYTPlayer_quality=="default") {echo' selected'; }?> ><?php _e('default', 'mbYTPlayer'); ?></option>
                        <option value="small" <?php if ($mbYTPlayer_quality=="small") {echo' selected'; }?> ><?php _e('small', 'mbYTPlayer'); ?></option>
                        <option value="medium" <?php if ($mbYTPlayer_quality=="medium") {echo' selected'; }?> ><?php _e('medium', 'mbYTPlayer'); ?></option>
                        <option value="large" <?php if ($mbYTPlayer_quality=="large") {echo' selected'; }?> ><?php _e('large', 'mbYTPlayer'); ?></option>
                        <option value="hd720" <?php if ($mbYTPlayer_quality=="hd720") {echo' selected'; }?> ><?php _e('hd720', 'mbYTPlayer'); ?></option>
                        <option value="hd1080" <?php if ($mbYTPlayer_quality=="hd1080") {echo' selected'; }?> ><?php _e('hd1080', 'mbYTPlayer'); ?></option>
                        <option value="highres" <?php if ($mbYTPlayer_quality=="highres") {echo' selected'; }?> ><?php _e('highres', 'mbYTPlayer'); ?></option>
                    </select>
                    <p><?php _e('Set the quality of the background video ("default" YouTube selects the appropriate playback quality)', 'mbYTPlayer'); ?>.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('aspect ratio', 'mbYTPlayer'); ?></th>
                <td>
                    <select name="mbYTPlayer_ratio">
                        <option value="auto" <?php if ($mbYTPlayer_ratio=="auto") {echo' selected'; }?> ><?php _e('auto', 'mbYTPlayer'); ?></option>
                        <option value="4/3" <?php if ($mbYTPlayer_ratio=="4/3") {echo' selected'; }?> ><?php _e('4/3', 'mbYTPlayer'); ?></option>
                        <option value="16/9" <?php if ($mbYTPlayer_ratio=="16/9") {echo' selected'; }?>><?php _e('16/9', 'mbYTPlayer'); ?></option>
                    </select>
                    <p><?php _e('Set the aspect-ratio of the background video. If "auto" the plug in will try to retrieve the aspect ratio from Youtube. If you have problems on viewing the background video try setting this manually.', 'mbYTPlayer'); ?>
                    </p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('start at', 'mbYTPlayer'); ?></th>
                <td>
                    <input type="text" name="mbYTPlayer_start_at" style="width:10%" value="<?php if (!empty($mbYTPlayer_start_at)) {echo $mbYTPlayer_start_at; }?>"/>
                    <p><?php _e('Set the seconds the video should start at', 'mbYTPlayer'); ?>.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('stop at', 'mbYTPlayer'); ?></th>
                <td>
                    <input type="text" name="mbYTPlayer_stop_at" style="width:10%" value="<?php if (!empty($mbYTPlayer_stop_at)) {echo $mbYTPlayer_stop_at; }?>"/>
                    <p><?php _e('Set the seconds the video should stop at', 'mbYTPlayer'); ?>.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('show controls', 'mbYTPlayer'); ?></th>
                <td>
                    <input id="mbYTPlayer_show_controls" onclick="videoUrlControl()" type="checkbox" name="mbYTPlayer_show_controls" value="true" <?php if ($mbYTPlayer_show_controls=="true") {echo' checked="checked"'; }?>/>
                    <p><?php _e('Check to show controls at the bottom of the page', 'mbYTPlayer'); ?>.</p>
                    <div id="videourl" style="display: none;">
                        <input id="mbYTPlayer_show_videourl"  type="checkbox" name="mbYTPlayer_show_videourl" value="true" <?php if ($mbYTPlayer_show_videourl=="true") {echo' checked="checked"'; } ?>/>
                        <p><?php _e('Check to show the link to the original YouTube® video', 'mbYTPlayer'); ?>.</p>
                    </div>
                    <script>
                        function videoUrlControl(){
                            if (jQuery("#mbYTPlayer_show_controls").is(":checked")){
                                jQuery("#videourl").show();
                            }else{
                                jQuery("#mbYTPlayer_show_videourl").attr("checked",false).val(false);
                                jQuery("#videourl").hide();
                            }
                        }
                        videoUrlControl();
                    </script>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('Full screen behavior', 'mbYTPlayer'); ?></th>
                <td>
                    <input type="radio" name="mbYTPlayer_realfullscreen" value="true" <?php if ($mbYTPlayer_realfullscreen=="true") {echo' checked="checked"'; }?>/>
                    <p><?php _e('Full screen containment is the screen', 'mbYTPlayer'); ?></p>
                    <input type="radio" name="mbYTPlayer_realfullscreen" value="false" <?php if ($mbYTPlayer_realfullscreen=="false") {echo' checked="checked"'; }?>/>
                    <p><?php _e('Full screen containment is the browser window', 'mbYTPlayer'); ?></p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video mute', 'mbYTPlayer'); ?></th>
                <td>
                    <input type="checkbox" name="mbYTPlayer_mute" value="true" <?php if ($mbYTPlayer_mute=="true") {echo' checked="checked"'; }?>/>
                    <p><?php _e('Check to mute the audio of the video', 'mbYTPlayer'); ?>.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('loop', 'mbYTPlayer'); ?></th>
                <td>
                    <input type="checkbox" name="mbYTPlayer_loop" value="true" <?php if ($mbYTPlayer_loop=="true") {echo' checked="checked"'; }?>/>
                    <p><?php _e('Check to loop the video once ended', 'mbYTPlayer'); ?>.</p>

                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('home video', 'mbYTPlayer'); ?>: <?php _e('raster image', 'mbYTPlayer'); ?></th>
                <td>
                    <input type="checkbox" name="mbYTPlayer_add_raster" value="true" <?php if ($mbYTPlayer_add_raster=="true") {echo' checked="checked"'; }?>/>
                    <p><?php _e('Check to add a raster effect to the video', 'mbYTPlayer'); ?>.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Stop the player if a link is clicked', 'mbYTPlayer'); ?></th>
                <td>
                    <input type="checkbox" name="mbYTPlayer_stop_onclick" value="true" <?php if ($mbYTPlayer_stop_onclick=="true") {echo' checked="checked"'; }?>/>
                    <p><?php _e('Check to stop the player once clicked on a link<br>(firefox has problems catching the event and this speedup the action)', 'mbYTPlayer'); ?>.</p>
                </td>
            </tr>
        </table>
        <input type="hidden" name="page_options" value="mbYTPlayer_donate, mbYTPlayer_home_video_url, mbYTPlayer_show_controls, mbYTPlayer_show_videourl, mbYTPlayer_mute, mbYTPlayer_ratio, mbYTPlayer_start_at, mbYTPlayer_stop_at, mbYTPlayer_loop, mbYTPlayer_opacity, mbYTPlayer_quality, mbYTPlayer_add_raster, mbYTPlayer_stop_onclick, mbYTPlayer_realfullscreen" />
        <input type="hidden" name="action" value="update" />
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
    </div>
<?php } ?>
