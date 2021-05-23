<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

if(is_logined() === true){
  redirect_to(HOME_URL);
}

$name = get_post('name');
$password = get_post('password');

$db = get_db_connect();

$token = get_post('csrftoken');

if(is_valid_csrf_token($token) === false){
  set_error('不正なリクエストです。');

  redirect_to(HOME_URL);
}

//セッションに保存しておいたトークンの削除
unset($_SESSION['csrf_token']);
//セッションの保存
session_write_close();
//セッションの再開
session_start();

$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}

set_message('ログインしました。');
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
redirect_to(HOME_URL);