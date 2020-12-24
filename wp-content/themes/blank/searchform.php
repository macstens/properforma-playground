<form role="search" method="get" id="searchform" class="searchform" action="/">
	<div>
		<label for="s">Search for:</label>
		<input type="text" value="" name="s" id="s" />
		<?php
		$pt = get_post_types();
		?>
		<select name="post_type" id="post_type">
			<?php
			foreach($pt as $item) {
				echo '<option value="'.$item.'">'.$item.'</option>';
			}

			?>
		</select>
		<input type="submit" id="searchsubmit" value="Search" />
	</div>
</form>