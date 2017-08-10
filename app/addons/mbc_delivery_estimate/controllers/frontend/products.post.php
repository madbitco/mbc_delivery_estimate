<?php

use Tygh\Registry;
use Tygh\Shippings\Shippings;
use Tygh\ShippingInfo;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'view') {
  $shippings_list = array();
  $product_id = $_REQUEST['product_id'];

  $product_data = fn_get_product_data(
    $product_id, $auth, CART_LANGUAGE, '', true, true, true, true,
      fn_is_preview_action($auth, $_REQUEST), true, false, true
  );

  $location = fn_get_customer_location($auth, Tygh::$app['session']['cart']);
  $groups = Shippings::groupProductsList(array(0 => $product_data), $location);
  $shippings = Shippings::getShippingsList($groups[0]);

  if (empty($product_data)) {
    return array(CONTROLLER_STATUS_NO_PAGE);
  } else {
    foreach($shippings as $key => $shipping) {
      // discard shipping options that do not match default destination
      if ($shipping['destination_id'] != fn_get_available_destination($location)) {
        unset($shippings[$key]);
        continue;
      }

      $shipping_info = ShippingInfo::getShippingInfo($shipping['shipping_id']);
      $estimate = fn_mbc_delivery_estimate_calculate($shipping['shipping_id']);

      if (!empty($estimate)) {
        $shippings_list[$key]['estimate'] = $estimate;
        $shippings_list[$key]['label'] = $shipping_info['shipping'];
      }
    }
  }

  $countdown = fn_mbc_delivery_estimate_countdown();

  if ($countdown->format('%days') >= 1) {
    Registry::get('view')->assign('countdown', $countdown->format("%dd %hh"));
  } else {
    Registry::get('view')->assign('countdown', $countdown->format("%hh %im"));
  }

  Registry::get('view')->assign('shippings', $shippings_list);
  Registry::get('view')->assign('is_custom', ($product_data['is_custom'] == 'Y' ? true : false));
}
