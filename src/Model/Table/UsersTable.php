<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;



class UsersTable extends Table {

  public function initialize(array $config) {
    $this->addBehavior('Timestamp');
    $this->hasMany('Tweets');
    $this->hasMany('Follows');
  }

  public function validationDefault(Validator $validator) {

    $validator->provider('ProviderKey', 'App\Model\Validation\CustomValidation');

    $validator->notEmpty('name', '名前を入力してください')
              ->requirePresence('name')
              ->lengthBetween('name', [4, 20], '名前は４文字以上２０文字以下で入力してください。')
              ->add('name', 'ruleName', [
                'rule' => ['alphaNumericCustom'],
                'provider' => 'ProviderKey',
                'message' => '名前は半角英数字、全角文字、_(アンダーバー)、-(ハイフン)、で入力してください。'
              ]);
    $validator->notEmpty('user_name', 'ユーザー名を入力してください。')
              ->requirePresence('user_name')
              ->lengthBetween('user_name', [4, 20], 'ユーザー名は４文字以上２０文字以下で入力してください。')
              ->add('user_name', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => '入力したユーザーはすでに存在しています。'
              ])
              ->add('user_name', 'ruleName', [
                'rule' => ['ValidationCustom'],
                'provider' => 'ProviderKey',
                'message' => 'ユーザー名は半角英数字、_(アンダーバー)、-(ハイフン)、で入力してください。'
              ]);
    $validator->notEmpty('password', 'パスワードを入力して下ささい。')
              ->requirePresence('password')
              ->lengthBetween('password', [4, 8], 'パスワードは４文字以上８文字以下で入力してください。')
              ->add('password', 'ruleName', [
                'rule' => ['CustomValidation'],
                'provider' => 'ProviderKey',
                'message' => 'パスワードは半角英数字で入力してください。'
              ]);
    $validator->notEmpty('password_confirm', 'パスワード(確認)を入力して下ささい。')
              ->sameAs('password_confirm', 'password', 'パスワードと一致させてください。')
              ->add('password_confirm', 'ruleName', [
                'rule' => ['CustomValidation'],
                'provider' => 'ProviderKey',
                'message' => 'パスワード(確認)は半角英数字で入力してください。'
              ]);
    $validator->notEmpty('email_adress', 'メールアドレスを入力してください。')
              ->requirePresence('email_adress')
              ->maxLength('email_adress', 100, 'メールアドレスは１００文字以下で入力してください。')
              ->add('email_adress',[
                'email_adress' => [
                  'rule' => ['email'],
                  'message' => 'メールアドレスを正しく入力してください。'
                ]
              ]);
    return $validator;
  }


}
?>
