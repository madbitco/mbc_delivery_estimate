<?php
// -----------------------------------------------------------------------------
// Estimate Shipping Time
// 2017 © MADBIT Co.
// -----------------------------------------------------------------------------

if ( !defined('BOOTSTRAP') ) { die('Access denied'); }

fn_register_hooks(
  'get_shipping_info',
  // 'get_shipping_info_post',
  'shippings_get_shippings_list_conditions',
  'shippings_get_shippings_list_post'
);
