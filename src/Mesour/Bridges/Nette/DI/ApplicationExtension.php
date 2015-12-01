<?php
/**
 * This file is part of the Mesour Nette Bridges (http://components.mesour.com)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette\DI;

use Nette\DI\CompilerExtension;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class ApplicationExtension extends CompilerExtension
{

    protected $defaults = [
        'name' => 'mesourapp'
    ];

    public function loadConfiguration()
    {
        $config = $this->getConfig($this->defaults);
        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('mesourApplicationFactory'))
            ->setClass('Mesour\Bridges\Nette\ApplicationFactory');

        $builder->addDefinition($this->prefix('mesourApplication'))
            ->setFactory('Mesour\Bridges\Nette\ApplicationFactory::createApplication', [
                $config['name'], '@session', '@application'
            ]);
    }

}