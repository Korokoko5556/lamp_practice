<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();

$user = get_login_user($db);

if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}

$token = get_post('csrftoken');

if(is_valid_csrf_token($token) === false){
  set_error('不正なリクエストです。');

  redirect_to(ADMIN_URL);
}

$item_id = get_post('item_id');
$changes_to = get_post('changes_to');

//セッションに保存しておいたトークンの削除
unset($_SESSION['csrftoken']);
//セッションの保存
session_write_close();
//セッションの再開
session_start();

if($changes_to === 'open'){
  update_item_status($db, $item_id, ITEM_STATUS_OPEN);
  set_message('ステータスを変更しました。');
}else if($changes_to === 'close'){
  update_item_status($db, $item_id, ITEM_STATUS_CLOSE);
  set_message('ステータスを変更しました。');
}else {
  set_error('不正なリクエストです。');
}


redirect_to(ADMIN_URL);