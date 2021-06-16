--現在ログイン中のユーザーの購入履歴を表形式で一覧表示する。
--ただし、管理者ユーザーについては全ての購入履歴を表形式で一覧表示する。
--表示項目は「注文番号」「購入日時」「該当の注文の合計金額」とする。
--注文番号は、購入完了のたびにオートインクリメントで付番されるものとする。
--各行の末尾に「購入明細表示」のボタンを配置する。
--ソート順は注文の新着順とする。


--該当の注文番号の購入明細を表形式で一覧表示する。
--表示項目は「商品名」「購入時の商品価格」 「購入数」「小計」とする。
--画面上部に該当の「注文番号」「購入日時」「合計金額」を表示する。
--ログインしているユーザー以外の注文については、管理者以外は閲覧できないものとする。


--購入履歴画面ページ 表示項目は「注文番号」「購入日時」「該当の注文の合計金額」
--購入明細画面ページ　表示項目は表示項目は「商品名」「購入時の商品価格」 「購入数」「小計」




--テーブルの構造 'history' 
--ENGINE=InnoDB DEFAULT CHARSET=utf8は文字コードを個別に定義しなかった場合の省略パターン
CREATE TABLE 'history'(
    'order_id' int(11) NOT NULL AUTO_INCREMENT,
    'user_id' int(11) NOT NULL,
    'created' datetime NOT NULL DEFAULT　CURRENT_TIMESTAMP,
    primary key('order_id');
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

--購入明細テーブル
--主キー以外の項目に依存している情報をpurchased_itemsに分離
--itemsテーブルとpurchse_detailsを結合(商品名が必要)
CREATE TABLE 'purchase_details'(
    'order_id' int(11) NOT NULL,
    'item_id' int(11) NOT NULL,
    'amount' int (11) NOT NULL,
    'price' int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;