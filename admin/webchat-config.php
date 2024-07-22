<?php

// Prevenir acesso direto
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes
if (!defined('WEBCHAT_PLUGIN_URL')) {
    define('WEBCHAT_PLUGIN_URL', plugin_dir_url(__FILE__));
}
if (!defined('WEBCHAT_PLUGIN_DIR')) {
    define('WEBCHAT_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

// Incluir arquivos necessários
require_once WEBCHAT_PLUGIN_DIR . 'includes/webchat-scripts.php';
require_once WEBCHAT_PLUGIN_DIR . 'admin/webchat-admin.php';

// Inicializar o plugin
function conf_webchat_init()
{
    WebChat_Admin::init();
}

add_action('init', 'conf_webchat_init');

// Gancho de ativação para redirecionar após ativação
function conf_webchat_activate()
{
    // Definir uma opção para indicar que o plugin foi ativado
    add_option('custom_webchat_plugin_activated', true);
}

register_activation_hook(__FILE__, 'conf_webchat_activate');

// Redirecionar para a página de configurações após a ativação
function custom_webchat_redirect_after_activation()
{
    if (get_option('custom_webchat_plugin_activated', false)) {
        delete_option('custom_webchat_plugin_activated');
        wp_redirect(admin_url('admin.php?page=webchat-config'));
        exit;
    }
}

add_action('admin_init', 'custom_webchat_redirect_after_activation');
