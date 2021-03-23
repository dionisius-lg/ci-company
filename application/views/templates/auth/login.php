<div class="card">
	<div class="card-body login-card-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<form action="" method="post" autocomplete="off">
			<div class="input-group mb-3">
				<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fa fa-fw fa-envelope"></span>
					</div>
				</div>
			</div>
			<div class="input-group mb-3">
				<input type="password" name="password" class="form-control" placeholder="Password" required>
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fa fa-fw fa-lock"></span>
					</div>
				</div>
			</div>
			<div class="custom-control custom-checkbox">
				<input type="checkbox" name="remember" id="RememberMe" class="custom-control-input">
				<label for="RememberMe" class="custom-control-label">Remember Me</label>
			</div>
			<div class="row">
				<div class="col-12 text-right">
					<button type="submit" class="btn btn-primary rounded-0">Sign In</button>
				</div>
			</div>
		</form>

		<p class="mb-1">
			
		</p>
		<p class="mb-1">
			<a href="#">I forgot my password</a>
		</p>
		<p class="mb-0">
			<a href="#" class="text-center">Register new account</a>
		</p>
	</div>
</div>

<?php if (hasFlashError('auth')) { ?>
	<div class="alert alert-light alert-sm alert-dismissible fade show rounded-0" role="alert">
		<i class="fa fa-lg fa-warning"></i> <?php echo flashError('auth'); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php } ?>