<?php
/**
 * This file is part of the Mesour Nette Bridges (http://components.mesour.com)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette;

use Mesour\UI\Application;
use Nette\Application\LinkGenerator;
use Nette\Http\Session;


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
     * @param LinkGenerator $linkGenerator
     * @return Application
     */
    static public function createApplication($name, Session $session, LinkGenerator $linkGenerator)
    {
        $application = new Application($name);
        $application->setSession(new \Mesour\Bridges\Nette\Session($session));
        $application->setLink(new Link($linkGenerator));
        $application->setRequest($_REQUEST);
        $application->run();
        return $application;
    }

}
