<?php

function get_detail($db,$order_id){
    $sql ="
        SELECT
            purchase_details.price,
            purchase_details.amount,
            history.created,
            (purchase_details.price * purchase_details.amount) AS subtotal,
            items.name
        FROM
            history
        JOIN
            purchase_details
        ON
            history.order_id = purchase_details.order_id
        JOIN
            items
        ON
            purchase_details.item_id = items.item_id
        WHERE
            history.order_id = ?
        
        ";
        
        return fetch_all_query($db,$sql,array($order_id));
}

function get_ranking($db){
    try{

        $sql = "
        SELECT
        items.name,
        items.image,
        SUM(purchase_details.amount) AS item_sum
        FROM 
        purchase_details
        JOIN
        items
        ON
        purchase_details.item_id = items.item_id
        GROUP BY
        purchase_details.item_id
        ORDER BY
        item_sum DESC
        LIMIT
        3
        ";
        
        $statment = $db->prepare($sql);
        $statment->execute();
        
        return $statment->fetchAll();
    }catch(PDOException $e){
        set_error('データ取得に失敗しました。');
    }
    return false;
}

function get_choice_details($db,$order_id){
    
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
        
        WHERE
            history.order_id = ?
    
        GROUP BY
            order_id
        ORDER BY
            created desc
            ";

        
        
        return fetch_all_query($db,$sql,array($order_id));
    
}