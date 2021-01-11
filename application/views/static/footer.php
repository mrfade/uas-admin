<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha512-kBFfSXuTKZcABVouRYGnUo35KKa1FBrYgwG4PAx7Z2Heroknm0ca2Fm2TosdrrI356EDHMW383S3ISrwKcVPUw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js" integrity="sha512-LRkOtikKE2LFHPWiWh0/bfFynswxRwCZ5O7PkXTVFPcprw376xfOemiEHEOmCCmiwS6eLFUh2fb+Gqxc0waTSg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.all.min.js" integrity="sha512-G7XfKG34JP/eVi0qf5fiqOoyIQhA1h+fsruFv89Uag3EUT+WKh5k8Y5OBcVkC/FxAYMh1tbyEU8F7NoytU0jVg==" crossorigin="anonymous"></script>

<script>
  $(function() {
    $('.datetimepicker').each(function(index, item) {
      $(item).bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD HH:mm',
				switchOnClick: true
			});
    })

    $("[data-confirm]").on("click", function(e) {
      e.preventDefault();

      var href = $(this).attr("href");
      var title = $(this).data("title");

      Swal.fire({
        title: title,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes !',
        cancelButtonText: 'No !',
				reverseButtons: true,
				customClass: {
					confirmButton: 'btn btn-success ml-3',
        	cancelButton: 'btn btn-danger',
				},
				buttonsStyling: true
      }).then(function(result) {
        if (result.value) {
          window.open(href, "_self");
        }
      });

    });
  })
</script>

</body>
<!-- END: Body-->

</html>
