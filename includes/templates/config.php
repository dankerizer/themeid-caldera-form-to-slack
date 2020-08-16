<?php
/**
 * Created by PhpStorm.
 * Project :  caladea-slack.
 * User: hadie MacBook
 * Date: 24/07/20
 * Time: 06.48
 */
echo \Caldera_Forms_Processor_UI::config_fields(Caladea_Slack_Caldera::fields());
?>



<div class="caldera-config-group">
    <label for="caladea_slack_message_{{_id}}"><?php esc_html_e('Message Text', 'caladea'); ?></label>
    <div class="caldera-config-field">
        <textarea
                type="text"
                id="caladea_slack_message_{{_id}}"
                name="{{_name}}[_message]"
               required
                class="block-input field-config magic-tag-enabled required"
        >{{_message}}</textarea>
    </div>
    <p class="description"><?php esc_html_e('The message that gets sent to Slack.', 'caladea_slack'); ?></p>
</div>

