<?php


$error_message =  array ();         //エラーメッセージを格納する配列を作成
if (isset($_POST ['confirm'])) {    //データがセットされていたら各変数にPOSTのデータを格納
    
    if ($_POST ['name']!=="" AND strlen($_POST['name'])<=32) {
        $name = htmlspecialchars($_POST['name'],ENT_QUOTES);
    //各データがなかったらエラーメッセージを配列に格納
    }elseif(strlen($_POST['name'])>32){
        $error_message[] = "文字数が多すぎます（全角16字以内にして下さい）。<br>";
    }elseif(empty($_POST['name'])){
        $error_message[] = "名前を入力してください<br>";
    }

    if ($_POST['email']!=="") {
        $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
    }else{
        $error_message[] = "メールアドレスを入力してください。<br>";
    }
  }

  $page_flag=0;

if( !empty($_POST['confirm']) AND !count($error_message)) {  //confirmが空でなければ
    $page_flag = 1;
    
}elseif( !empty($_POST['btn_submit'])) {

    $page_flag = 2;
    }
?>

<!DOCTYPE>
<html lang="ja">
<head>
<title>お問い合わせフォーム</title>
</head>
<body>
<h1>お問い合わせフォーム</h1>
<?php
//ここに記述することでhtml内でerror_messageを表示させる
if (count($error_message)) {
    foreach ($error_message as $message){
       echo "<font color='red'>$message</font>";
    }
}        
?>
<p></p>
<?php if( $page_flag === 1){?>
    
<form method="post" action="">
	<div class="element_wrap">
		<label>名前</label>
		<p><?php echo $_POST['name']; ?></p>
	</div>
  <div class="element_wrap">
		<label>カナ</label>
		<p><?php echo $_POST['kana']; ?></p>
	</div>
  <div class="element_wrap">
		<label>電話</label>
		<p><?php echo $_POST['telephone']; ?></p>
	</div>
  <div class="element_wrap">
		<label>mail</label>
		<p><?php echo $_POST['email']; ?></p>
	</div>
  <div class="element_wrap">
		<label>生まれ年</label>
		<p><?php echo $_POST['birth_year']; ?></p>
	</div>
  <div class="element_wrap">
		<label>性別</label>
		<p><?php echo $_POST['sex']; ?></p>
	</div>
  <div class="element_wrap">
		<label>メールマガジン送付</label>
		<p><?php echo $_POST['mail_magazine']; ?></p>
	</div>

	<button type="submit" name="btn_back" value="戻る">戻る</button>
	<button type="submit" name="btn_submit" value="送信">送信</button>
	<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
  <input type="hidden" name="kana" value="<?php echo $_POST['kana']; ?>">
  <input type="hidden" name="telephone" value="<?php echo $_POST['telephone']; ?>">
  <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
  <input type="hidden" name="birth_year" value="<?php echo $_POST['birth_year']; ?>">
  <input type="hidden" name="sex" value="<?php echo $_POST['sex']; ?>">
  <input type="hidden" name="mail_magazine" value="<?php echo $_POST['mail_magazine']; ?>">


</form>
<?php }elseif( $page_flag === 2 ){ ?>

<p>送信が完了しました。</p>


<?php }else{ ?>

<form method="post" action="">
<label for ="name">※名前</label>
    <input type ="text" name="name" 
           value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>">
    <p></p>
    <label for ="kana">カナ</label>
    <input type ="text" name="kana"
           value="<?php if( !empty($_POST['kana']) ){ echo $_POST['kana']; } ?>">
    <p></p>
    <label for ="telephone">電話</label>
    <input type ="tel" name="telephone"
           value="<?php if( !empty($_POST['telephone']) ){ echo $_POST['telephone']; } ?>">
    <p></p>
    <label for ="email">※mail</label>
    <input type ="email" name="email"
           value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>">
    <p></p>
    <label for ="birth_year">生まれ年</label>
    <?php $year=date('Y');?>
    <select name="birth_year" value="birth_year">
     <option value="">--</option>
      <?php
        for($i=1900 ; $i<=$year; $i++){
            $selected="";
          if($i==$_POST['birth_year']){
            $selected='selected';
          }  
          echo "<option $selected value='$i'>$i</option>";
        }
      ?>
    </select>
    <p></p>
    <label for ="sex">性別</label>
    <?php
      $checked1="";
      $checked2="";

    if(isset($_POST['sex'])){
      if($_POST['sex']=="男"){
      $checked1='checked';
      }else{
      $checked2='checked';
      }
    }
    ?>
    <input type ="radio" name="sex" value="男" <?= $checked1 ?>>男
    <input type ="radio" name="sex" value="女" <?= $checked2 ?>>女
    <p></p>
    <label for ="mail_magazine">メールマガジン送付</label>
    <?php
    $checked3="";
    if(isset($_POST['mail_magazine'])){
     if($_POST['mail_magazine']){
      $checked3='checked';
     }
    }
    ?>
    <input type ="checkbox" name="mail_magazine" value="送付する"<?=$checked3 ?>>
    <p></p>
    <button type ="submit" name="confirm" value="登録">登録</button>
</form>

    <?php } ?>

</body>
</html>