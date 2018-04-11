{nocache}
<div class="ty-sidebox">
  <h3 class="ty-sidebox__title">{__('mbc_order_within')} <span class="highlight">{$countdown}</span> {__('mbc_to_get_it_by')}:</h3>
  <div class="ty-sidebox__body">
    <ul>
      {foreach from=$shippings item="shipping"}
       <li>{$shipping.estimate|date_format:"`$settings.Appearance.date_format`"} ({__('mbc_via')} {$shipping.label})</li>
      {/foreach}
    </ul>
  </div>
</div>
{/nocache}
