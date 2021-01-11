<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Content-->
<div class="app-content container center-layout mt-5">
	<div class="content-wrapper">
		<div class="content-body">
			<section class="row flexbox-container">
				<div class="col-12 d-flex align-items-center justify-content-center">
					<div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
						<div class="card border-grey border-lighten-3 px-1 py-1 m-0">
							<div class="card-header border-0">
								<div class="card-title text-center">
									UAS
								</div>
							</div>
							<div class="card-content">
								<p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
									<span>Kayıt Ol</span>
								</p>
								<div class="card-body">
									<?php if (isset($success)) : ?>
										<div class="alert	alert-success mb-2"><?php echo $success; ?></div>
									<?php endif; ?>
									<?php if (isset($error)) : ?>
										<div class="alert alert-danger mb-2"><?php echo $error; ?></div>
									<?php endif; ?>

									<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

									<form class="form-horizontal" action="" method="post" novalidate>
										<fieldset class="form-group">
											<input name="first_name" type="text" class="form-control" placeholder="Ad" required>
										</fieldset>
										<fieldset class="form-group">
											<input name="last_name" type="text" class="form-control" placeholder="Soyad" required>
										</fieldset>
										<fieldset class="form-group">
											<input name="email" type="email" class="form-control" placeholder="Email" required>
										</fieldset>
										<fieldset class="form-group">
											<input name="password" type="password" class="form-control" placeholder="Şifre" required>
										</fieldset>
										<fieldset class="form-group">
											<input name="password_again" type="password" class="form-control" placeholder="Şifre tekrar" required>
										</fieldset>
										<fieldset class="form-group">
											<input name="tc_number" type="text" class="form-control" placeholder="TC Numarası" required>
										</fieldset>
										<button type="submit" class="btn btn-info btn-block"><i class="ft-unlock"></i> Kaydol</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>
	</div>
</div>
<!-- END: Content-->
