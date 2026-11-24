<?php
ini_set('display_errors','0'); ini_set('log_errors','1');
header('Cache-Control: no-store'); header('X-Content-Type-Options: nosniff'); header('Referrer-Policy: no-referrer'); header('X-Frame-Options: DENY');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; img-src 'self' data: https://storage.googleapis.com; media-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; frame-ancestors 'none'; form-action 'self'");
$cloud = getenv('WEBSITE_SITE_NAME') || getenv('APP_ENV') === 'production';
ini_set('session.use_strict_mode','1'); ini_set('session.use_only_cookies','1');
session_set_cookie_params(['httponly'=>true,'secure'=>$cloud || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),'samesite'=>'Lax','path'=>'/']); session_start();
if (isset($_SESSION['seen']) && time()-$_SESSION['seen']>1800) { $_SESSION=[]; session_regenerate_id(true); }
$_SESSION['seen']=time(); $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
function out($v,$status=200){http_response_code($status);header('Content-Type: application/json');echo json_encode($v);exit;}
function fail($m,$s=400){out(['success'=>false,'error'=>$m,'message'=>$m],$s);}
set_exception_handler(function($e){error_log(get_class($e).': application request failed');fail('Service unavailable.',500);});
function auth(){if(empty($_SESSION['email']))fail('Sign in required.',401);return $_SESSION['email'];}
function post(){if($_SERVER['REQUEST_METHOD']!=='POST')fail('Method not allowed.',405);if(!hash_equals($_SESSION['csrf'],$_SERVER['HTTP_X_CSRF_TOKEN']??''))fail('Invalid request token.',403);if((int)($_SERVER['CONTENT_LENGTH']??0)>1500000)fail('Request too large.',413);$d=json_decode(file_get_contents('php://input'),true);return is_array($d)?$d:$_POST;}
function field($d,$k,$max,$required=true){$v=$d[$k]??'';if(!is_string($v))fail('Invalid field.');$v=trim($v);if(strlen($v)>$max||($required&&$v===''))fail('Invalid '.$k.'.');return $v;}
function passwordInput($d,$k){$v=$d[$k]??null;if(!is_string($v)||strlen($v)<12||strlen($v)>72)fail('Use a password of 12–72 bytes.');return $v;}
function query($sql,$types='',...$args){global $conn;$s=$conn->prepare($sql);if($types)$s->bind_param($types,...$args);$s->execute();return $s;}
function profile($email){$u=query('SELECT id, firstName,lastName,username,email,phone,profileImage FROM users WHERE email=?','s',$email)->get_result()->fetch_assoc();if(!$u)fail('Sign in required.',401);return $u;}
function throttle($key){$now=time();$a=$_SESSION[$key]??[];$a=array_values(array_filter($a,fn($t)=>$t>$now-300));if(count($a)>=5)fail('Try again in five minutes.',429);$a[]=$now;$_SESSION[$key]=$a;}
