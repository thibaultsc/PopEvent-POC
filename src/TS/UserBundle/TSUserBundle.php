<?php

namespace TS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TSUserBundle extends Bundle
{
      public function getParent()
  {
    return 'FOSUserBundle';
  }
}
