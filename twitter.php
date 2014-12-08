<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>もっと読む</title>
    <script scr="http://code.jquery.com/jquery-1.10.2.min.js"></script>
</head>
<body>

<?php

// TwitterOAuthとはTwitterによる認証方式である。
// TwitterOAuthを使うとサイトのログインに使用できる
// ログインしたユーザーのTwitter情報を利用できる
require_once("twitteroauth/twitteroauth.php");

$consumerKey = "";
$consumerSecret = "";
$accessToken = "";
$accessTokenSecret = "";

// コンシューマキー、コンシューマシークレッ、アクセストークン、アクセスシークレットを使ってTwitterOAuthを生成する。
// TwitterOAuthクラスをnew演算子クラスでインスタンス化すして、変数$twObjに代入する
$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

// OAuthRequestプロパティで、特定のユーザーのつぶやき（json形式）を、"GET"で10件取得する
// 取得出来るデータはjson形式のみ
// 変数$twObjからOAuthRequestプロパティを呼び出し、変数$reqに代入する
$req = $twObj->OAuthRequest("https://api.twitter.com/1.1/statuses/user_timeline.json","GET",array("count"=>"10"));

// json形式のつぶやきデータをTwitterAPIから取得して変数$tw_arrに代入する
$tw_arr = json_decode($req);

// つぶやきのテキストとつぶやかれた日時を表示する
// created_atでは、Twitter APIで取得した投稿日をUNIXタイムスタンプに変更し、date()関数で読みやすい日時に変換する

if (isset($tw_arr)) {
    foreach ($tw_arr as $key => $val) {
        echo $tw_arr[$key]->text;
        echo date('Y-m-d H:i:s', strtotime($tw_arr[$key]->created_at));
        echo '<br>';
    }
} else {
    echo 'つぶやきはありません。';
}

$req = $twObj->OAuthRequest('https://api.twitter.com/1.1/statuses/user_timeline.json','GET',array('count'=>'10'));
echo $_GET['callback'] . '(' . $req. ')';

?>
</body>
</html>