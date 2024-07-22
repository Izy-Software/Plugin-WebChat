<?php
/*
Plugin Name: Custom WebChat Config
Description: Plugin para configurar o WebChat através do painel administrativo do WordPress.
Version: 1.0
Author: Seu Nome
*/

// Prevenir acesso direto
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes
define('CUSTOM_WEBCHAT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CUSTOM_WEBCHAT_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Função para adicionar o menu
function custom_webchat_add_menu()
{
    add_menu_page(
        'Configurar WebChat',
        'Configurar WebChat',
        'manage_options',
        'custom-webchat-config',
        'custom_webchat_settings_page',
        'dashicons-format-chat',
        90
    );
}
add_action('admin_menu', 'custom_webchat_add_menu');

// Função para exibir a página de configurações
function custom_webchat_settings_page()
{
?>
    <div class="wrap">
        <h1>Configurar WebChat</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('custom_webchat_options_group');
            do_settings_sections('custom-webchat-config');
            submit_button();
            ?>
        </form>
        <button id="advanced-settings-button" class="button">Avançado</button>
        <div id="advanced-settings" style="display: none;">
            <form method="post" action="options.php">
                <?php
                settings_fields('custom_webchat_advanced_options_group');
                do_settings_sections('custom-webchat-advanced-config');
                submit_button();
                ?>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('advanced-settings-button').addEventListener('click', function() {
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

// Função para registrar as configurações
function custom_webchat_register_settings()
{
    register_setting('custom_webchat_options_group', 'custom_webchat_script');

    add_settings_section('custom_webchat_section', 'Configurações do WebChat', null, 'custom-webchat-config');

    add_settings_field(
        'custom_webchat_script_field',
        'Script do WebChat',
        'custom_webchat_script_field_callback',
        'custom-webchat-config',
        'custom_webchat_section'
    );

    register_setting('custom_webchat_advanced_options_group', 'custom_webchat_company');
    register_setting('custom_webchat_advanced_options_group', 'custom_webchat_channel');
    register_setting('custom_webchat_advanced_options_group', 'custom_webchat_sound');
    register_setting('custom_webchat_advanced_options_group', 'custom_webchat_header_color');
    register_setting('custom_webchat_advanced_options_group', 'custom_webchat_header_icon');
    register_setting('custom_webchat_advanced_options_group', 'custom_webchat_title');
    register_setting('custom_webchat_advanced_options_group', 'custom_webchat_footer_text');

    add_settings_section('custom_webchat_advanced_section', 'Configurações Avançadas do WebChat', null, 'custom-webchat-advanced-config');

    add_settings_field(
        'custom_webchat_company_field',
        'Company ID',
        'custom_webchat_company_field_callback',
        'custom-webchat-advanced-config',
        'custom_webchat_advanced_section'
    );

    add_settings_field(
        'custom_webchat_channel_field',
        'Channel ID',
        'custom_webchat_channel_field_callback',
        'custom-webchat-advanced-config',
        'custom_webchat_advanced_section'
    );

    add_settings_field(
        'custom_webchat_sound_field',
        'Notification Sound URL',
        'custom_webchat_sound_field_callback',
        'custom-webchat-advanced-config',
        'custom_webchat_advanced_section'
    );

    add_settings_field(
        'custom_webchat_header_color_field',
        'Header Color',
        'custom_webchat_header_color_field_callback',
        'custom-webchat-advanced-config',
        'custom_webchat_advanced_section'
    );

    add_settings_field(
        'custom_webchat_header_icon_field',
        'Header Icon URL',
        'custom_webchat_header_icon_field_callback',
        'custom-webchat-advanced-config',
        'custom_webchat_advanced_section'
    );

    add_settings_field(
        'custom_webchat_title_field',
        'Chat Title',
        'custom_webchat_title_field_callback',
        'custom-webchat-advanced-config',
        'custom_webchat_advanced_section'
    );

    add_settings_field(
        'custom_webchat_footer_text_field',
        'Footer Text',
        'custom_webchat_footer_text_field_callback',
        'custom-webchat-advanced-config',
        'custom_webchat_advanced_section'
    );
}


function custom_webchat_script_field_callback()
{
    $script = get_option('custom_webchat_script');
    echo '<textarea name="custom_webchat_script" rows="10" cols="50" class="large-text code">' . esc_textarea($script) . '</textarea>';
}

function custom_webchat_company_field_callback()
{
    $value = get_option('custom_webchat_company');
    echo '<input type="text" name="custom_webchat_company" value="' . esc_attr($value) . '" class="regular-text">';
}

function custom_webchat_channel_field_callback()
{
    $value = get_option('custom_webchat_channel');
    echo '<input type="text" name="custom_webchat_channel" value="' . esc_attr($value) . '" class="regular-text">';
}

function custom_webchat_sound_field_callback()
{
    $value = get_option('custom_webchat_sound');
    echo '<input type="text" name="custom_webchat_sound" value="' . esc_attr($value) . '" class="regular-text">';
}

function custom_webchat_header_color_field_callback()
{
    $value = get_option('custom_webchat_header_color');
    echo '<input type="text" name="custom_webchat_header_color" value="' . esc_attr($value) . '" class="regular-text">';
}

function custom_webchat_header_icon_field_callback()
{
    $value = get_option('custom_webchat_header_icon');
    echo '<input type="text" name="custom_webchat_header_icon" value="' . esc_attr($value) . '" class="regular-text">';
}

function custom_webchat_title_field_callback()
{
    $value = get_option('custom_webchat_title');
    echo '<input type="text" name="custom_webchat_title" value="' . esc_attr($value) . '" class="regular-text">';
}

function custom_webchat_footer_text_field_callback()
{
    $value = get_option('custom_webchat_footer_text');
    echo '<input type="text" name="custom_webchat_footer_text" value="' . esc_attr($value) . '" class="regular-text">';
}

add_action('admin_init', 'custom_webchat_register_settings');

// Função para o campo de entrada
function custom_webchat_script_field_callback()
{
    $script = get_option('custom_webchat_script');
    echo '<textarea name="custom_webchat_script" rows="10" cols="50" class="large-text code">' . esc_textarea($script) . '</textarea>';
}

// Função para adicionar o script ao rodapé do site
function custom_webchat_add_script_to_footer()
{
    $script = get_option('custom_webchat_script');
    if (!empty($script)) {
        echo $script;
    } else {
        $company = get_option('custom_webchat_company');
        $channel = get_option('custom_webchat_channel');
        $sound = get_option('custom_webchat_sound');
        $header_color = get_option('custom_webchat_header_color');
        $header_icon = get_option('custom_webchat_header_icon');
        $title = get_option('custom_webchat_title');
        $footer_text = get_option('custom_webchat_footer_text');

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


add_action('wp_footer', 'custom_webchat_add_script_to_footer');
