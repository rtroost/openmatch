<script id="locationRow" type="text/x-handlebars-template">

<li id="{{location_id}}">
	<a href="{{link}}">
		<div class="event-list-body">
			<span class="event-list-body-title">
				{{title}}
			</span>
			<span class="event-list-body-metadata">

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