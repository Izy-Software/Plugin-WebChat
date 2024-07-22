<?php

class WebChat_Scripts
{

    public static function add_script_to_footer()
    {
        $script = get_option('webchat_script');
        if (!empty($script)) {
            echo $script;
        } else {
            $company = get_option('webchat_company');
            $channel = get_option('webchat_channel');
            $sound = get_option('webchat_sound');
            $header_color = get_option('webchat_header_color');
            $header_icon = get_option('webchat_header_icon');
            $title = get_option('webchat_title');
            $footer_text = get_option('webchat_footer_text');

            if ($company && $channel) {
                echo "
                <script>
                    window.chatCompany = '$company';
                    window.chatChannel = '$channel';
                    window.chatNotificationSound = '$sound';
                    window.chatHeaderColor = '$header_color';
                    window.chatHeaderIcon = '$header_icon';
                    window.chatTitle = '$title';
                    window.chatFooterText = '$footer_text';
                </script>
                <script src='https://hub.notificame.com.br/schedule/webchat.js'></script>";
            }
        }
    }
}

add_action('wp_footer', ['WebChat_Scripts', 'add_script_to_footer']);
