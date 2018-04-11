<?php
// -----------------------------------------------------------------------------
// Estimate Shipping Time
// 2017 © MADBIT Co.
// -----------------------------------------------------------------------------

if ( !defined('BOOTSTRAP') ) { die('Access denied'); }

use Tygh\Registry;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($mode == 'update' && !empty($_REQUEST['delivery_data'])) {
    $delivery_data = $_REQUEST['delivery_data'];

    if ((int)$delivery_data['shipping_id'] > 0) {
      $id = db_get_field('SELECT id FROM ?:mbc_delivery_estimate WHERE shipping_id=?i', $delivery_data['shipping_id']);
      if ($id > 0){
        unset($delivery_data['shipping_id']);
        db_query('UPDATE ?:mbc_delivery_estimate SET ?u WHERE id = ?i', $delivery_data, $id);
      } else {
        db_query("INSERT INTO ?:mbc_delivery_estimate ?e", $delivery_data);
      }
    }
  }
}
