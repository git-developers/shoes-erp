<?php

declare(strict_types=1);

namespace Bundle\UiBundle\Block;

use Sonata\BlockBundle\Event\BlockEvent;
use Sonata\BlockBundle\Model\Block;

final class BlockEventListener
{
    /**
     * @var string
     */
    private $template;

    /**
     * @param string $template
     */
    public function __construct(string $template)
    {
        $this->template = $template;
    }

    /**
     * @param BlockEvent $event
     */
    public function onBlockEvent(BlockEvent $event): void
    {
        $block = new Block();
        $block->setId(uniqid('', true));
        $block->setSettings(array_replace($event->getSettings(), [
            'template' => $this->template,
        ]));
        $block->setType('sonata.block.service.template');

        $event->addBlock($block);
    }
}
