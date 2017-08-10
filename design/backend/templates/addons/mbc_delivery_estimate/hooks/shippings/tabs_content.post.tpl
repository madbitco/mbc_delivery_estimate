<div id="content_delivery">
	<input type="hidden" name="delivery_data[shipping_id]" value="{$smarty.request.shipping_id}">
	<div class="control-group">
		<label class="control-label cm-required">{__("before")} {$estimate_settings.cutoff_time|date_format:"%H:%M"}:</label>
		<div class="controls">
			{__("delivery_within")}:
			<input type="text" name="delivery_data[pre_cutoff]" value="{$delivery_data.pre_cutoff|default:0}" class="input-micro">
			{if $estimate_settings.skip_weekends == "Y"}
				{__('working_days')}
			{else}
				{__('days')}
			{/if}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label cm-required">{__("after")} {$estimate_settings.cutoff_time|date_format:"%H:%M"}:</label>
		<div class="controls">
			{__("delivery_within")}:
			<input type="text" name="delivery_data[post_cutoff]" value="{$delivery_data.post_cutoff|default:0}" class="input-micro">
			{if $estimate_settings.skip_weekends == "Y"}
				{__('working_days')}
			{else}
				{__('days')}
			{/if}
		</div>
	</div>
<!--content_delivery--></div>
