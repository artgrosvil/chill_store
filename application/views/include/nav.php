<div class="row c-p-nav">
	<div class="col-xs-6">
		<h2><a href="http://store.iamchill.co/">Apps</a></h2>
		<?php if ($this->session->userdata('logged')): ?>
			<div class="btn-group">
				<button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
				        aria-expanded="false">
					<h2>Settings</h2>
				</button>
				<ul class="dropdown-menu">
					<li><a href="http://store.iamchill.co/profile/">Profile</a></li>
					<li><a href="http://store.iamchill.co/logout/">Logout</a></li>
				</ul>
			</div>
		<?php else: ?>
			<h2><a href="javascript:void(0);" data-toggle="modal" data-target="#c-s-auth">Sign in</a></h2>
		<?php endif; ?>

	</div>
	<div class="col-xs-1 col-xs-offset-5">
		<a href="http://iamchill.co" target="_blank"><img src="http://cdn.iamchill.co/design/img/logo_mini.png"></a>
	</div>
</div>