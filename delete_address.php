<?php
require 'bootstrap.php'; auth(); require 'connect.php';
$e=auth();$d=post();$id=filter_var($d['id']??null,FILTER_VALIDATE_INT);if(!$id)fail('Invalid address.');$s=query('DELETE FROM addresses WHERE id=? AND user_email=?','is',$id,$e);if(!$s->affected_rows)fail('Address not found.',404);out(['success'=>true]);