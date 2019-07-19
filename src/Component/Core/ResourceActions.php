<?php

declare(strict_types=1);

namespace Component\Resource;

final class ResourceActions
{
    public const SHOW = 'show';
    public const INDEX = 'index';
    public const CREATE = 'create';
    public const UPDATE = 'update';
    public const DELETE = 'delete';

    private function __construct()
    {
    }
}
