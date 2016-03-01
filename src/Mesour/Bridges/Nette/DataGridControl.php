<?php
/**
 * This file is part of the Mesour Nette Bridges (http://components.mesour.com)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Nette;

use Nette\Application\UI;
use Mesour;
use Doctrine;
use Nette\Database\Table\Selection;
use Nette\InvalidArgumentException;
use Nette\InvalidStateException;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 *
 * @property-read Link $link
 */
class DataGridControl extends UI\Control
{

    /** @var Mesour\UI\DataGrid */
    private $grid;

    /** @var Mesour\DataGrid\Renderer\IGridRenderer */
    private $createdGrid;

    /** @var Mesour\Components\Application\IApplication */
    private $mesourApplication;

    public function attached($presenter)
    {
        parent::attached($presenter);

        if ($presenter instanceof UI\Presenter) {
            if (!$presenter->getName()) {
                throw new InvalidArgumentException('Parameter name is required.');
            }

            /** @var Mesour\Components\Application\IApplication $application */
            $this->mesourApplication = $presenter->getContext()->getByType(Mesour\Components\Application\IApplication::class);

            $this->mesourApplication->setLink(new Mesour\Bridges\Nette\Link($this));

            $this->grid = $this->mesourApplication[$this->getName()] = isset($this->mesourApplication[$this->getName()])
                ? $this->mesourApplication[$this->getName()]
                : new Mesour\UI\DataGrid($this->getName());
        }
    }

    /**
     * @return Mesour\UI\DataGrid
     */
    public function getGrid()
    {
        if (!$this->grid) {
            throw new InvalidStateException('Component is not attached do presenter.');
        }
        return $this->grid;
    }

    /**
     * @return Mesour\Components\Application\IApplication
     */
    public function getApplication()
    {
        if (!$this->mesourApplication) {
            throw new InvalidStateException('Component is not attached do presenter.');
        }
        return $this->mesourApplication;
    }

    public function createSource($data)
    {
        if ($data instanceof Selection) {
            return new Mesour\DataGrid\Sources\NetteDbGridSource($data);
        } elseif ($data instanceof Doctrine\ORM\QueryBuilder) {
            return new Mesour\DataGrid\Sources\DoctrineGridSource($data);
        } elseif (is_array($data)) {
            return new Mesour\DataGrid\Sources\ArrayGridSource($data);
        } else {
            throw new InvalidArgumentException('Data source was not recognized');
        }
    }

    public function create()
    {
        if ($this->createdGrid) {
            throw new InvalidStateException('Grid is still created.');
        }
        $this->createdGrid = $this->grid->create();
        return $this;
    }

    public function render()
    {
        if (!$this->createdGrid) {
            throw new InvalidStateException('Must call method create before render.');
        }
        return $this->createdGrid->render();
    }

}
