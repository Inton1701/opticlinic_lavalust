
<?php



if (!function_exists('set_flash_alert')) {
  function set_flash_alert($alert, $message) {
    $Lava =& lava_instance();
    $Lava->session->set_flashdata(array('alert' => $alert, 'message' => $message));
  }
}

if (!function_exists('flash_alert')) {
  function flash_alert() {
    $LAVA =& lava_instance();
    if ($LAVA->session->flashdata('alert') != NULL) {
      $alert = $LAVA->session->flashdata('alert');
      $message = $LAVA->session->flashdata('message');
      echo "
      <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
            icon: '" . ($alert == 'success' ? 'success' : 'error') . "',
            title: '" . ucfirst($alert) . "',
            text: '" . $message . "',
            confirmButtonText: 'OK'
          });
        });
      </script>
      ";
    }
  }
}