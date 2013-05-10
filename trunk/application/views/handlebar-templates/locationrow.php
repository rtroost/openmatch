<script id="locationRow" type="text/x-handlebars-template">

<li id="{{location_id}}">
	<a href="{{link}}">
		<div class="location-list-body">
			<span class="location-list-body-title">
				{{title}}
			</span>
			<span class="location-list-body-metadata">
				Type:
				{{#each types}}
					{{this}}
				{{/each}}
			</span>
			<span>
				{{#if website}}
					<a href="{{website}}"> website</a>
				{{/if}}
			</span>
		</div>
	</a>
</li>

</script>