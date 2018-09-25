<?php
$this->assign('title', 'フォロー者一覧');
?>

<div class="search-container">
  <ul>
    <?php foreach ($follows as $follow): ?>
      <li class="result-list">
        <div class="result-user-name">
          <?php echo $follow; ?>
          <?= $this->Html->link($follow->follow_name, ['controller' => 'Tweets', 'action' => 'index', ); ?>
        </div>
        <div class="result-name">
          <?= $index['name'] ?>
        </div>
        <div class="clear">

        </div>
          <div class="result-body">
            <?php if ($tweets->user_id->follow_name): ?>
              <?php foreach ($tweets->follow_name as $tweet): ?>
                <div class="result-tweet-body">
                  <?= nl2br($this->Text->autoLinkUrls(h($tweet->body))); ?>
                </div>
                <div class="result-tweet-created">
                  <?= h($tweet->created->year), '年', h($tweet->created->month), '月', h($tweet->created->day), '日', h($tweet->created->hour), '時', h($tweet->created->minute), '分', h($tweet->created->second), '秒'; ?>
                </div>
              <?php break; ?>
            <?php endforeach; ?>
          <?php endif ?>
          </div>
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
</div>
