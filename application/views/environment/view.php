<div class="container mt-5">
	<?php if (isset($success)) : ?>
		<div class="alert alert-success mb-2"><?php echo $success; ?></div>
	<?php endif; ?>
	<?php if (isset($error)) : ?>
		<div class="alert alert-danger mb-2"><?php echo $error; ?></div>
	<?php endif; ?>

	<div class="col-12 my-3">
		<a href="<?php echo base_url('environment/export_xml?id=' . $id); ?>" class="btn btn-success">
			EXPORT XML
		</a>
	</div>

	<div class="col-12">
		<h3 class="d-flex justify-content-between">
			Fixtures

			<button class="btn btn-success ml-auto" data-toggle="modal" data-target="#addNewFixture">Add New</button>
		</h3>

		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Type</th>
					<th scope="col">Description</th>
					<th scope="col">Size</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($fixtures as $fixture) : ?>
					<tr>
						<th scope="row"><?php echo $fixture->id; ?></th>
						<td><?php echo $fixture->name; ?></td>
						<td><?php echo $fixture->type; ?></td>
						<td><?php echo $fixture->description; ?></td>
						<td><?php echo $fixture->size; ?></td>
						<td>
							<a class="btn btn-danger" href="<?php echo base_url('fixture/delete?id=' . $fixture->id); ?>" data-confirm data-title="Do You Really Want To Delete?">
								Delete
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="col-12 mt-5">
		<h3 class="d-flex justify-content-between">
			Working Hours

			<button class="btn btn-success ml-auto" data-toggle="modal" data-target="#addNewWorkingHour">Add New</button>
		</h3>

		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Start Date</th>
					<th scope="col">End Date</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($working_hours as $working_hour) : ?>
					<tr>
						<th scope="row"><?php echo $working_hour->id; ?></th>
						<td><?php echo $working_hour->start; ?></td>
						<td><?php echo $working_hour->end; ?></td>
						<td>
							<a class="btn btn-danger" href="<?php echo base_url('working_hour/delete?id=' . $working_hour->id); ?>" data-confirm data-title="Do You Really Want To Delete?">
								Delete
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="col-12 mt-5">
		<h3>Appointments</h3>

		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">User Name</th>
					<th scope="col">Start Date</th>
					<th scope="col">End Date</th>
					<th scope="col">Description</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($appointments as $appointment) : ?>
					<tr>
						<th scope="row"><?php echo $appointment->a_id; ?></th>
						<td><?php echo $appointment->first_name; ?></td>
						<td><?php echo $appointment->start; ?></td>
						<td><?php echo $appointment->end; ?></td>
						<td><?php echo $appointment->description; ?></td>
						<td>
							<a class="btn btn-success" href="<?php echo base_url('appointment/approve?id=' . $appointment->a_id); ?>" data-confirm data-title="Do You Really Want To Approve?">
								Approve
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addNewFixture" tabindex="-1" role="dialog" aria-labelledby="addNewFixtureLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addNewFixtureLabel">Add new fixture</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="fixtureAdd" action="<?php echo base_url('fixture/add_new'); ?>" method="post">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control">
					</div>
					<div class="form-group">
						<label>Type</label>
						<select name="type" class="form-control">
							<option value="desk">Desk</option>
							<option value="chair">Chair</option>
							<option value="curtain">Curtain</option>
							<option value="trash_bin">Trash Bin</option>
							<option value="technological_tool">Technological Tool</option>
							<option value="experiment_set">Experiment Set</option>
						</select>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input type="text" name="description" class="form-control">
					</div>
					<div class="form-group">
						<label>Size</label>
						<input type="text" name="size" class="form-control">
					</div>
					<input type="hidden" name="environment_id" value="<?php echo $id; ?>">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" form="fixtureAdd" class="btn btn-primary">Add new fixture</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addNewWorkingHour" tabindex="-1" role="dialog" aria-labelledby="addNewWorkingHourLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addNewWorkingHourLabel">Add new working hour</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="workingHourAdd" action="<?php echo base_url('working_hour/add_new'); ?>" method="post">
					<div class="form-group">
						<label>Start</label>
						<input type="text" name="start" class="form-control datetimepicker">
					</div>
					<div class="form-group">
						<label>End</label>
						<input type="text" name="end" class="form-control datetimepicker">
					</div>
					<input type="hidden" name="environment_id" value="<?php echo $id; ?>">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" form="workingHourAdd" class="btn btn-primary">Add working hour</button>
			</div>
		</div>
	</div>
</div>
