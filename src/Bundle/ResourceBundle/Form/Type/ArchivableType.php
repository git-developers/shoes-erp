<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Form\Type;

use Component\Resource\Model\ArchivableInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ArchivableType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('archivedAt', DateTimeType::class)
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                /** @var ArchivableInterface $archivable */
                $archivable = $event->getData();

                $archivedAt = null;
                if (null === $archivable->getArchivedAt()) {
                    $archivedAt = new \DateTime();
                }

                $archivable->setArchivedAt($archivedAt);

                $event->setData($archivable);
            })
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_archivable';
    }
}
