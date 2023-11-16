<?php

namespace App\Helpers;

class HelpersValidator
{
  public static function CpfValidator($cpf)
  {
    // Remover caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verificar se possui 11 dígitos
    if (strlen($cpf) != 11) {
      return false;
    }

    // Verificar se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
    }

    // Calcular os dígitos verificadores
    for ($i = 9; $i < 11; $i++) {
      $sum = 0;
      for ($j = 0; $j < $i; $j++) {
        $sum += $cpf[$j] * (($i + 1) - $j);
      }
      $remainder = $sum % 11;
      $digit = ($remainder < 2) ? 0 : 11 - $remainder;
      if ($cpf[$i] != $digit) {
        return false;
      }
    }

    return true;
  }
}
