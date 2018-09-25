<?php
namespace App\Model\Validation;
use Cake\Validation\Validation;


class CustomValidation extends Validation {

  public static function alphaNumericCustom($check) {
    return (bool) preg_match('/^[-_a-zA-Z0-9あ-ん]+$/', $check);
  }

  public static function ValidationCustom($check) {
    return (bool) preg_match('/^[-_a-zA-Z0-9]+$/', $check);
  }

  public static function CustomValidation($check) {
    return (bool) preg_match('/^[a-zA-Z0-9]+$/', $check);
  }
}
