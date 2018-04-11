<?php
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'details') {
    $order_info = fn_get_order_info($_REQUEST['order_id']);
    $shipments = $order_info['product_groups'][0];
    $shipping_id = $shipments['chosen_shippings'][0]['shipping_id'];
    $order_date = date('Y-m-d', $order_info['timestamp']);

    $estimate = fn_mbc_delivery_estimate_calculate($shipping_id, $order_date);

    $delivery_estimate = array(
        'estimate' => $estimate,
        'order_date' => $order_date,
        'timestamp' => $order_info['timestamp'],
    );

    Registry::get('view')->assign('delivery_estimate', $delivery_estimate);
}
