<h1 class="display-4 text-primary mb-4">PHP Test Application</h1>

<div class="col-sm-4 mx-auto">
	<input id="cityFilter" class="form-control mb-3" placeholder="Filter by city">
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">E-mail</th>
			<th scope="col">City</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $user) { ?>
		<tr>
			<!-- Displays data with escaping to prevent XSS -->
			<td><?=htmlspecialchars($user->getName(), ENT_QUOTES, 'UTF-8');?></td>
			<td><?=htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8');?></td>
			<td><?=htmlspecialchars($user->getCity(), ENT_QUOTES, 'UTF-8');?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<form class="border rounded col-md-5 mx-auto mt-5 p-4" method="post" action="create.php">
	<div class="row mb-3">
		<label for="name" class="col-sm-2 col-form-label">Name</label>
		<div class="col-sm-10">
			<input class="form-control" name="name" id="name" placeholder="First and last name" />
		</div>
	</div>

	<div class="row mb-3">
		<label for="email" class="col-sm-2 col-form-label">E-mail</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" name="email" id="email" placeholder="Valid e-mail address" />
		</div>
	</div>

	<div class="row mb-3">
		<label for="city" class="col-sm-2 col-form-label">City</label>
		<div class="col-sm-10">
			<input class="form-control" name="city" id="city" placeholder="Your home town" />
		</div>
	</div>

	<button type="submit" class="btn btn-primary">Add</button>
</form>
