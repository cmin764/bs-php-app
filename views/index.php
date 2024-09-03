<h1 class="display-4 text-primary mb-4">PHP Test Application</h1>

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
			<td><?=$user->getName()?></td>
			<td><?=$user->getEmail()?></td>
			<td><?=$user->getCity()?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<form class="border rounded col-md-6 mx-auto mt-5 p-4" method="post" action="create.php">
	<div class="row mb-3">
		<label for="name" class="col-sm-2 col-form-label">Name</label>
		<div class="col-sm-6">
			<input class="form-control" name="name" id="name" placeholder="First and last name" />
		</div>
	</div>

	<div class="row mb-3">
		<label for="email" class="col-sm-2 col-form-label">E-mail</label>
		<div class="col-sm-6">
			<input type="email" class="form-control" name="email" id="email" placeholder="Valid e-mail address" />
		</div>
	</div>

	<div class="row mb-3">
		<label for="city" class="col-sm-2 col-form-label">City</label>
		<div class="col-sm-6">
			<input class="form-control" name="city" id="city" placeholder="Your home town" />
		</div>
	</div>

	<button type="submit" class="btn btn-primary">Add</button>
</form>
