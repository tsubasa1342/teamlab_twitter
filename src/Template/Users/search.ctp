<?php
$this->assign('title', 'ユーザー検索');
?>

<div class="search-container">
  <h2>友達を見つけて、フォローしましょう！</h2>
  <p id="search-first-p">ついったーに登録済みの友達を検索できます。</p>
  <p>誰を検索しますか？</p>
  <div class="search-form-container" >
    <?= $this->Form->create(null, ['type' => 'get']); ?>
    <?= $this->Form->control('input', ['label'=>false, 'class'=>'search-form', 'id'=>'search-button', 'value' => $this->request->query('input')]) ?>
    <?= $this->Form->button('検索', ['class'=>'search-form']) ?>
    <?= $this->Form->end(); ?>
  </div>
  <div class="clear">

  </div>
  <p>ユーザ名や名前で検索</p>
  <?php if (isset($users)): ?>
    <?php if ($users->isEmpty()): ?>
      <h3 class="not-found">対象のユーザーはみつかりません。</h3>
    <?php endif; ?>
  <ul>
    <?php foreach ($users as $user): ?>
      <li class="result-list">
        <div class="result-user-name">
          <?= $this->Html->link($user->user_name, ['controller' => 'Tweets', 'action' => 'index', $user->id]); ?>
        </div>
        <div class="result-name">
          <?= $user['name'] ?>
        </div>
        <?php $count = 0; ?>
        <?php foreach ($auth_follows as $auth_follow) {
                if ($auth_follow['follow_id'] == $user['id']) {
                  $count += 1;
                }
              }
        ?>
        <?php if ($user['id'] != $auth['id'] && $count == 0): ?>
          <?= $this->Form->create(null, ['url' => ['controller'=>'Follows', 'action'=>'follow']]); ?>
          <?= $this->Form->hidden('user_id', ['value'=>$auth['id']]); ?>
          <?= $this->Form->hidden('name', ['value'=>$auth['name']]); ?>
          <?= $this->Form->hidden('user_name', ['value'=>$auth['user_name']]); ?>
          <?= $this->Form->hidden('follow_id', ['value'=>$user['id']]); ?>
          <?= $this->Form->hidden('follow_name', ['value'=>$user['name']]); ?>
          <?= $this->Form->hidden('follow_user_name', ['value'=>$user['user_name']]); ?>
          <?= $this->Form->button('follow'); ?>
          <?= $this->Form->end(); ?>
        <?php endif ?>
        <div class="clear">

        </div>
        <?php if (count($user->tweets)): ?>
          <div class="result-body">
            <?php foreach ($user->tweets as $tweet) : ?>
              <div class="result-tweet-body">
                <?= nl2br($this->Text->autoLinkUrls(h($tweet->body))); ?>
              </div>
              <div class="result-tweet-created">
                <?= h($tweet->created->year), '年', h($tweet->created->month), '月', h($tweet->created->day), '日', h($tweet->created->hour), '時', h($tweet->created->minute), '分', h($tweet->created->second), '秒'; ?>
              </div>
            <?php break; ?>
          <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <div class="paginator">
    <ul class="pagination">
      <?php if ($this->Paginator->hasPrev()): ?>
        <?= $this->Paginator->prev('<<前へ'); ?>
      <?php endif ?>
      <?php if ($this->Paginator->hasNext()): ?>
        <?= $this->Paginator->next('次へ>>'); ?>
      <?php endif ?>
    </ul>
  </div>
  <?php endif ?>
</div>
