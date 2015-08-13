<div class="wswebinarStatusPanel">
    <?php $saved_status = get_post_meta($post->ID, '_wswebinar_gener_webinar_status', true); ?>
    <ul>
        <li class="<?php echo $this->decideClassOfStatusButtons("cou", $saved_status); ?>" status="cou">Countdown</li>
        <li class="<?php echo $this->decideClassOfStatusButtons("liv", $saved_status); ?>" status="liv">Live</li>
        <li class="<?php echo $this->decideClassOfStatusButtons("rep", $saved_status); ?>" status="rep">Replay</li>
        <li class="<?php echo $this->decideClassOfStatusButtons("clo", $saved_status); ?>" status="clo">Closed</li>
    </ul>            
    <input type="hidden" name="gener_webinar_status" id="gener_webinar_status" value="<?php echo $saved_status; ?>">
    <script>
        jQuery(document).on('click', '.wswebinarStatusPanel li', function () {
            if (jQuery(this).hasClass('disabled'))
                return;
            jQuery('.wswebinarStatusPanel li').removeClass('disabled active');
            jQuery(this).addClass('disabled active');
            jQuery('#gener_webinar_status').val(jQuery(this).attr('status'));
        });
    </script>
</div>
<div class="form-field">
    <label for="gener_date"><?php _e('Webinar starts at', WebinarSysteem::$lang_slug); ?></label>
    <input type="text" name="gener_date" id="gener_date" placeholder="<?php _e('Date', WebinarSysteem::$lang_slug) ?>" value="<?php echo get_post_meta($post->ID, '_wswebinar_gener_date', true); ?>">
    <div class="date_line_sep">@</div>
    <select class="alignleft" name="gener_hour">                
        <?php
        for ($i = 0; $i < 24; $i++):
            ?>
            <option <?php
            $theHour = get_post_meta($post->ID, '_wswebinar_gener_hour', true);
            echo!empty($theHour) && $theHour == $i ? 'selected="selected"' : ''
            ?>><?php echo sprintf("%02s", $i) ?></option>
            <?php endfor; ?>
    </select>
    <div class="date_line_sep">:</div>
    <select class="alignleft" name="gener_min">                
        <?php
        for ($j = 0; $j < 60; $j++):
            ?>
            <?php if ($j % 5 == 0): ?>
                <option <?php
                $theMin = get_post_meta($post->ID, '_wswebinar_gener_min', true);
                echo!empty($theMin) && $theMin == $j ? 'selected="selected"' : ''
                ?>><?php echo sprintf("%02s", $j) ?></option>
                <?php endif; ?>
            <?php endfor; ?>
    </select>
    <script>
        jQuery(function () {
            jQuery("#gener_date").datepicker({
                beforeShow: function () {
                    jQuery(this).datepicker("widget").wrap("<div class='wswebinar-ui-theme'></div>");
                },
                dateFormat: "yy-mm-dd"
            });
        });
    </script>            
    <div class="webinar_clear_fix"></div>
</div>   


<div class="form-field">
    <?php
    $_wswebinar_gener_duration = get_post_meta($post->ID, '_wswebinar_gener_duration', true);
    if (empty($_wswebinar_gener_duration))
        $_wswebinar_gener_duration = 3600;
    $_wswebinar_gener_duration = floatval($_wswebinar_gener_duration);
    ?>
    <label>Webinar Duration</label>
    <select name="gener_duration">
        <?php for ($rr = 600; $rr < 18000; $rr+=600): ?>
            <option value="<?php echo $rr; ?>" <?php echo $rr == $_wswebinar_gener_duration ? 'selected="selected"' : '' ?> ><?php echo $rr > 3590 ? date("H", $rr) . 'h' : ''; ?> <?php echo date("i", $rr); ?>min</option>
<?php endfor; ?>
    </select>
    <div class="webinar_clear_fix"></div>
</div>



<div class="form-group">
    <label for="gener_regdisabled_yn"><?php _e('Disable registration', WebinarSysteem::$lang_slug); ?></label>
<?php $gener_regdisabled_yn_value = get_post_meta($post->ID, '_wswebinar_gener_regdisabled_yn', true); ?>
    <input type="checkbox" name="gener_regdisabled_yn" id="gener_regdisabled_yn" value="yes" <?php echo ($gener_regdisabled_yn_value == "yes" ) ? 'checked="checked"' : ''; ?> >
    <div class="webinar_clear_fix"></div>
</div>
