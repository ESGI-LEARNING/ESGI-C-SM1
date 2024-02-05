<form>
	<fieldset class="filter">
		<label for="filter">Filter by category</label>
		<select id="filter" class="half">
			<option value="all">All</option>
			<option value="nature">Nature</option>
			<option value="animals">Animals</option>
			<option value="people">People</option>
			<option value="buildings">Buildings</option>
			<option value="objects">Objects</option>
		</select>
		<input type="submit" value="Filter">
	</fieldset>
</form>
<?= $this->component('gallery', $config = $images); ?>
<?= $this->component('modal', $config = []); ?>