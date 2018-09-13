<form id="SearchForm_SearchForm" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" enctype="application/x-www-form-urlencoded">

	<p id="SearchForm_SearchForm_error" class="message " style="display: none"></p>

	<fieldset>
		<div class="input-group">
			<!-- <input value="" placeholder="" type="text" name="Search" value="Search" class="text form-control nolabel" id="SearchForm_SearchForm_Search" /> -->
			<input value="" placeholder="Search" type="text" name="s" class="text form-control nolabel" id="s">
			<div class="input-group-btn">
				<input class="btn btn-primary" type="submit" name="action_results" value="Go" id="SearchForm_SearchForm_action_results">
			</div>


		</div>
	</fieldset>
</form>