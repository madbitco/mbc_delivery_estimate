<?php
namespace Tygh;

use Tygh;
use Tygh\Registry;
use Tygh\Shippings\Shippings;
// use Exception;

class ShippingInfo {

  /**
   * Get shipping for test
   *
   * @param  int   $shipping_id    Shipping ID
   * @return array Shipping
   */
  public static function getShippingInfo($shipping_id)
  {
    $fields = array(
      "?:shippings.shipping_id",
      "?:shippings.is_custom",
      "?:shipping_descriptions.shipping",
    );

    $join = "LEFT JOIN ?:shipping_descriptions ON ?:shippings.shipping_id = ?:shipping_descriptions.shipping_id ";

    $shipping_info = db_get_row("SELECT ". implode(', ', $fields) ." FROM ?:shippings " . $join . " WHERE ?:shippings.status = ?s AND ?:shippings.shipping_id = ?i", 'A', $shipping_id);

    return $shipping_info;
  }
}
