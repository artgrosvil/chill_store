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
	<div class="row c-s-apps">
		<div class="col-lg-7 col-lg-offset-1">
			<?php foreach ($apps as $data): ?>
				<div class="row">
					<div class="col-lg-1 c-s-vc">
						<span><?= $data['count_added']; ?></span>
					</div>
					<div class="col-lg-2 c-s-avatar c-s-vc">
						<img src="http://cdn.iamchill.co/statics/avatars/<?= $data['img']; ?>" style="width: 80%">
					</div>
					<div class="col-lg-7">
						<h2><?= $data['name']; ?></h2>
						<p><?= $data['description']; ?></p>
					</div>
					<div class="col-lg-2 c-s-vc">
						<?php if ($this->session->userdata('logged')): ?>
							<a href="javascript:void(0);" onclick="addApp(<?= $data['id']; ?>)">Add</a>
						<?php else: ?>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#c-s-auth">Add</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="col-lg-3 c-s-cat">
			<div class="row c-s-sort">
				<div class="col-lg-12">
					<span>
						<a href="javascript:void(0);" id="link-best" onclick="setSort('best')">Best</a> /
						<a href="javascript:void(0);" id="link-new" onclick="setSort('new')">New</a></span>
				</div>

			</div>
			<div class="row">
				<div class="col-lg-12" id="button-c-s-sort">
					<a href="/cat/all/sort/new" class="btn btn-success btn-block" role="button">All</a>
					<?php foreach ($categories->result() as $data): ?>
						<a href="/cat/<?= $data->name; ?>/sort/new" class="btn btn-success btn-block" role="button"><?= $data->title; ?></a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="c-s-auth" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row pull-center">
					<div class="col-lg-8 col-lg-offset-2">
						<h2 class="modal-title">Sign in to Chill</h2>
					</div>
				</div>
			</div>
			<div class="modal-body c-s-auth-modal">
				<div class="row">
					<div class="col-lg-12">
						<span>Get Chill for:</span>
						<ul>
							<li><a href="https://itunes.apple.com/us/app/chill!/id957107517" target="_blank">iOS</a>,</li>
							<li><a href="https://itunes.apple.com/us/app/chill!/id957107517" target="_blank">AppleWatch</a>,
							</li>
							<li><a href="https://play.google.com/store/apps/details?id=com.iamchill.chill" target="_blank">Android</a>,
							</li>
							<li><a href="http://apps.getpebble.com/en_US/application/55d7a5a52c4f5efd7a000049" target="_blank">Pebble</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<span>or</span>
					</div>
				</div>
				<div class="row c-s-auth-modal-form">
					<div class="col-lg-8 col-lg-offset-2">
						<form class="form-horizontal" id="form-c-s-auth" method="post" accept-charset="utf-8">
							<div class="form-group">
								<div class="col-lg-12">
									<input type="text" class="form-control" id="login" name="login"
									       placeholder="Login">
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12">
									<input type="password" class="form-control" id="password" name="password"
									       placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12">
									<button type="button" class="btn btn-success" id="button-c-s-auth">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- js start -->
<?php $this->load->view('include/js'); ?>
<!-- js end -->
</body>
</html>