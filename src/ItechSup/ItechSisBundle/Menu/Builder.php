<?php
namespace ItechSup\ItechSisBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        /**
         * Eleves
         */
        $menu->addChild('Elèves', array('route' => 'student'))
            ->setAttribute('icon', 'fa fa-list');
        
        /**
         * Enseignants
         */
        $menu->addChild('Enseignants', array('route' => 'teacher'))
            ->setAttribute('icon', 'fa fa-list');
        
        /**
         * Classes
         */
        $menu->addChild('Classes', array('route' => 'formation'))
            ->setAttribute('icon', 'fa fa-list');
        
        /**
         * Configuration
         */
        $menu->addChild('Configuration')
            ->setAttribute('icon', 'fa fa-list')
            ->setAttribute('dropdown', true);
        
        $menu['Configuration']->addChild('Salles', array('route' => 'room'))
            ->setAttribute('icon', 'fa fa-list');
        
        $menu['Configuration']->addChild('Cursus', array('route' => 'formation'))
            ->setAttribute('icon', 'fa fa-list');

        $menu['Configuration']->addChild('Ecoles', array('route' => 'school'))
            ->setAttribute('icon', 'fa fa-list');

        $menu['Configuration']->addChild('Fermeture', array('route' => 'closingday'))
            ->setAttribute('icon', 'fa fa-list');

        return $menu;
    }
}