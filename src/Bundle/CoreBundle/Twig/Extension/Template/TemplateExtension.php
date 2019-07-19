<?php

namespace Bundle\CoreBundle\Twig\Extension\Template;

use CoreBundle\Entity\Template;
use CoreBundle\Entity\TemplateEPost;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Entity\TemplateEParagraph;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use CoreBundle\Twig\Extension\Template\Exception\InvalidArgumentException;

class TemplateExtension extends \Twig_Extension
{

    protected $em;
    protected $environment;
    protected $jmsSerializer;

    public function __construct(EntityManager $entityManager, Serializer $jmsSerializer)
    {
        $this->em = $entityManager;
        $this->jmsSerializer = $jmsSerializer;
    }

    public function getFilters()
    {
        return [
//            new \Twig_SimpleFilter('xxxxx', [$this, 'xxxxxFilter']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'render_paragraph',
                [$this, 'renderParagraphFunction'],
                [
                    'is_safe' => ['html']
                ]
            ),
            new \Twig_SimpleFunction(
                'render_items',
                [$this, 'renderItemsFunction'],
                [
                    'is_safe' => ['html']
                ]
            ),
            new \Twig_SimpleFunction(
                'render_blog_post',
                [$this, 'renderBlogPostFunction'],
                [
                    'is_safe' => ['html']
                ]
            ),
            new \Twig_SimpleFunction(
                'render_settings',
                [$this, 'renderSettingsFunction'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            ),
            new \Twig_SimpleFunction(
                'render_ckeditor',
                [$this, 'renderCkeditorFunction'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            ),
        ];
    }

    public function renderParagraphFunction($templateHasModule, $path = null, $position = null)
    {

        $template = isset($templateHasModule['template_id']) ? $templateHasModule['template_id'] : null;

        $paragraph = $this->em->getRepository(TemplateHasModule::class)->findOneByParagraphAndPath($template, $path);

        if ($paragraph) {

            $paragraph = is_array($paragraph) ? array_shift($paragraph) : [];
            $paragraph = unserialize($paragraph);

            if (is_null($position)) {
                return array_shift($paragraph);
            }

            if ($this->checkPosition($position)) {
                $position = $position - 1;
                return isset($paragraph[$position]) ? $paragraph[$position] : null;
            }
        }

        return;
    }

    public function renderItemsFunction($templateHasModule, $path = null, $maxResults = 4)
    {
        $template = isset($templateHasModule['template_id']) ? $templateHasModule['template_id'] : null;
        $entity = $this->em->getRepository(TemplateHasModule::class)->findOneByItemsAndPath($template, $path, $maxResults);
        return $this->getSerializeDecode($entity, 'template_e_item');
    }

    public function renderBlogPostFunction($templateHasModule)
    {
        $templateHasModuleId = isset($templateHasModule['template_has_module']) ? $templateHasModule['template_has_module'] : null;

        $entity = $this->em->getRepository(TemplateEPost::class)->findAllByTemplateHasModule($templateHasModuleId);
        return $this->getSerializeDecode($entity, 'template_e_post');
    }

    private function getSerialize($object, $groupName)
    {
        return $this->jmsSerializer->serialize(
            $object,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups([$groupName])
        );
    }

    private function getSerializeDecode($object, $groupName)
    {
        $objects = $this->getSerialize($object, $groupName);
        return json_decode($objects, true);
    }

    private function checkPosition($position)
    {
        if (!is_int($position) || $position < 1) {
            return false;
        }

        return true;

        /*
        if (!is_int($position)) {
            throw new InvalidArgumentException();
        }

        if ($position < 1) {
            throw new InvalidArgumentException();
        }
        */
    }

    public function renderSettingsFunction(\Twig_Environment $environment, $settings, $objectModule)
    {
        $environment->getLoader()->addPath(__DIR__ . '/Views');

        return $environment->render('settings.html.twig',
            [
                'settings' => $settings,
                'objectModule' => $objectModule,
            ]
        );
    }

    public function renderCkeditorFunction(\Twig_Environment $environment, $settings)
    {
        $environment->getLoader()->addPath(__DIR__ . '/Views');

        return $environment->render('ckeditor.js.twig',
            [
                'settings' => $settings
            ]
        );
    }

    public function getName()
    {
        return 'template_extension';
    }

}

