<?php

namespace WANGARDEN\UserBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Request;


class WANGARDENUserBundle extends Bundle

{
  public function getParent()
  {
    return 'FOSUserBundle';
  }

}
