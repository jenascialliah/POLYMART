<?php
require 'bootstrap.php'; auth(); require 'connect.php';
$e=auth();$d=post();query('INSERT INTO addresses(user_email,full_name,phone,region,postal,street) VALUES(?,?,?,?,?,?)','ssssss',$e,field($d,'fullName',255),field($d,'phone',20),field($d,'region',255),field($d,'postal',20),field($d,'street',500));out(['success'=>true]);