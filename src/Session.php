<?php
/**
 * This file is part of the Mesour Nette Bridges (http://components.mesour.com)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette;

use Mesour\Components\Helper;
use Mesour\Components\InvalidArgumentException;
use Mesour\Components\Session\ISession;
use Mesour\Components\Session\ISessionSection;
use Nette\Http;



/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class Session implements ISession
{

    /**
     * @var Http\Session
     */
    private $session;

    private $sections = array();

    public function __construct(Http\Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param $section
     * @return ISessionSection
     * @throws InvalidArgumentException
     */
    public function getSection($section)
    {
        if (!Helper::validateKeyName($section)) {
            throw new InvalidArgumentException('SessionSection name must be integer or string, ' . gettype($section) . ' given.');
        }
        $this->sections[$section] = $section;
        return new SessionSection($this->session->getSection($section));
    }

    public function hasSection($section)
    {
        return isset($this->sections[$section]);
    }

    public function destroy()
    {
        $this->session->destroy();
    }

    public function loadState()
    {

    }

    public function saveState()
    {

    }

}
