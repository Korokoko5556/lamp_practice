<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'functions.php';
require_once MODEL_PATH.'user.php';
require_once MODEL_PATH.'item.php';
require_once MODEL_PATH.'cart.php';
require_once MODEL_PATH.'history.php';

session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$histories = get_history($db,$user['user_id'],$user['type']);

$order_id = get_post('order_id');

$token = get_csrf_token();

if(is_valid_csrf_token($token) === false){
    set_error('不正なリクエストです。');
  
    redirect_to(CART_URL);
  }
  
  //セッションに保存しておいたトークンの削除
  unset($_SESSION['csrf_token']);
  //セッションの保存
  session_write_close();
  //セッションの再開
  session_start();

include_once VIEW_PATH.'history_view.php';