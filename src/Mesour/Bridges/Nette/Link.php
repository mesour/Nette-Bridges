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
use Nette\Application\IPresenter;
use Nette\Application\UI\Presenter;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class Link implements Mesour\Components\Link\ILink
{

    /**
     * @var IPresenter
     */
    private $presenter;

    public function __construct(Presenter $presenter)
    {
        $this->presenter = $presenter;
    }

    public function link($destination, $args = array())
    {
        return $this->presenter->link($destination, $args);
    }

    public function create($destination, $args = array())
    {
        return new Url($this, $destination, $args);
    }

}
