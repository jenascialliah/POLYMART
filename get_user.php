<?php
require 'bootstrap.php'; auth(); require 'connect.php';
$e=auth();$u=profile($e);$u['addresses']=query('SELECT id,full_name,phone,region,postal,street FROM addresses WHERE user_email=?','s',$e)->get_result()->fetch_all(MYSQLI_ASSOC);out($u);