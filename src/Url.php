<?php
/**
 * This file is part of the Mesour Nette Bridges (http://components.mesour.com)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette;

use Mesour\Components;



/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 *
 * @property-read Link $link
 */
class Url extends Components\Link\Url
{
    /** @var Link */
    protected $link;

    protected function createUrl()
    {
        return $this->link->link($this->destination, $this->args);
    }

}
