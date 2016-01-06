<?php
/**
 * This file is part of the Mesour Nette Bridges (http://components.mesour.com)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette;

use Mesour\UI;
use Nette\Application\IPresenter;
use Nette\Application\IPresenterFactory;
use Nette\Application\PresenterFactory;
use Nette\Application\Request;
use Nette\Application\UI\Presenter;
use Nette\DI\Container;
use Nette\Http\Session;
use Nette\Application\Application;
use Mesour;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 *
 * @property-read Link $link
 */
class ApplicationFactory
{

    /**
     * @param $name
     * @param Session $session
     * @return UI\Application
     * @throws Mesour\InvalidStateException
     */
    static public function createApplication($name, Session $session)
    {
        $application = new UI\Application($name);
        $application->setSession(new Mesour\Bridges\Nette\Session($session));
        $application->setRequest($_REQUEST);
        $application->run();
        return $application;
    }

}
