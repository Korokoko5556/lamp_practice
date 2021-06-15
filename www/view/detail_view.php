<!DDOCTYPE html>
<html lang="ja">
    <head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
        <title>購入明細</title>
    </head>
    <body>
    <?php 
        //ファイル読み込み
        include VIEW_PATH . 'templates/header_logined.php'; 
    ?>
        

        <?php include VIEW_PATH.'templates/messages.php';?>
        
        
        <table border="1">
            <tr>
                <th>注文番号</th>
                <th>購入日時</th>
                <th>合計金額</th>
            </tr>
            
            <?php foreach($choice_details as $choice_detail){ ?>
            <tr>
                <td><?php print h($choice_detail['order_id']);?></td>
                <td><?php print h($choice_detail['created']);?></td>
                <td><?php print h($choice_detail['total']);?></td>
            </tr>

            <?php } ?>
        </table>

        

        <table border="1">
            <tr>
                <th>商品名</th>
                <th>購入時の商品価格</th>
                <th>購入数</th>
                <th>小計</th>
            </tr>

            <?php foreach($details as $detail){?>
                <tr>
                    <td><?php print h($detail['name']);?></td>
                    <td><?php print h($detail['price']);?></td>
                    <td><?php print h($detail['amount']);?></td>
                    <td><?php print h($detail['subtotal']);?></td>
                </tr>
            <?php } ?>

        </table>

    </body>
</html>