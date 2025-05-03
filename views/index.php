<h1 class="display-4 text-primary mb-4">uSphere</h1>

<div class="col-sm-4 mx-auto">
	<input id="cityFilter" class="form-control mb-3" placeholder="Filter by city">
</div>

<div class="table-wrapper">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Name</th>
				<th scope="col">E-mail</th>
				<th scope="col">City</th>
				<th scope="col">Phone</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($users as $user) { ?>
			<tr>
				<!-- Displays data with escaping to prevent XSS -->
				<td><?=htmlspecialchars($user->getName(), ENT_QUOTES, 'UTF-8');?></td>
				<td><?=htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8');?></td>
				<td><?=htmlspecialchars($user->getCity(), ENT_QUOTES, 'UTF-8');?></td>
				<td><?=htmlspecialchars($user->getPhone(), ENT_QUOTES, 'UTF-8');?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<form class="border rounded col-md-5 mx-auto mt-5 p-4" method="post">
	<!-- Placeholder for success/error message on AJAX form submissions -->
	<div id="responseMessage" class="mt-3"></div>

	<div class="row mb-3">
		<label for="name" class="col-sm-2 col-form-label">Name</label>
		<div class="col-sm-10">
			<input class="form-control" name="name" id="name" placeholder="First and last name" required />
		</div>
	</div>

	<div class="row mb-3">
		<label for="email" class="col-sm-2 col-form-label">E-mail</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" name="email" id="email" placeholder="Valid e-mail address" required />
		</div>
	</div>

	<div class="row mb-3">
		<label for="city" class="col-sm-2 col-form-label">City</label>
		<div class="col-sm-10">
			<input class="form-control" name="city" id="city" placeholder="Your home town" required />
		</div>
	</div>

	<div class="row mb-3">
		<label for="phone" class="col-sm-2 col-form-label">Phone</label>
		<div class="col-sm-10 text-start">
			<input type="tel" class="form-control" id="phone" name="phone" pattern="^\+?\d{10,13}$" placeholder="+40756260927" required />
			<small class="form-text text-muted">Enter a 10-13-digit phone number including prefix.</small>
		</div>
	</div>

	<button type="submit" class="btn btn-primary">Add</button>
</form>
