<?php
// -----------------------------------------------------------------------------
// Estimate Shipping Time
// 2017 © MADBIT Co.
// -----------------------------------------------------------------------------

use Tygh\Registry;
use Tygh\Settings;
use Tygh\UKBankHoliday;

if ( !defined('BOOTSTRAP') ) { die('Access denied'); }

// -----------------------------------------------------------------------------
// Standard hooks
// ----------------------------------------------------------------------------

function fn_mbc_delivery_estimate_get_shipping_info (&$shipping_id, &$fields, &$join, &$conditions, &$lang_code) {
  $fields[] = 'estimate_delivery';

  return true;
}

// function fn_mbc_delivery_estimate_get_shipping_info_post (&$shipping_id, &$lang_code, &$shipping) {
//   return true;
// }

function fn_mbc_delivery_estimate_shippings_get_shippings_list_conditions(&$group, &$shippings, &$fields, &$join, &$condition, &$order_by) {
  $fields[] = 'estimate_delivery';

  if (Registry::get('runtime.controller') !== 'checkout') {
    $fields[] = "destination_id";
    $join .= "LEFT JOIN ?:shipping_rates ON ?:shipping_rates.shipping_id = ?:shippings.shipping_id ";
    if (AREA == 'C') {
      $condition .= db_quote('AND ?:shippings.estimate_delivery = ?s', 'Y');
    }
  }

  return true;
}

function fn_mbc_delivery_estimate_shippings_get_shippings_list_post(&$group, &$lang, &$area, &$shippings_info) {
  // print_r("<pre>" . var_export($is_custom_order, true) . "</pre>"); die();

  foreach ($shippings_info as $key => &$shipping) {
    if (!empty($shipping['estimate_delivery']) && $shipping['estimate_delivery'] == 'Y') {
      $service_delivery_time = fn_mbc_delivery_estimate_calculate($shipping['shipping_id'], false);
      $shipping['delivery_estimate'] = $service_delivery_time;
      $shipping['service_delivery_time'] = __('mbc_delivery_by') . ' ' . fn_date_format($service_delivery_time->format('U'), Registry::get('settings.Appearance.date_format'));
    }
  }
}

// -----------------------------------------------------------------------------
// Custom functions
// -----------------------------------------------------------------------------

function fn_mbc_delivery_estimate_filter_shippings(&$shippings)
{
  if (AREA == 'C') {
    foreach ($shippings as $key => $shipping) {
      if (empty($shipping['estimate_delivery']) || $shipping['estimate_delivery'] === 'N') {
        unset($shippings[$key]);
      }
    }
  }
}

function fn_mbc_delivery_estimate_calculate($shipping_id, $order_date = false)
{
  $settings = Registry::get('addons.mbc_delivery_estimate');
  // Fetch a database row for a given `shipping_id`
  $data = db_get_row('SELECT * FROM ?:mbc_delivery_estimate WHERE shipping_id=?i', $shipping_id);
  $quote_time = new DateTime(date('Y-m-d H:i:s', time()));
  $cutoff_time = new DateTime(date('Y-m-d H:i:s', strtotime($settings['cutoff_time'])));
  $type_of_day = ($settings['skip_weekends'] == 'Y' ? 'weekday' : 'day');

  if (!$order_date) {
    $delivery_date = new DateTime(date('Y-m-d', time()));
  } else {
    $delivery_date = new DateTime($order_date);
  }

  if (!empty($data)) {
    // add default delays, configured per delivery option in the admin area
    if ((int)$quote_time->format('U') >= (int)$cutoff_time->format('U')) {
      $delivery_date->modify("+{$data['post_cutoff']} {$type_of_day}");
    } else {
      $delivery_date->modify("+{$data['pre_cutoff']} {$type_of_day}");
    }

    // if a bank holiday falls within the order fullfilment timeframe, adjust for it
    if ($settings['uk_bank_holidays'] == 'Y') {
      fn_mbc_delivery_estimate_adjust_for_uk_holidays($delivery_date, $quote_time, $delivery_date);
    }
  } else {
    return false;
  }

  return $delivery_date;
}


function fn_mbc_delivery_estimate_countdown()
{
  $settings = Registry::get('addons.mbc_delivery_estimate');
  $current_time = new DateTime(date('Y-m-d H:i:s', time()));
  $cutoff_time = new DateTime(date('Y-m-d H:i:s', strtotime($settings['cutoff_time'])));
  $countdown;

  if ($settings['skip_weekends'] == 'Y') {
    $is_friday = date('w', strtotime($cutoff_time->format('Y-m-d'))) == 5;
    $is_saturday = date('w', strtotime($cutoff_time->format('Y-m-d'))) == 6;
    $is_sunday = date('w', strtotime($cutoff_time->format('Y-m-d'))) == 0;

    if ($is_friday) {
      $cutoff_time->modify('+3 day');
    } elseif ($is_saturday) {
      $cutoff_time->modify('+2 day');
    } elseif ($is_sunday) {
      $cutoff_time->modify('+1 day');
    }
  }

  if ((int)$current_time->format('U') >= (int)$cutoff_time->format('U')) {
    $countdown = $cutoff_time->modify('+1 day')->diff($current_time, true);
  } else {
    $countdown = $cutoff_time->diff($current_time, true);
  }

  return $countdown;
}

function fn_mbc_delivery_estimate_adjust_for_uk_holidays (&$delivery_date, $date_start, $date_end)
{
  $ukbankholiday = new UKBankHoliday();
  $holidays = $ukbankholiday->toArray();
  // remove redundant values
  array_shift($holidays);
  array_pop($holidays);

  foreach ($holidays as $key => $value) {
    if (strtotime($value) >= $date_start->format('U') && strtotime($value) <= $date_end->format('U')) {
      $delivery_date->modify("+1 day");
    }
  }

  return $delivery_date;
}
