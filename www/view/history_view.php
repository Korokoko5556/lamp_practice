<!DOCTYPE html>
<html lang ="ja">
    <head>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <title>購入履歴</title>
    </head>
    <body>
    <?php 
        //ファイル読み込み
        include VIEW_PATH . 'templates/header_logined.php'; 
    ?>
        <h2>購入履歴</h2>
        <?php include VIEW_PATH.'templates/messages.php';?>

        <?php if(!empty($histories)){ ?>
            
            <table border="1"> 
                <tr>
                    <th>注文番号</th>
                    <th>購入日時</th>
                    <th>合計金額</th>
                    <th></th>

                </tr>
                
                <?php foreach($histories as $history){ ?>
                    <tr>
                        
                        <td><?php print h($history['order_id']);?></td>
                        <td><?php print h($history['created']);?></td>
                        <td><?php print h($history['total']);?></td>
                        <td>
                            <form method="POST" action="detail.php">
                                <input type="submit" value="購入明細表示">
                                <input type="hidden" name="order_id" value="<?php print($history['order_id']);?>">
                                <input type="hidden" name="csrftoken" value="<?php print $token; ?>">
                            </form>
                        </td>
                    </tr>
                                
                <?php } ?>
            </table>

        <?php }else{ ?>
            <p>購入履歴がありません。</p>
        <?php } ?> 

    </body>
</html>