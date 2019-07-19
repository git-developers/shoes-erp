<?php

namespace Bundle\CoreBundle\Services;

class Button
{

    protected $class;

    protected $alt;

    protected $title;

    protected $dataToggle;

    protected $dataTarget;

    protected $onClickHref;

    protected $style;

    protected $icon;

    public function __construct(array $options = [])
    {
        $options = array_replace([
//            'class' => 'btn btn-xs ',
            'class' => 'btn ',
            'alt' => '',
            'title' => '',
            'icon' => '<i class="fa fa-fw"></i>',
            'data-toggle' => '',
            'data-target' => '',
            'style' => 'margin-right: 5px',
            'on-click-href' => '',
        ], $options);


        $this->alt = $options['alt'];
        $this->icon = $options['icon'];
        $this->title = $options['title'];
        $this->style = $options['style'];
        $this->class = $options['class'];
        $this->dataToggle = $options['data-toggle'];
        $this->dataTarget = $options['data-target'];
        $this->onClickHref = $options['on-click-href'];

    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param mixed $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDataToggle()
    {
        return $this->dataToggle;
    }

    /**
     * @param mixed $dataToggle
     */
    public function setDataToggle($dataToggle)
    {
        $this->dataToggle = $dataToggle;
    }

    /**
     * @return mixed
     */
    public function getDataTarget()
    {
        return $this->dataTarget;
    }

    /**
     * @param mixed $dataTarget
     */
    public function setDataTarget($dataTarget)
    {
        $this->dataTarget = $dataTarget;
    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getOnClickHref()
    {
        return $this->onClickHref;
    }

    /**
     * @param mixed $onClickHref
     */
    public function setOnClickHref($onClickHref): void
    {
        $this->onClickHref = $onClickHref;
    }

}



