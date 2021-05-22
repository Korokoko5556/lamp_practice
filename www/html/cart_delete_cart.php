<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$token = get_post('csrftoken');

if(is_valid_csrf_token($token) === false){
  set_error('不正なリクエストです。');

  redirect_to(CART_URL);
}

$cart_id = get_post('cart_id');

//セッションに保存しておいたトークンの削除
unset($_SESSION['csrftoken']);
//セッションの保存
session_write_close();
//セッションの再開
session_start();

if(delete_cart($db, $cart_id)){
  set_message('カートを削除しました。');
} else {
  set_error('カートの削除に失敗しました。');
}

redirect_to(CART_URL);