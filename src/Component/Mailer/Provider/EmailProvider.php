<?php

declare(strict_types=1);

namespace Component\Mailer\Provider;

use Component\Mailer\Factory\EmailFactoryInterface;
use Component\Mailer\Model\EmailInterface;
use Webmozart\Assert\Assert;

final class EmailProvider implements EmailProviderInterface
{
    /**
     * @var EmailFactoryInterface
     */
    private $emailFactory;

    /**
     * @var array
     */
    private $configuration;

    /**
     * @param EmailFactoryInterface $emailFactory
     * @param array $configuration
     */
    public function __construct(
        EmailFactoryInterface $emailFactory,
        array $configuration
    ) {
        $this->emailFactory = $emailFactory;
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(string $code): EmailInterface
    {
        return $this->getEmailFromConfiguration($code);
    }

    /**
     * @param string $code
     *
     * @return EmailInterface
     */
    private function getEmailFromConfiguration(string $code): EmailInterface
    {
        Assert::keyExists($this->configuration, $code, sprintf('Email with code "%s" does not exist!', $code));

        /** @var EmailInterface $email */
        $email = $this->emailFactory->createNew();
        $configuration = $this->configuration[$code];

        $email->setCode($code);
        $email->setSubject($configuration['subject']);
        $email->setTemplate($configuration['template']);

        if (isset($configuration['enabled']) && false === $configuration['enabled']) {
            $email->setEnabled(false);
        }
        if (isset($configuration['sender']['name'])) {
            $email->setSenderName($configuration['sender']['name']);
        }
        if (isset($configuration['sender']['address'])) {
            $email->setSenderAddress($configuration['sender']['address']);
        }

        return $email;
    }
}
