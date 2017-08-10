{nocache}
<div class="info content-center mv3 w-100">
  <h5 class="f5 mv0 pv2 lh-title info--title tc">Order and supply artwork within <span class="highlight b">{$countdown}</span> to get it by:</h5>
  {* <p class="mv2 tc lh-copy"></p> *}
  <ul class="delivery-estimates df-m">
   {foreach from=$shippings item="shipping"}
     <li class="estimate tc w-100 w-50-m mh0">
       <span class="db b">{$shipping.estimate|date_format:"%A, %d/%m"}</span>
       <span class="db i">{$shipping.label}</span>
     </li>
   {/foreach}
  </ul>
  <p class="f6 mv1 tc"><i>Economy</i> delivery <b>is free</b> for orders over &pound;60.</p>
</div>
{/nocache}

{if $is_custom}
  <div class="product-notice">
    <h5 class="title f6">
      <span class="icon pr2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="18" height="18"><path d="M10 .4C4.697.4.4 4.698.4 10c0 5.303 4.297 9.6 9.6 9.6 5.3 0 9.6-4.297 9.6-9.6 0-5.302-4.3-9.6-9.6-9.6zm.896 3.466c.936 0 1.21.543 1.21 1.164 0 .775-.62 1.492-1.678 1.492-.886 0-1.308-.445-1.282-1.182 0-.62.52-1.474 1.75-1.474zM8.498 15.75c-.64 0-1.107-.39-.66-2.094l.733-3.025c.128-.483.15-.677 0-.677-.19 0-1.02.334-1.51.664l-.32-.523c1.555-1.3 3.343-2.06 4.108-2.06.64 0 .746.755.427 1.92l-.84 3.18c-.15.56-.085.755.064.755.19 0 .82-.233 1.437-.72l.362.486c-1.514 1.512-3.163 2.094-3.802 2.094z"/></svg>
      </span>
      <span class="label b">Production Required</span>
    </h5>
    <p class="mv2 f6">This product requires production time of <strong>up to 5 working days</strong>. You can expedite the process <strong>to 2 working days</strong> by selecting <em>Express Service</em> during checkout.</p>
    <p class="mv2 f6">Estimates above already include production time.</p>
  </div>
{/if}
{* <div class="info content-center ph2 ph0 mv3 w-100">
  <h5 class="f5 mv2 pb2 lh-title info--title">Price Promise</h5>
  <p class="mv2 f6">Have you found the same product advertised cheaper elsewhere? Let us know and we will aim to beat that price. Terms and conditions apply. <a href="{'pages.view?page_id=6'|fn_url}">See details</a>.</p>
</div> *}
