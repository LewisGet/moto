<?php

namespace Aedes\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AedesUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
