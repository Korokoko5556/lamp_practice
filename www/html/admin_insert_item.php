<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

$db = get_db_connect();

$user = get_login_user($db);

if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}


$token = get_post('csrftoken');

/*POSTで送られてきたtokenとセッションに登録されているtokenを照合
$tokenが空文字ならfalse
*/
if(is_valid_csrf_token($token) === false){
  set_error('不正なリクエストです。');

  redirect_to(ADMIN_URL);
}
  $name = get_post('name');
  $price = get_post('price');
  $status = get_post('status');
  $stock = get_post('stock');
  
  $image = get_file('image');

  //セッションに保存しておいたトークンの削除
  unset($_SESSION['csrf_token']);
  //セッションの保存
  session_write_close();
  //セッションの再開
  session_start();

if(regist_item($db, $name, $price, $stock, $status, $image)){
  set_message('商品を登録しました。');
}else {
  set_error('商品の登録に失敗しました。');
}


redirect_to(ADMIN_URL);