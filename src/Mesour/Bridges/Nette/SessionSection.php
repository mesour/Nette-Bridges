<?php
/**
 * This file is part of the Mesour Nette Bridges (http://components.mesour.com)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette;

use Mesour;
use Nette\Http;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class SessionSection implements Mesour\Components\Session\ISessionSection
{

    /**
     * @var Http\SessionSection
     */
    private $sessionSection;

    public function __construct(Http\SessionSection $sessionSection)
    {
        $this->sessionSection = $sessionSection;
    }

    public function remove()
    {
        $this->sessionSection->remove();
    }

    public function set($key, $val)
    {
        if (!Mesour\Components\Utils\Helpers::validateKeyName($key)) {
            throw new Mesour\InvalidArgumentException('SessionSection name must be integer or string, ' . gettype($key) . ' given.');
        }
        $this->sessionSection[$key] = $val;
        return $this;
    }

    public function get($key = NULL, $default = NULL)
    {
        if (!isset($this->sessionSection[$key])) {
            return $default;
        }
        return $this->sessionSection[$key];
    }

    public function loadState($data)
    {
        //do nothing, loaded by nette
    }

}
