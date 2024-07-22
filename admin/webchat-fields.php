<?php

class WebChat_Fields
{

    public static function script_field_callback()
    {
        $script = get_option('webchat_script');
        echo '<textarea name="webchat_script" rows="10" cols="50" class="large-text code">' . esc_textarea($script) . '</textarea>';
    }

    public static function company_field_callback()
    {
        $value = get_option('webchat_company');
        echo '<input type="text" name="webchat_company" value="' . esc_attr($value) . '" class="regular-text">';
    }

    public static function channel_field_callback()
    {
        $value = get_option('webchat_channel');
        echo '<input type="text" name="webchat_channel" value="' . esc_attr($value) . '" class="regular-text">';
    }

    public static function sound_field_callback()
    {
        $value = get_option('webchat_sound');
        echo '<input type="text" name="webchat_sound" value="' . esc_attr($value) . '" class="regular-text">';
    }

    public static function header_color_field_callback()
    {
        $value = get_option('webchat_header_color');
        echo '<input type="text" name="webchat_header_color" value="' . esc_attr($value) . '" class="regular-text">';
    }

    public static function header_icon_field_callback()
    {
        $value = get_option('webchat_header_icon');
        echo '<input type="text" name="webchat_header_icon" value="' . esc_attr($value) . '" class="regular-text">';
    }

    public static function title_field_callback()
    {
        $value = get_option('webchat_title');
        echo '<input type="text" name="webchat_title" value="' . esc_attr($value) . '" class="regular-text">';
    }

    public static function footer_text_field_callback()
    {
        $value = get_option('webchat_footer_text');
        echo '<input type="text" name="webchat_footer_text" value="' . esc_attr($value) . '" class="regular-text">';
    }
}
