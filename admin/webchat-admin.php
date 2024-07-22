<?php

require_once WEBCHAT_PLUGIN_DIR . 'admin/webchat-config.php';
require_once WEBCHAT_PLUGIN_DIR . 'admin/webchat-fields.php';

class WebChat_Admin
{

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
    }

    public static function add_menu()
    {
        add_menu_page(
            'Configurar WebChat',
            'Configurar WebChat',
            'manage_options',
            'webchat-config',
            [__CLASS__, 'settings_page'],
            'dashicons-format-chat',
            90
        );
    }

    public static function settings_page()
    {
        ?>
        <div class="wrap">
            <h1>Configurar WebChat</h1>
            <p>Por favor, pegue o script com o seu revendedor e cole no campo abaixo:</p>
            <?php settings_errors(); ?>
            <form method="post" action="options.php">
                <?php
                settings_fields('webchat_options_group');
                do_settings_sections('webchat-config');
                submit_button();
                ?>
            </form>
            <button id="advanced-settings-button" class="button">Avançado</button>
            <div id="advanced-settings" style="display: none;">
                <form method="post" action="options.php">
                    <?php
                    settings_fields('webchat_advanced_options_group');
                    do_settings_sections('webchat-advanced-config');
                    submit_button();
                    ?>
                </form>
            </div>
            <hr>
            <a href="https://izysoftware.com" class="button button-primary" target="_blank">Visite a Izy Software</a>
        </div>
        <script>
            document.getElementById('advanced-settings-button').addEventListener('click', function () {
                var advancedSettings = document.getElementById('advanced-settings');
                if (advancedSettings.style.display === 'none') {
                    advancedSettings.style.display = 'block';
                } else {
                    advancedSettings.style.display = 'none';
                }
            });
        </script>
        <?php
    }

    public static function register_settings()
    {
        register_setting('webchat_options_group', 'webchat_script', [
            'sanitize_callback' => [__CLASS__, 'update_advanced_fields'],
            'type' => 'string',
            'show_in_rest' => true,
        ]);

        add_settings_section('webchat_section', 'Configurações do WebChat', null, 'webchat-config');

        add_settings_field(
            'webchat_script_field',
            'Script do WebChat',
            ['WebChat_Fields', 'script_field_callback'],
            'webchat-config',
            'webchat_section'
        );

        register_setting('webchat_advanced_options_group', 'webchat_company');
        register_setting('webchat_advanced_options_group', 'webchat_channel');
        register_setting('webchat_advanced_options_group', 'webchat_sound');
        register_setting('webchat_advanced_options_group', 'webchat_header_color');
        register_setting('webchat_advanced_options_group', 'webchat_header_icon');
        register_setting('webchat_advanced_options_group', 'webchat_title');
        register_setting('webchat_advanced_options_group', 'webchat_footer_text');

        add_settings_section('webchat_advanced_section', 'Configurações Avançadas do WebChat', null, 'webchat-advanced-config');

        add_settings_field(
            'webchat_company_field',
            'Company ID',
            ['WebChat_Fields', 'company_field_callback'],
            'webchat-advanced-config',
            'webchat_advanced_section'
        );

        add_settings_field(
            'webchat_channel_field',
            'Channel ID',
            ['WebChat_Fields', 'channel_field_callback'],
            'webchat-advanced-config',
            'webchat_advanced_section'
        );

        add_settings_field(
            'webchat_sound_field',
            'Notification Sound URL',
            ['WebChat_Fields', 'sound_field_callback'],
            'webchat-advanced-config',
            'webchat_advanced_section'
        );

        add_settings_field(
            'webchat_header_color_field',
            'Header Color',
            ['WebChat_Fields', 'header_color_field_callback'],
            'webchat-advanced-config',
            'webchat_advanced_section'
        );

        add_settings_field(
            'webchat_header_icon_field',
            'Header Icon URL',
            ['WebChat_Fields', 'header_icon_field_callback'],
            'webchat-advanced-config',
            'webchat_advanced_section'
        );

        add_settings_field(
            'webchat_title_field',
            'Chat Title',
            ['WebChat_Fields', 'title_field_callback'],
            'webchat-advanced-config',
            'webchat_advanced_section'
        );

        add_settings_field(
            'webchat_footer_text_field',
            'Footer Text',
            ['WebChat_Fields', 'footer_text_field_callback'],
            'webchat-advanced-config',
            'webchat_advanced_section'
        );
    }

    public static function update_advanced_fields($script)
    {
        if (preg_match('/window\.chatCompany\s*=\s*[\'"]([^\'"]+)[\'"]/', $script, $matches)) {
            update_option('webchat_company', $matches[1]);
        }
        if (preg_match('/window\.chatChannel\s*=\s*[\'"]([^\'"]+)[\'"]/', $script, $matches)) {
            update_option('webchat_channel', $matches[1]);
        }
        if (preg_match('/window\.chatNotificationSound\s*=\s*[\'"]([^\'"]+)[\'"]/', $script, $matches)) {
            update_option('webchat_sound', $matches[1]);
        }
        if (preg_match('/window\.chatHeaderColor\s*=\s*[\'"]([^\'"]+)[\'"]/', $script, $matches)) {
            update_option('webchat_header_color', $matches[1]);
        }
        if (preg_match('/window\.chatHeaderIcon\s*=\s*[\'"]([^\'"]+)[\'"]/', $script, $matches)) {
            update_option('webchat_header_icon', $matches[1]);
        }
        if (preg_match('/window\.chatTitle\s*=\s*[\'"]([^\'"]+)[\'"]/', $script, $matches)) {
            update_option('webchat_title', $matches[1]);
        }
        if (preg_match('/window\.chatFooterText\s*=\s*[\'"]([^\'"]+)[\'"]/', $script, $matches)) {
            update_option('webchat_footer_text', $matches[1]);
        }

        add_settings_error(
            'webchat_messages',
            'webchat_message',
            __('Configurações salvas.', 'webchat'),
            'updated'
        );

        return $script;
    }
}
