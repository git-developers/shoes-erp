<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Twig;

use Bundle\GoogleBundle\Templating\Helper\GoogleHelper;
use Twig_Environment;

final class GoogleExtension extends \Twig_Extension
{
    /**
     * @var GoogleHelper
     */
    private $googleHelper;

    /**
     * @param GoogleHelper $GoogleHelper
     */
    public function __construct(GoogleHelper $googleHelper)
    {
        $this->googleHelper = $googleHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('tianos_google_watch_viewer', [$this->googleHelper, 'googleWatchViewer'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('tianos_google_description', [$this->googleHelper, 'googleDescription'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters(): array
    {
        return array(
            new \Twig_SimpleFilter('tianos_google_span_class', [$this->googleHelper, 'googleSpanClass'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('tianos_google_mimetype_icon', [$this->googleHelper, 'googleMimeTypeIcon'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('tianos_google_span_url_filter', [$this->googleHelper, 'googleSpanUrlFilter'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('tianos_google_file_values', [$this->googleHelper, 'googleFileValues'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('tianos_base64_encode', [$this->googleHelper, 'base64Encode'], ['is_safe' => ['html']]),
        );
    }

    public function initRuntime(Twig_Environment $environment)
    {
        // TODO: Implement initRuntime() method.
    }

    public function getGlobals()
    {
        // TODO: Implement getGlobals() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }
}
