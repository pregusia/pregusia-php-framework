
<div id="{$Widget['elementID']}_main" class="form-group row ui-widget-DateAndTimeInput ui-widget-name-{$Widget['name']} {$Widget['Errors'] ? 'has-error' : ''}">
	<label class="col-md-2 control-label">{$Widget['caption']}</label>
	<div class="col-md-9">
		<div class="input-group date-time-input">
			<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
			<input id="{$Widget['elementID']}" {$Widget['elementParams']} class="form-control {$Widget['elementClasses']}" type="text" name="{$Widget['name']}" tabindex="{$Widget['index']}" value="{$Widget['valueString']}" /> {$Widget['suffix']}
		</div>
		
		{if $Widget['hasDescription']}
		<span class="help-block">{$Widget['description']}</span>
		{endif}
	</div>
</div>
