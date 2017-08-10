<?php
// -----------------------------------------------------------------------------
// Estimate Shipping Time
// 2017 © MADBIT Co.
// -----------------------------------------------------------------------------

if ( !defined('BOOTSTRAP') ) { die('Access denied'); }

use Tygh\Registry;

if ($mode == 'update' && $_REQUEST['shipping_id'] > 0)
{
    $settings = Registry::get('addons.mbc_delivery_estimate');

    Registry::set('navigation.tabs.delivery', array (
    'title' => __('delivery'),
    'js' => true
    ));

    $delivery_data = db_get_row('SELECT * FROM ?:mbc_delivery_estimate WHERE shipping_id=?i', $_REQUEST['shipping_id']);
    $delivery_data['shipping_id'] = $_REQUEST['shipping_id'];

    Registry::get('view')->assign('delivery_data', $delivery_data);
    Registry::get('view')->assign('estimate_settings', $settings);
}
