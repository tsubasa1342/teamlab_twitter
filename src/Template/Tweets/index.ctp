<?php
$this->assign('title', 'つぶやき画面');
?>
<div class="main-container">
  <?php if ($id == null): ?>
    <h2>いまなにしてる？
      <?php if (isset($error)): ?>
        <span class="fs12 index-message">140文字で入力してください。</span>
      <?php endif ?>
    </h2>
    <div class="tweet-form">
      <?= $this->Form->create($tweet); ?>
      <?= $this->Form->control('body', ['required' => false, 'label'=> false, 'rows'=>['2']]); ?>
      <?= $this->Form->hidden('user_id', ['value'=>$auth_id]); ?>
    <ul>
      <?php foreach($tweets as $tweet): ?>
        <li>
          <div class="result-user-name">
            <?= '最新のつぶやき：', nl2br($this->Text->autoLinkUrls(h($tweet['body']))); ?>
          </div>
          <div class="clear">

          </div>
          <div class="result-tweet-created">
            <?= h($tweet->created->year), '年', h($tweet->created->month), '月', h($tweet->created->day), '日', h($tweet->created->hour), '時', h($tweet->created->minute), '分', h($tweet->created->second), '秒'; ?>
          </div>
        </li>
      <?php break ?>
      <?php endforeach ?>
    </ul>
    <?= $this->Form->button('投稿する', ['class'=>'index-button']); ?>
    <?= $this->Form->end(); ?>
    </div>
  <?php endif ?>
  <h2>ホーム</h2>

  <div class="index">
    <ul>
      <?php foreach($tweets as $tweet): ?>
        <li class="result-list">
          <div class="result-user-name">
            <?= $this->Html->link($tweet->user->user_name, ['controller' => 'Tweets', 'action' => 'index', $tweet->user->id]); ?>
            <?php if ($tweet->user->user_name == $auth['user_name']): ?>
              <div class="tweet-delete">
                <?=
                  $this->Form->postLink(
                    '<i class="far fa-trash-alt"></i>',
                    ['controller' => 'Tweets', 'action' => 'delete', $tweet->id],
                    ['confirm' => 'Sure you want to delete this tweet? There is NO undo!', 'escape' => false, 'class' => 'fs12']);
                ?>
              </div>
            <?php endif ?>
            <?= nl2br($this->Text->autoLinkUrls(h($tweet['body']))); ?>
          </div>
          <div class="clear">

          </div>
          <div class="result-tweet-created">
            <?= h($tweet->created->year), '年', h($tweet->created->month), '月', h($tweet->created->day), '日', h($tweet->created->hour), '時', h($tweet->created->minute), '分', h($tweet->created->second), '秒'; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>


    <div class="auth-data">
      <ul>
        <?= h($auth['user_name']); ?>
        <div class="clear">

        </div>
        <li>
          <div class="count">
            <?= h($follows_count); ?>
          </div>
          <div class="">
            <?= $this->Html->link('フォローしている', ['controller' => 'users', 'action' => 'follow', 'follow']); ?>
          </div>
        </li>
        <li>
          <div class="count">
           <?= h($followers_count); ?>
          </div>
          <div class="count">
            <?= $this->Html->link('フォローされている', ['controller' => 'users', 'action' => 'follow', 'follower']); ?>
          </div>
        </li>
        <li>
          <div class="count">
            <?= h($tweets_count); ?>
          </div>
          <div class="count">
            <?= $this->Html->link('投稿数', ['controller' => 'Tweets', 'action' => 'index', $auth_id]); ?>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="clear">

  </div>

  <div class="paginator">
    <ul class="pagination">
      <?php if ($this->Paginator->hasPrev()): ?>
        <?= $this->Paginator->prev('<<前へ') ?>
      <?php endif ?>
      <?php if ($this->Paginator->hasNext()): ?>
        <?= $this->Paginator->next('次へ>>') ?>
      <?php endif ?>
    </ul>
  </div>
</div>
