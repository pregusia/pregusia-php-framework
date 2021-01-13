
<div id="{$Widget['elementID']}_main" class="form-group row ui-widget-TimeInput ui-widget-name-{$Widget['name']} {$Widget['Errors'] ? 'has-error' : ''}">
	<label class="col-md-2 control-label">{$Widget['caption']}</label>
	<div class="col-md-9">
		<div class="input-group time-input">
			<span class="input-group-addon"> <i class="fa fa-clock-o"></i> </span>
			<input id="{$Widget['elementID']}" {$Widget['elementParams']} class="form-control {$Widget['elementClasses']}" type="text" name="{$Widget['name']}" tabindex="{$Widget['index']}" value="{$Widget['value']}" /> {$Widget['suffix']}
		</div>
		
		{if $Widget['hasDescription']}
		<span class="help-block">{$Widget['description']}</span>
		{endif}
	</div>
</div>
