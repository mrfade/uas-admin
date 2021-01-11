<div class="container mt-5">
	<?php if (isset($success)) : ?>
		<div class="alert alert-success mb-2"><?php echo $success; ?></div>
	<?php endif; ?>
	<?php if (isset($error)) : ?>
		<div class="alert alert-danger mb-2"><?php echo $error; ?></div>
	<?php endif; ?>

	<div class="col-12">
		<h3 class="d-flex justify-content-between">
			Environments <small class="text-muted" style="font-size:60%;margin-left:10px;margin-top:10px;">(that I responsible of)</small>

			<button class="btn btn-success ml-auto" data-toggle="modal" data-target="#addNewEnvironment">Add New</button>
		</h3>

		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Location</th>
					<th scope="col">Capacity</th>
					<th scope="col">Type</th>
					<th scope="col">View</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($environments as $environment) : ?>
					<tr>
						<th scope="row"><?php echo $environment->id; ?></th>
						<td><?php echo $environment->name; ?></td>
						<td><?php echo $environment->location; ?></td>
						<td><?php echo $environment->capacity; ?></td>
						<td><?php echo $environment->type; ?></td>
						<td>
							<a class="btn btn-info" href="<?php echo base_url('environment/view?id=' . $environment->id); ?>">
								View
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addNewEnvironment" tabindex="-1" role="dialog" aria-labelledby="addNewEnvironmentLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addNewEnvironmentLabel">Add new environment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="environmentAdd" action="<?php echo base_url('environment/add_new'); ?>" method="post">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control">
					</div>
					<div class="form-group">
						<label>Type</label>
						<select name="type" class="form-control">
							<option value="classroom">Classroom</option>
							<option value="laboratory">Laboratory</option>
							<option value="congress_center">Congress Center</option>
							<option value="meeting_room">Meeting Room</option>
						</select>
					</div>
					<div class="form-group">
						<label>Location</label>
						<input type="text" name="location" class="form-control">
					</div>
					<div class="form-group">
						<label>Capacity</label>
						<input type="number" name="capacity" class="form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" form="environmentAdd" class="btn btn-primary">Add new environment</button>
			</div>
		</div>
	</div>
</div>
