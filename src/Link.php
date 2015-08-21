<?php
/**
 * This file is part of the Mesour Nette Bridges (http://components.mesour.com)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette;

use Mesour\Components\Link\ILink;
use Nette\Application\LinkGenerator;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class Link implements ILink
{

    /**
     * @var LinkGenerator
     */
    private $linkGenerator;

    public function __construct(LinkGenerator $linkGenerator)
    {
        $this->linkGenerator = $linkGenerator;
    }

    public function link($destination, $args = array())
    {
        return $this->linkGenerator->link($destination, $args);
    }

    public function create($destination, $args = array())
    {
        return new Url($this, $destination, $args);
    }

}
