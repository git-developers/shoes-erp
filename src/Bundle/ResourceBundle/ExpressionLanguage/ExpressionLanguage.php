<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\ExpressionLanguage;

use Symfony\Component\DependencyInjection\ExpressionLanguage as BaseExpressionLanguage;
use Symfony\Component\ExpressionLanguage\ParserCache\ParserCacheInterface;

final class ExpressionLanguage extends BaseExpressionLanguage
{
    /**
     * {@inheritdoc}
     */
    public function __construct(ParserCacheInterface $parser = null, array $providers = [])
    {
        array_unshift($providers, new NotNullExpressionFunctionProvider());

        parent::__construct($parser, $providers);
    }
}
