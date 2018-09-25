<?php
$this->assign('title', 'ユーザー登録完了');
?>
<div class="main-container">
  <div class="top-container">
    <h1>ついったーに参加しました。</h1>
    <p><?= $user['user_name']; ?>さんはついったーに参加されました。</p>
    <p>ログインをクリックしてログインしつぶやいてください。</p>
    <div class="top-container-link">
      <?= $this->Html->link('twitterにログイン', ['controller'=>'Users', 'action'=>'login']); ?>
    </div>
  </div>
</div>
