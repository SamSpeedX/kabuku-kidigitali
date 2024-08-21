<?php
$unga = mysqli_connect('localhost', 'root', '', 'kabuku');

if (!$unga) {
    die("hakuna muunganisho wa kitunza taarifa. <br>" . mysqli_connect_error());
}
?>