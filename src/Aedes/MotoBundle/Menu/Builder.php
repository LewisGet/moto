<?php

namespace Aedes\MotoBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class Builder extends ContainerAware
{
    protected $factory;
    protected $securityContext;

    /**
     * @param FactoryInterface         $factory
     * @param SecurityContextInterface $securityContext
     */
    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext) {
        $this->factory = $factory;
        $this->securityContext = $securityContext;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('買機車', array('route' => 'moto'));
        $menu->addChild('刊登機車', array('route' => 'moto_new'));

        $isLogin = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');

        if (! $isLogin)
        {
            $menu->addChild('註冊', array('route' => 'fos_user_registration_register'));
            $menu->addChild('登入', array('route' => 'fos_user_security_login'));
        }
        else
        {
            $menu->addChild('我刊登的機車', array('route' => 'my_moto'));
            $menu->addChild('新增圖片', array('route' => 'image_new'));
            $menu->addChild('圖片管理', array('route' => 'image'));
            $menu->addChild('會員資料', array('route' => 'fos_user_profile_edit'));
            $menu->addChild('登出', array('route' => 'fos_user_security_logout'));
        }

        return $menu;
    }
}