<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Perfex Calls
Description: This module allows the ability to track phone calls for each customer
Version: 1.0.0
Author: Granulr Ltd
Author URI: https://granulr.uk
Requires at least: 2.3.*
*/

define('PERFEX_CALLS', 'perfex_calls');


/**
* Set Up Our Integration Hooks
*/
hooks()->add_action('admin_init', 'perfex_calls_init_menu_items'); // Add Client Menu Item
hooks()->add_action('admin_init', 'perfex_calls_permissions'); // Add Admin Permissions


/**
* Register activation module hook
* @return null
*/
register_activation_hook(PERFEX_CALLS, 'perfex_calls_module_activation_hook');

function perfex_calls_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
* Register language files, must be registered if the module is using languages
*/
register_language_files(PERFEX_CALLS, [PERFEX_CALLS]);


/**
 * Init contact book module menu items in setup in admin_init hook
 * @return null
 */
function perfex_calls_init_menu_items()
{
    $CI = &get_instance();

    // Add Calls to Client Tab Group
    if (has_permission('perfex_calls', '', 'view')) {
        $CI->app_tabs->add_customer_profile_tab('perfex_calls', [
            'name'     => _l('perfex_calls'),
            'icon'     => 'fa fa-phone',
            'view'     => PERFEX_CALLS . '/clients/groups/perfex_calls',
            //'visible'  => (has_permission('perfex_calls', '', 'view') || has_permission('perfex_calls', '', 'view_own')),
            'position' => 16,
            /*'badge'    => [
                    'value' => '100',
                    'color' => '',
                    'type'  => 'bg-default',
                ],*/
        ]);
    }

}


/**
 * Set up user permissions to access feature_request feature
 * @return null
 */
function perfex_calls_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
            'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
            'create' => _l('permission_create'),
            'edit'   => _l('permission_edit'),
            'delete' => _l('permission_delete'),
    ];

    register_staff_capabilities('perfex_calls', $capabilities, _l('perfex_calls'));
}
