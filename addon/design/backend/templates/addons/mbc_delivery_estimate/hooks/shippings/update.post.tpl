<div class="control-group">
  <label class="control-label" for="estimate_delivery">{__("calculate_estimate")}</label>
  <div class="controls">
    <input type="hidden" name="shipping_data[estimate_delivery]" value="N">
    <label class="checkbox inline" for="estimate_delivery">
      <input type="checkbox" name="shipping_data[estimate_delivery]" id="estimate_delivery"{if $shipping.estimate_delivery == 'Y'} checked="checked"{/if} value="Y" />
    </label>
  </div>
</div>
