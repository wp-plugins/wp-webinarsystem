<?php
/*
 * 
 * Webinar General Settings page.
 * 
 */

class WebinarSysteemOptions extends WebinarSysteem {

    private $localkey_statuss;

    function __construct($localkey_status) {
        $this->localkey_statuss = $localkey_status;
        parent::setAttributes();
    }

    public function wbn_gengeral_settings() {

        if (isset($_GET['reset']) && !isset($_GET['settings-updated'])):
            $setting = isset($_GET['setting']) ? $_GET['setting'] : NULL;
            WebinarSysteemOptions::DoResetDefaults($setting);
        endif;
        ?>



        <div class="wrap wswebinarwrap">
            <div class="wswebinarLogo">
                <img src="<?php echo plugins_url('images/WebinarSysteem-logo.png', __FILE__); ?>" />
            </div>
			<div style="clear: both"></div>
            <h2 class=""><?php _e('WP WebinarSystem Options', WebinarSysteem::$lang_slug); ?></h2>
            <form action="options.php" method="post">
                <div id="tabs">
                    <div class="tabset-container">
                        <ul>
                            <li class="tabset"><a href="#tabs-1"><?php _e('General', WebinarSysteem::$lang_slug); ?></a></li>
                            <li class="tabset"><a href="#tabs-2"><?php _e('Emails', WebinarSysteem::$lang_slug); ?></a></li>
                            <li class="tabset"><a href="#tabs-4"><?php _e('System Status', WebinarSysteem::$lang_slug); ?></a></li> 
                        </ul>
                    </div>
                    <div id="tabs-1">

                        <?php settings_fields('wswebinar_options'); ?>
                        <?php do_settings_sections('wswebinar_options'); ?>
                        <h3><?php _e('General Options', WebinarSysteem::$lang_slug); ?></h3>
                        <table class="form-table">
                            
                        </table>
                        <?php submit_button(); ?>

                    </div>
                    <div id="tabs-2">
                        <div class="wswebinarCustomTab">
                            <div class="tabHeaders-container">
                                <ul class="tabHeaders">
                                    <li><a href="#customTab1"><?php _e('Email options', WebinarSysteem::$lang_slug); ?></a></li> |
                                    <li><a href="#customTab2"><?php _e('New Registration', WebinarSysteem::$lang_slug); ?></a></li> 
                                    | <li><a href="#customTab3"><?php _e('Reminder day before Webinar', WebinarSysteem::$lang_slug); ?></a></li> |
                                    <li><a href="#customTab4"><?php _e('Reminder one hour before Webinar', WebinarSysteem::$lang_slug); ?></a></li> |
                                    <li><a href="#customTab5"><?php _e('Reminder Webinar Starting', WebinarSysteem::$lang_slug); ?></a></li> |
                                    <li><a href="#customTab6"><?php _e('Webinar replay', WebinarSysteem::$lang_slug); ?></a></li>
                                </ul>
                            </div>
                            <div class="customTab" id="customTab1">

                                <h3><?php _e('Email Sender Options', WebinarSysteem::$lang_slug); ?></h3>
                                <table class="form-table">                                    
                                    <tr>
                                        <th><label for="SentFrom"><?php _e('"From" Name', WebinarSysteem::$lang_slug); ?></label></th><td><input id="SentFrom" name="_wswebinar_email_sentFrom" class="regular-text" type="text" placeholder="<?php _e('Sender name', WebinarSysteem::$lang_slug) ?>" value="<?php echo get_option('_wswebinar_email_sentFrom'); ?>"/></td>
                                    </tr>
                                    <tr>
                                        <th><label for="SenderEmailAddress"><?php _e('"From" Email Address', WebinarSysteem::$lang_slug); ?></label></th><td><input id="SenderEmailAddress" class="regular-text" name="_wswebinar_email_senderAddress" type="email" placeholder="<?php _e('Sender email', WebinarSysteem::$lang_slug) ?>" value="<?php echo get_option('_wswebinar_email_senderAddress'); ?>"/></td>
                                    </tr>
                                </table>

                                <h3><?php _e('Email Template', WebinarSysteem::$lang_slug); ?></h3>
                                <table class="form-table">
                                    <tr>
                                        <th>
                                            <label for="HeaderImg"><?php _e('Header Image', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input type="text" name="_wswebinar_email_headerImg" id="email_headerImg" class="regular-text" value="<?php echo get_option('_wswebinar_email_headerImg') ?>">
                                            <button class="button wswebinar_uploader" resultId="email_headerImg" uploader_title="Header Image for Mails"><?php _e('Upload', WebinarSysteem::$lang_slug); ?></button>
                                            <div class="webinar_clear_fix"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="EmailFooterTxt"><?php _e('Email Footer Text', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <textarea id="EmailFooterTxt" class="large-text" name="_wswebinar_email_footerTxt" placeholder="<?php _e('Footer Text', WebinarSysteem::$lang_slug) ?>"><?php echo get_option('_wswebinar_email_footerTxt'); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="BaseCLR"><?php _e('Base color', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="BaseCLR" name="_wswebinar_email_baseCLR" class="color-field" type="text" value="<?php echo get_option('_wswebinar_email_baseCLR'); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="BckCLR"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="BckCLR" name="_wswebinar_email_bckCLR" class="color-field" type="text" value="<?php echo get_option('_wswebinar_email_bckCLR'); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="EmailBodyBck"><?php _e('Email Body Background color', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="EmailBodyBck" name="_wswebinar_email_bodyBck" type="text" class="color-field" value="<?php echo get_option('_wswebinar_email_bodyBck'); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="EMailBodyTXT"><?php _e('Email Body Text color', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="EMailBodyTXT" name="_wswebinar_email_bodyTXT" type="text" class="color-field" value="<?php echo get_option('_wswebinar_email_bodyTXT'); ?>"/>
                                        </td>
                                    </tr>

                                </table>
                                <div>
                                    <div class="optionpage-buttons-email">
                                        <a class="button optionspage-buttons-email-reset" href="<?php echo admin_url('edit.php?post_type=wswebinars&page=wswbn-options&reset=yes'); ?>"><?php _e('Reset Default Template', WebinarSysteem::$lang_slug); ?></a>
                                    </div>
                                    <div class="optionpage-buttons-email">
                                        <?php submit_button(); ?>
                                    </div>
                                </div>
                            </div>
                            </ul>
                            <div class="customTab" id="customTab2">
                                <h3><?php _e('New Registration Options', WebinarSysteem::$lang_slug); ?></h3>
                                <table class="form-table">                                    
                                    <tr>
                                        <th><label for="AdminEmailAddress"><?php _e('Admin Email Address', WebinarSysteem::$lang_slug); ?></label></th><td><input id="AdminEmailAddress" class="regular-text" name="_wswebinar_AdminEmailAddress" type="email" placeholder="<?php _e('Admin email', WebinarSysteem::$lang_slug) ?>" value="<?php echo get_option('_wswebinar_AdminEmailAddress'); ?>"/></td>
                                    </tr>
                                </table>
                                <?php submit_button() ?>
                            </div>
                            <div class="customTab" id="customTab3">
                                <h3><?php _e('Reminder day before Webinar ', WebinarSysteem::$lang_slug); ?></h3>
                                <table class="form-table">
                                    <tr>
                                        <th>
                                            <label for="24hrb4-enable"><?php _e('Enable this reminder?', WebinarSysteem::$lang_slug) ?></label>
                                        </th>
                                        <td>
                                            <input id="24hrb4-enable" type="checkbox" name="_wswebinar_24hrb4enable" <?php echo (get_option('_wswebinar_24hrb4enable') == 'on' ? 'checked' : ''); ?>/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="24hrb4subject"><?php _e('Subject', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="24hrb4subject" class="regular-text" name="_wswebinar_24hrb4subject"  placeholder="<?php _e('Email Head', WebinarSysteem::$lang_slug) ?>" value="<?php echo get_option('_wswebinar_24hrb4subject'); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label><?php _e('Available Shortcodes:', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            [receiver-name], [webinar-title], [webinar-link], [webinar-date], [webinar-time]
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="24hrb4"><?php _e('Content', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <?php
                                            $meta = get_option('_wswebinar_24hrb4content');
                                            $content = apply_filters('meta_content', $meta);
                                            wp_editor($content, '_wswebinar_24hrb4content');
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <?php
                                        $posts = query_posts(array('post_type' => 'wswebinars'));
                                        if (!empty($posts)):
                                            ?>
                                            <td>
                                                <input type="email" class="regular-text preview-email-textbox" placeholder="<?php _e('Your email address', WebinarSysteem::$lang_slug) ?>" data-mail-type="_wswebinar_24hrb4"/>
                                                <input type="button" value="<?php _e('Send Preview', WebinarSysteem::$lang_slug) ?>" id="submit" class="button button-primary" data-mail-type="_wswebinar_24hrb4">
                                            </td>
                                        <?php else: ?>
                                            <td><?php _e('Add a Webinar to send a preview email.', WebinarSysteem::$lang_slug); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                                <div>
                                    <div class="optionpage-buttons-email">
                                        <a class="button optionspage-buttons-email-reset" href="<?php echo admin_url('edit.php?post_type=wswebinars&page=wswbn-options&reset=yes&setting=24hr'); ?>"><?php _e('Reset Default Template', WebinarSysteem::$lang_slug); ?></a>
                                    </div>
                                    <div class="optionpage-buttons-email">
                                        <?php submit_button(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="customTab" id="customTab4">
                                <h3><?php _e('Reminder one hour before Webinar ', WebinarSysteem::$lang_slug); ?></h3>

                                <table class="form-table">
                                    <tr>
                                        <th>
                                            <label for="1hrb4-enable"><?php _e('Enable this reminder?', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="1hrb4-enable" type="checkbox" name="_wswebinar_1hrb4enable" <?php echo (get_option('_wswebinar_1hrb4enable') == 'on' ? 'checked' : ''); ?>/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="1hrb4subject"><?php _e('Subject', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="1hrb4subject" class="regular-text" name="_wswebinar_1hrb4subject"  placeholder="<?php _e('Email Head', WebinarSysteem::$lang_slug) ?>" value="<?php echo get_option('_wswebinar_1hrb4subject'); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label><?php _e('Available Shortcodes:', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            [receiver-name], [webinar-title], [webinar-link], [webinar-date], [webinar-time]
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="1hrb4"><?php _e('Content', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <?php
                                            $meta = get_option('_wswebinar_1hrb4content');
                                            $content = apply_filters('meta_content', $meta);
                                            wp_editor($content, '_wswebinar_1hrb4content');
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <?php if (!empty($posts)): ?>
                                            <td>
                                                <input class="regular-text preview-email-textbox" placeholder="<?php _e('Your email address', WebinarSysteem::$lang_slug) ?>" data-mail-type="_wswebinar_1hrb4" type="email" />
                                                <input type="button" value="<?php _e('Send Preview', WebinarSysteem::$lang_slug) ?>" id="submit" class="button button-primary" data-mail-type="_wswebinar_1hrb4">
                                            </td>
                                        <?php else: ?>
                                            <td><?php _e('Add a Webinar to send a preview email.', WebinarSysteem::$lang_slug); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                                <div>
                                    <div class="optionpage-buttons-email">
                                        <a class="button optionspage-buttons-email-reset" href="<?php echo admin_url('edit.php?post_type=wswebinars&page=wswbn-options&reset=yes&setting=1hr'); ?>"><?php _e('Reset Default Template', WebinarSysteem::$lang_slug); ?></a>
                                    </div>
                                    <div class="optionpage-buttons-email">
                                        <?php submit_button(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="customTab" id="customTab5">
                                <h3><?php _e('Reminder when Webinar starts', WebinarSysteem::$lang_slug); ?></h3>
                                <table class="form-table">  
                                    <tr>
                                        <th>
                                            <label for="wbnstartedenable"><?php _e('Enable this reminder?', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="wbnstartedenable" name="_wswebinar_wbnstartedenable" type="checkbox" <?php echo (get_option('_wswebinar_wbnstartedenable') == 'on' ? 'checked' : ''); ?>/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="wbnstartedsubject"><?php _e('Subject', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="wbnstartedsubject" class="regular-text" name="_wswebinar_wbnstartedsubject" placeholder="<?php _e('Email Head', WebinarSysteem::$lang_slug) ?>" value="<?php echo get_option('_wswebinar_wbnstartedsubject'); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label><?php _e('Available Shortcodes:', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            [receiver-name], [webinar-title], [webinar-link], [webinar-date], [webinar-time]
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="24hrb4"><?php _e('Content', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <?php
                                            $meta = get_option('_wswebinar_wbnstarted');
                                            $content = apply_filters('meta_content', $meta);
                                            wp_editor($content, '_wswebinar_wbnstarted');
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <?php if (!empty($posts)): ?>
                                            <td>
                                                <input class="regular-text preview-email-textbox" placeholder="<?php _e('Your email address', WebinarSysteem::$lang_slug) ?>" data-mail-type="_wswebinar_wbnstarted" type="email" />
                                                <input type="button" value="<?php _e('Send Preview', WebinarSysteem::$lang_slug) ?>" id="submit" class="button button-primary" data-mail-type="_wswebinar_wbnstarted">
                                            </td>
                                        <?php else: ?>
                                            <td><?php _e('Add a Webinar to send a preview email.', WebinarSysteem::$lang_slug); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                                <div>
                                    <div class="optionpage-buttons-email">
                                        <a class="button optionspage-buttons-email-reset" href="<?php echo admin_url('edit.php?post_type=wswebinars&page=wswbn-options&reset=yes&setting=started'); ?>"><?php _e('Reset Default Template', WebinarSysteem::$lang_slug); ?></a>
                                    </div>
                                    <div class="optionpage-buttons-email">
                                        <?php submit_button(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="customTab" id="customTab6">
                                <h3><?php _e('Send Webinar Replay Link', WebinarSysteem::$lang_slug); ?></h3>
                                <table class="form-table">
                                    <tr>
                                        <th>
                                            <label for="wbnreplay-enable"><?php _e('Enable this reminder?', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="wbnreplay-enable" type="checkbox" name="_wswebinar_wbnreplayenable" <?php echo (get_option('_wswebinar_wbnreplayenable') == 'on' ? 'checked' : ''); ?>/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="wbnreplaysubject"><?php _e('Subject', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <input id="wbnreplaysubject" class="regular-text" name="_wswebinar_wbnreplaysubject" placeholder="<?php _e('Email Head', WebinarSysteem::$lang_slug) ?>" value="<?php echo get_option('_wswebinar_wbnreplaysubject'); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label><?php _e('Available Shortcodes:', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            [receiver-name], [webinar-title], [webinar-link], [webinar-date], [webinar-time]
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="24hrb4"><?php _e('Content', WebinarSysteem::$lang_slug); ?></label>
                                        </th>
                                        <td>
                                            <?php
                                            $meta = get_option('_wswebinar_wbnreplay');
                                            $content = apply_filters('meta_content', $meta);
                                            wp_editor($content, '_wswebinar_wbnreplay');
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <?php if (!empty($posts)): ?>
                                            <td>
                                                <input class="regular-text preview-email-textbox" placeholder="<?php _e('Your email address', WebinarSysteem::$lang_slug) ?>" data-mail-type="_wswebinar_wbnreplay" type="email" />
                                                <input type="button" value="<?php _e('Send Preview', WebinarSysteem::$lang_slug) ?>" id="submit" class="button button-primary" data-mail-type="_wswebinar_wbnreplay">
                                            </td>
                                        <?php else: ?>
                                            <td><?php _e('Add a Webinar to send a preview email.', WebinarSysteem::$lang_slug); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                                <div>
                                    <div class="optionpage-buttons-email">
                                        <a class="button optionspage-buttons-email-reset" href="<?php echo admin_url('edit.php?post_type=wswebinars&page=wswbn-options&reset=yes&setting=replay'); ?>"><?php _e('Reset Default Template', WebinarSysteem::$lang_slug); ?></a>
                                    </div>
                                    <div class="optionpage-buttons-email">
                                        <?php submit_button(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   

                    <!--
                    System Status tab
                    -->
                    <div id="tabs-4">
                        <div class="customTab">
                            <div class="webinar_systeem_sys_report_box">
                                <p class="webinar_systeem_sys_report_box_para"><?php _e( 'Please copy and paste this information in your ticket when contacting support:', 'woocommerce') ; ?> </p>
                                <div id="debug-report" >
                                    <textarea readonly="readonly" style="display: none;" class="webinar_systeem_sys_report_textarea" ></textarea>
                                    <button type="button" class="button-primary webinar_systeem_sys_report_copy_btn" style="display: none;" href="#" ><?php _e( 'Copy for Support', WebinarSysteem::$lang_slug ); ?></button>
                                    <span style="display: none;" class="webinar_systeem_sys_report_copy_status" ><strong><?php _e( 'Copied!', WebinarSysteem::$lang_slug ); ?></strong></span>
                                </div>
                                <button class="button-primary webinar_debug_report" type="button"><?php _e( 'Get System Report', WebinarSysteem::$lang_slug ); ?></button>

                        </div>
                        </div>
                        
                        <div class="customTab">
                            <h3><?php _e('WordPress Environment', WebinarSysteem::$lang_slug); ?></h3>                        
                            <table class="form-table">
                                <tr data-info='WordPress Environment'>
                                    <th>
                                        <?php _e('Home URL', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                        <?php echo get_home_url(); ?>
                                    </td>
                                </tr>
                                <tr data-info='WordPress Environment'>
                                    <th>
                                        <?php _e('Site URL', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                        <?php echo get_site_url(); ?>
                                    </td>
                                </tr>
                                <tr data-info='WordPress Environment'>
                                    <th>
                                        <?php _e('WP Version', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                       <?php bloginfo('version'); ?>
                                    </td>
                                </tr>
                                <tr data-info='WordPress Environment'>
                                    <th><?php  _e('WP Multisite', WebinarSysteem::$lang_slug); ?></th>
                                    <td><?php if ( is_multisite() ) { echo 'Enabled'; }else{  echo 'Disabled'; } ?> </td>
                                </tr>
                                <tr data-info='WordPress Environment'>
                                    <th><?php  _e('WP Debug mode', WebinarSysteem::$lang_slug); ?></th>
                                    <td><?php if ( defined('WP_DEBUG') && WP_DEBUG ) echo 'Enabled'; else echo 'Disabled'; ?></td>
                                </tr>
                                <tr data-info='WordPress Environment'>
                                    <th><?php  _e('Language', WebinarSysteem::$lang_slug); ?></th>
                                    <td><?php echo get_locale() ?></td>
                                </tr>
                                
                            </table>
                        </div>
                        
                        <div class="customTab">
                            <h3><?php _e('Server Environment', WebinarSysteem::$lang_slug); ?></h3>                        
                            <table class="form-table">
                                <tr data-info='Server Environment'>
                                    <th>
                                        <?php _e('Server Info', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                        <?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?>
                                    </td>
                                </tr>
                                <tr data-info='Server Environment'>
                                    <th>
                                        <?php _e('PHP Version', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                        <?php
				// Check if phpversion function exists
				if ( function_exists( 'phpversion' ) ) {
					$php_version = phpversion();
                                            echo esc_html( $php_version );
				} else {
					_e( "Couldn't determine PHP version because phpversion() doesn't exist.", WebinarSysteem::$lang_slug);
				}
				?>
                                    </td>
                                </tr>
                                
                                <tr data-info='Server Environment'>
                                    <th>
                                        <?php _e('PHP Post Max Size', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                       <?php echo  ini_get('post_max_size'); ?>
                                    </td>
                                </tr>
                                <tr data-info='Server Environment'>
                                    <th>
                                         <?php _e('PHP Time Limit', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                        <?php echo ini_get('max_execution_time').' Seconds';  ?>
                                    </td>
                                </tr>
                                <tr data-info='Server Environment'>
                                    <th>
                                        <?php _e('PHP Max Input Vars', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                         <?php echo ini_get('max_input_vars');  ?>
                                    </td>
                                </tr>
                                <tr data-info='Server Environment'>
                                    <th>
                                         <?php _e('SUHOSIN Installed', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                        <?php echo extension_loaded( 'suhosin' ) ? 'Installed' : 'Not Installed'; ?>
                                    </td>
                                </tr>
                                <tr data-info='Server Environment'>
                                    <th>
                                         <?php _e('MySQL Version', WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                        <?php global $wpdb; echo $wpdb->db_version(); ?>
                                    </td>
                                </tr>
                                <tr data-info='Server Environment'>
                                    <th>
                                        <?php _e('Max Upload Size' , WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                        <?php echo size_format( wp_max_upload_size() ); ?>
                                    </td>
                                </tr>
                                <tr data-info='Server Environment'>
                                    <th>
                                        <?php _e('Default Timezone' , WebinarSysteem::$lang_slug); ?>
                                    </th>
                                    <td>
                                       <?php
                                        $default_timezone = date_default_timezone_get();
					echo $default_timezone;
                                        ?>
                                    </td>
                                </tr>
                                
                                <?php
			$posting = array();

			// fsockopen/cURL
			$posting['fsockopen_curl']['name'] = 'fsockopen/cURL';
			
			if ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) {
				$posting['fsockopen_curl']['success'] = true;
			} else {
				$posting['fsockopen_curl']['success'] = false;
			}

			// SOAP
			$posting['soap_client']['name'] = 'SoapClient';
			
			if ( class_exists( 'SoapClient' ) ) {
				$posting['soap_client']['success'] = true;
			} else {
				$posting['soap_client']['success'] = false;
			}

			// DOMDocument
			$posting['dom_document']['name'] = 'DOMDocument';
			
			if ( class_exists( 'DOMDocument' ) ) {
				$posting['dom_document']['success'] = true;
			} else {
				$posting['dom_document']['success'] = false;
			}

			$posting['gzip']['name'] = 'GZip';
			if ( is_callable( 'gzopen' ) ) {
				$posting['gzip']['success'] = true;
			} else {
				$posting['gzip']['success'] = false;
			}

                                foreach ( $posting as $post ) {
				$mark = ! empty( $post['success'] ) ? 'Enabled' : 'Disabled';
				?>
				<tr data-info='Server Environment'>
					<th><?php echo esc_html( $post['name'] ); ?></th>
					<td>
						<?php _e($mark, WebinarSysteem::$lang_slug); ?>
					</td>
				</tr>
				<?php } ?>
                            </table>
                        </div>
                        
                        <div class="customTab">
                            <h3><?php _e('Server Locale', WebinarSysteem::$lang_slug); ?></h3>                        
                            <table class="form-table">
                                
                        <?php
			$locale = localeconv();
			foreach ( $locale as $key => $val ) {
				if ( in_array( $key, array( 'decimal_point', 'mon_decimal_point', 'thousands_sep', 'mon_thousands_sep' ) ) ) {
					echo '<tr data-info="Server Locale" ><th>' . $key . '</th><td>' . ( $val ? $val : __( 'N/A', WebinarSysteem::$lang_slug ) ) . '</td></tr>';
				}
			}
                         ?>
                                
                            </table>
                        </div>
                        
                        <div class="customTab">
                            <h3><?php _e('Active Plugins('.count( (array) get_option( 'active_plugins' ) ).')', WebinarSysteem::$lang_slug); ?></h3>
                            <table class="form-table">
                                <?php
                                    $active_plugins = (array) get_option( 'active_plugins', array() );
                                    if ( is_multisite() ) {
                                    $active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
                                    }

                                    foreach ( $active_plugins as $plugin ) {
                                    $plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
                                    $version_string = '';
                                    $network_string = '';

			if ( ! empty( $plugin_data['Name'] ) ) {
                            $plugin_name = esc_html( $plugin_data['Name'] ); ?>
				<tr data-info="Active Plugins" data-has-a="true">
					<th><?php echo $plugin_name; ?></th>
					<td><?php echo _e( 'by ', WebinarSysteem::$lang_slug ). $plugin_data['Author'] . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
				</tr>
				<?php
                            } } ?>
                            </table>
                        </div>
                        
                        <div class="customTab">
                            <h3><?php _e('Theme', WebinarSysteem::$lang_slug); ?></h3>   
                            <?php $active_theme = wp_get_theme(); ?>
                            <table class="form-table">
                                <tr data-info="Theme">
                                    <th><?php _e( 'Name', WebinarSysteem::$lang_slug ); ?>:</th>
                                    <td><?php echo $active_theme->Name; ?></td>
                                </tr>
                                <tr data-info="Theme">
                                    <th><?php _e( 'Version', WebinarSysteem::$lang_slug ); ?>:</th>
                                    <td><?php echo $active_theme->Version; ?></td>
                                </tr>
                                <tr data-info="Theme">
                                    <th><?php _e( 'Author URL', WebinarSysteem::$lang_slug ); ?>:</th>
                                    <td><?php echo $active_theme->{'Author URI'}; ?></td>
                                </tr>
                                
                            </table>
                        </div>
                        
                    </div>
                    <!-- End of system status tab -->

                </div>
            </form>
        </div>
        <!--jQuery stuff to handle above tabs-->
        <script>
            jQuery(function () {
                jQuery("#tabs").tabs();
                // jQuery("#tabs2").tabs();
                customTabs(jQuery('.wswebinarCustomTab'));
            });

            function customTabs(mainObj) {
                jQuery(mainObj).find('div.customTab').hide();
                jQuery(mainObj).find('div.customTab').first().show();
                jQuery('.tabHeaders a').first().addClass('customTabActive');
                jQuery('.tabset').first().addClass('customTabActive');
                jQuery(document).ready(function () {
                    jQuery("div").removeClass("ui-widget-content");
                });
                jQuery(document).on('click', '.tabHeaders a', function (event) {
                    jQuery('.tabHeaders a').removeClass('customTabActive');
                    var theAhref = jQuery(this).attr('href');
                    jQuery(mainObj).find('div.customTab').hide();
                    jQuery('' + theAhref).show();
                    jQuery(this).addClass('customTabActive');
                    event.preventDefault();
                });
                jQuery(document).on('click', '.tabset', function (event) {
                    jQuery('.tabset').removeClass('customTabActive');
                    var theAhref = jQuery(this).attr('href');
                    jQuery(mainObj).find('div.tabset').hide();
                    jQuery('' + theAhref).show();
                    jQuery(this).addClass('customTabActive');
                    event.preventDefault();
                });
            }

            /*
             * Check enormail API key
             */


        </script>
        <?php
    }

    public static function DoResetDefaults($setting = NULL) {
        $template = WebinarSysteem::getDefaultMailTemplates();
        if ($setting == NULL) {
            update_option('_wswebinar_email_headerImg', plugins_url('images/WebinarSysteem-logo.png', __FILE__));
            update_option('_wswebinar_email_baseCLR', '#fff');
            update_option('_wswebinar_email_bckCLR', '#f2f2f2');
            update_option('_wswebinar_email_bodyBck', '#fff');
            update_option('_wswebinar_email_bodyTXT', 'black');
            update_option('_wswebinar_email_footerTxt', '');
        } elseif ($setting == "1hr") {
            update_option(WebinarSysteem::$lang_slug . '_1hrb4content', $template['1hr']);
        } elseif ($setting == "24hr") {
            update_option(WebinarSysteem::$lang_slug . '_24hrb4content', $template['24hr']);
        } elseif ($setting == "started") {
            update_option(WebinarSysteem::$lang_slug . '_wbnstarted', $template['started']);
        } elseif ($setting == "replay") {
            update_option(WebinarSysteem::$lang_slug . '_wbnreplay', $template['replay']);
        }
    }

}
