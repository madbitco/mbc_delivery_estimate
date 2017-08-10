<div class="control-group shift-top">
    <div class="control-label">
        {include file="common/subheader.tpl" title=__("estimated_delivery")}
    </div>
</div>

<div class="control-group" >
    <span>{$delivery_estimate.estimate|date_format:"%A, %d/%m/%Y"}</span>
</div>
