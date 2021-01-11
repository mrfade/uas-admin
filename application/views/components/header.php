<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">UAS Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav">
			<?php if (!@$login['login']): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('auth/login'); ?>">Login</a>
			</li>
			<?php endif; ?>
			<?php if (@$login['login']): ?>
      <li class="nav-item">
        <a class="nav-link" href="#">Welcome, <?php echo $login['first_name']; ?></a>
			</li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
			</li>
			<?php endif; ?>
    </ul>
  </div>
</nav>
