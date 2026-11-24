<?php
require 'bootstrap.php'; auth(); require 'connect.php';
out(query('SELECT id,full_name,phone,region,postal,street FROM addresses WHERE user_email=?','s',auth())->get_result()->fetch_all(MYSQLI_ASSOC));