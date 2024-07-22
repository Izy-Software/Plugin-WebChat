<?php
/*
Plugin Name: WebChat
Description: Plugin para configurar a conexão de WebChat da plataforma Izy Software através do painel administrativo do WordPress.
Version: 1.0.1
Author: Izy Software
Author URI: https://izysoftware.com
*/

// Prevenir acesso direto
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes
define('WEBCHAT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WEBCHAT_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Incluir arquivos necessários
require_once WEBCHAT_PLUGIN_DIR . 'includes/webchat-scripts.php';
require_once WEBCHAT_PLUGIN_DIR . 'admin/webchat-admin.php';

// Inicializar o plugin
function webchat_init() {
    WebChat_Admin::init();
}
add_action('init', 'webchat_init');

// Gancho de ativação para redirecionar após ativação
function webchat_activate() {
    // Definir uma opção para indicar que o plugin foi ativado
    add_option('webchat_plugin_activated', true);
}
register_activation_hook(__FILE__, 'webchat_activate');

// Redirecionar para a página de configurações após a ativação
function webchat_redirect_after_activation() {
    if (get_option('webchat_plugin_activated', false)) {
        delete_option('webchat_plugin_activated');
        wp_redirect(admin_url('admin.php?page=webchat-config'));
        exit;
    }
}
add_action('admin_init', 'webchat_redirect_after_activation');
