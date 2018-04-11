<p align="center"><img src="https://github.com/madbitco/mbc_delivery_estimate/raw/master/splash.jpg" alt="Delivery Estimate Splash Image" /></p>

# UK Delivery Estimate (for CS-Cart)
Show your customers when their order will arrive before they make a purchase.

## Minimum Requirements
- PHP 5.6+ (7.0+ is supported as well and recommended)
- [PHP Calendar Extension](http://php.net/manual/en/book.calendar.php)
- CS-Cart v4.4.1+

This add-on was tested on CS-Cart `v4.4.1` (incl. Ultimate) and newer (tested up to `v4.6.2`). It is likely it will work for earlier releases, but unfortunately we cannot guarantee it.

## Installation
To install the add-on, follow [standard add-on installation instructions](https://docs.cs-cart.com/4.7.x/install/index.html) from the official CS- Cart documentation.

## Configuration
The add-on comes pre-configured out-of-the-box, but you can tweak global settings by visiting add-on configuration sheet. Follow official instructions on [how to configure your add-ons](https://docs.cs-cart.com/4.7.x/user_guide/addons/1manage_addons.html#configuring-add-ons).

You can adjust three options:
- Enable/disable adjustment for UK Bank Holidays (default: `enabled`);
- Enable/disable adjustment for weekends (default: `enabled`);
- Set a global cut-off time for estimating orders (default: `14:00:00`).

## Setting up shipping options
Before you can display delivery estimates, you need to explicitly enable them for each of your delivery methods.

> Note, that delivery estimation works only when manual shipping calculation method is selected.

1. Go to: *Administration* > *Shipping & Taxes* > *Shipping Methods*.
2. Click on a name of a selected shipping method to open its configuration page.
3. Towards the bottom of the *General* tab you should see a checkbox labelled *Calculated delivery estimate*. Check it.
4. Scroll up and switch to the *Delivery* tab. Enter desired delivery timescales into the boxes. These values govern how many days will the delivery take approximately from the date the order is placed. If you offer same-day shipping and delivery, enter `0` (zero).
5. Click on the *Save and Close* button to confirm all changes.
6. From now on you and your customers should see available shipping options along with delivery estimates on the following pages:
    - Product page
    - Checkout
    - Order details page (customer/admin)
    - Order invoice (admin)

## Troubleshooting 
In case your estimates do not display, try to [clear your caches](https://docs.cs-cart.com/4.7.x/developer_guide/getting_started/cache_clearing.html).

## Licensing
2018 &copy; MADBIT Co. Licensed under MIT License terms.
