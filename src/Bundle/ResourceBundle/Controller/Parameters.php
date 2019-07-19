<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use Symfony\Component\HttpFoundation\ParameterBag;

class Parameters extends ParameterBag
{
    /**
     * {@inheritdoc}
     */
    public function get($path, $default = null)
    {
        $result = parent::get($path, $default);

        if (null === $result && $default !== null && $this->has($path)) {
            $result = $default;
        }

        return $result;
    }

    //FALTA - TO DO
    public function getChild($path, $key, $default = null)
    {
//        $result = parent::get($path, $default);

        $result = array_key_exists($path, $this->parameters) && array_key_exists($key, $this->parameters[$path]) ? $this->parameters[$path][$key] : $default;

        if (null === $result && $default !== null) {
            $result = $default;
        }

        return $result;
    }
}
