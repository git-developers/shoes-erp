<?php

declare(strict_types=1);

namespace Component\Google\Renderer;

use Component\Google\Definition\Action;
use Component\Google\Definition\Field;
use Component\Google\Definition\Filter;
use Component\Google\View\GoogleViewInterface;
use Bundle\CoreBundle\Services\Button;

interface GoogleRendererInterface
{

    // JAFETH
    public function googleSpanClass($mimeType);
    // JAFETH


    /**
     * @param GoogleViewInterface $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function render(GoogleViewInterface $gridView, string $template = null);

    /**
     * @param GoogleViewInterface $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function renderViewer(string $fileId = null, string $fileMimeType = null);

    /**
     * @param GoogleViewInterface $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(GoogleViewInterface $gridView, Field $field, $data);

    /**
     * @param GoogleViewInterface $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(GoogleViewInterface $gridView, Action $action, $data = null);

    /**
     * @param GoogleViewInterface $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(GoogleViewInterface $gridView, Filter $filter);
}
