<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;



class TweetsTable extends Table {

  public function initialize(array $config) {
    $this->addBehavior('Timestamp');
    $this->belongsTo('Users');
  }

  public function validationDefault(Validator $validator) {

    $validator->notEmpty('body')
              ->requirePresence('body')
              ->maxLength('body', 140);
    return $validator;
  }
}
?>
