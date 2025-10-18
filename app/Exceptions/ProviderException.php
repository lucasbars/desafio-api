<?php

namespace App\Exceptions;

use Exception;

class ProviderException extends Exception
{
  public function __construct($provider, $message)
  {
    parent::__construct("Falha no provider {$provider}: {$message}");
  }
}
