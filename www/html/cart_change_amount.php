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
$amount = get_post('amount');

//セッションに保存しておいたトークンの削除
unset($_SESSION['csrftoken']);
//セッションの保存
session_write_close();
//セッションの再開
session_start();

if(update_cart_amount($db, $cart_id, $amount)){
  set_message('購入数を更新しました。');
} else {
  set_error('購入数の更新に失敗しました。');
}

redirect_to(CART_URL);