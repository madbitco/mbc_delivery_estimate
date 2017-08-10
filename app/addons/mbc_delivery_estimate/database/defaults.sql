DROP TABLE IF EXISTS `cs_mbc_order_delivery_time`;

CREATE TABLE `cs_mbc_order_delivery_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_id` int(11) NOT NULL DEFAULT '0',
  `pre_cutoff` int(11) NOT NULL DEFAULT '1',
  `post_cutoff` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `shipping_id` (`shipping_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

UNLOCK TABLES;
