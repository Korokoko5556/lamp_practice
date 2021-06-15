<?php
require_once MODEL_PATH.'functions.php';
require_once MODEL_PATH.'db.php';

//ユーザーごとの購入履歴

function get_history($db,$user_id){

    if($user_id !== 4){
        $where = 'WHERE user_id = ?';
        $array = array($user_id);
    }else{
        $where = '';
        $array = [];
    }

    $sql = "
    SELECT
        history.order_id,
        history.created,
        SUM(purchase_details.price * purchase_details.amount) AS total
    FROM
        history
    JOIN
        purchase_details
    ON
        history.order_id = purchase_details.order_id
    
        {$where}

    GROUP BY
        order_id
    ORDER BY
        created desc
        ";

    
    
    return fetch_all_query($db,$sql,$array);
}