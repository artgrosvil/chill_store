<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<link rel="icon" href="http://cdn.iamchill.co/design/img/favicon.ico">

	<title>Chill - the way we communicate is about to change</title>

	<!-- css start -->
	<?php $this->load->view('include/css'); ?>
	<!-- css end -->
</head>
<body>
<div class="container">
	<!-- navigation start -->
	<?php $this->load->view('include/nav'); ?>
	<!-- navigation end -->
	<div class="row c-p-head">
		<div class="col-lg-6">
			<h1>Profile</h1>
		</div>
		<div class="col-lg-6">
			<h1>Statistics</h1>
		</div>
	</div>
	<div class="row c-p-app">
		<?php foreach ($user->result() as $data): ?>
			<form class="form-horizontal" id="form-c-s-user-update" method="post" accept-charset="utf-8">
				<div class="col-lg-5 col-lg-offset-1">
					<div class="form-group">
						<label for="name" class="col-lg-2 control-label">Name</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="name" name="name" value="<?= $data->name; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-lg-2 control-label">Email</label>
						<div class="col-lg-10">
							<input type="email" class="form-control" id="email" name="email" value="<?= $data->email; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-lg-2 control-label">Password</label>
						<div class="col-lg-10">
							<input type="password" class="form-control" id="password" name="password" value="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<div class="btn-group pull-right" role="group">
								<button type="button" class="btn btn-success" id="button-c-s-user-update">Save</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-lg-offset-1">
					<ul class="list-group">
						<li class="list-group-item">
							<span class="badge"><?= $count_contacts; ?></span>
							Contacts
						</li>
						<li class="list-group-item">
							<span class="badge"><?= $count_apps; ?></span>
							Apps
						</li>
					</ul>
				</div>
			</form>
		<?php endforeach; ?>
	</div>

	<div class="row c-p-head">
		<div class="col-lg-6">
			<h1>Apps</h1>
		</div>
	</div>

	<div class="row c-s-apps-user">
		<div class="col-lg-12">
			<?php if ($apps->num_rows() == 0): ?>
				<h2>Your apps will be here</h2>
			<?php else: ?>
				<table class="table">
					<thead>
					<tr>
						<th>#</th>
						<th>Name app</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($apps->result() as $data): ?>
						<tr id="app-<?= $data->id_app; ?>">
							<td><?= $data->id_app; ?></td>
							<td><?= $data->name_app; ?></td>
							<td><?= $data->description; ?></td>
							<td>
								<a href="javascript:void(0)" onclick="deleteAppUser(<?= $data->id_app; ?>)"><span
										class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- js start -->
<?php $this->load->view('include/js'); ?>
<!-- js end -->
</body>
</html>