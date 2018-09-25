<?php
$this->assign('title', 'つぶやき画面');
?>

<h2>いまなにしてる？<span class="fs12 index-message">140文字で入力してください。</span></h2>
<?= $this->Form->create(null,[
  'url' => ['controller'=>'Tweets', 'action'=>'add']
]); ?>
<?= $this->Form->control('body', ['required' => false, 'label'=> false, 'rows'=>['2']]); ?>
<?= $this->Form->hidden('user_id', ['value'=>$id]); ?>
<?= $this->Form->button('投稿する', ['class'=>'index-button']); ?>
<?= $this->Form->end(); ?>

<h2>ホーム</h2>
