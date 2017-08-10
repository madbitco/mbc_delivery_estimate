{nocache}
<div class="info content-center ph2 mb3">
  <p class="mb4 mt0 tc lh-copy">Order within <span class="highlight b">{$countdown}</span> to get it by:</p>
  <ul class="delivery-estimates">
   {foreach from=$shippings item="shipping"}
     <li class="estimate tc lh-title">
       <span class="db b">{$shipping.estimate}</span>
       <span class="db">when you select <span class="i">{$shipping.label}</span></span>
     </li>
   {/foreach}
  </ul>
</div>
{/nocache}
