<?php

namespace TijsVerkoyen\VoipCenter\Collections;

class Base implements \Iterator
{
    /**
     * The items in the array
     *
     * @var array
     */
    private $items = array();

    /**
     * @var int
     */
    private $pointer = 0;

    /**
     * {@inheritdoc}
     */
    public function fromAPI($data)
    {
        $className = $this->getItemClass();

        foreach ($data as $idString => $row) {
            $id = str_replace('id_', '', $idString);

            $item = new $className;
            $item->setId($id);
            $item->fromApi($row);

            $this->items[] = $item;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->items[$this->pointer];
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        ++$this->pointer;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->pointer = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return isset($this->items[$this->pointer]);
    }
}
