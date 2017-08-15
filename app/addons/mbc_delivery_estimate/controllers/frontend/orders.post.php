<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Hook into order details page
if ($mode == 'details' && !empty($_REQUEST['order_id'])) {
  $order_info = fn_get_order_info($_REQUEST['order_id']);
  $shipments = $order_info['product_groups'][0];
  $shipping_id = $shipments['chosen_shippings'][0]['shipping_id'];
  $order_date = date('Y-m-d', $order_info['timestamp']);

  $estimate = fn_mbc_delivery_estimate_calculate($shipping_id, $order_date);

  $delivery_estimate = array(
    'formatted' => $estimate,
    'order_date' => $order_date,
    'timestamp' => $order_info['timestamp'],
  );

  Registry::get('view')->assign('delivery_estimate', $delivery_estimate);
}
