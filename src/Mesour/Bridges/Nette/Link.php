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
use Nette\Application\UI\PresenterComponent;

/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class Link implements Mesour\Components\Link\ILink
{

    /**
     * @var IPresenter
     */
    private $presenterComponent;

    public function __construct(PresenterComponent $presenterComponent)
    {
        $this->presenterComponent = $presenterComponent;
    }

    public function link($destination, $args = [], $presenterComponent = null)
    {
        if(!$presenterComponent) {
            $presenterComponent = $this->presenterComponent;
        }
        return $presenterComponent->link($destination, $args);
    }

    public function create($destination, $args = [], $component = null)
    {
        $url = new Url($this, $destination, $args);
        if(!is_null($component)) {
            $url->setPresenterComponent($component);
        }
        return $url;
    }

}
