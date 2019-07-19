<?php

declare(strict_types=1);

namespace Component\Order\Renderer;

use Component\Order\Definition\Action;
use Component\Order\Definition\Field;
use Component\Order\Definition\Filter;
use Component\Order\View\OrderViewInterface;
use Bundle\CoreBundle\Services\Button;

interface OrderRendererInterface
{

//    public function renderModalFooter(?string $template = null); // Button $button,
//    public function renderButton(Button $button, ?string $template = null);
    public function orderQuantity(array $orders = [], $id);



    /*
    public function render(OneToManyViewInterface $gridView, ?string $template = null);

    public function renderField(OneToManyViewInterface $gridView, Field $field, $data);

    public function renderAction(OneToManyViewInterface $gridView, Action $action, $data = null);

    public function renderFilter(OneToManyViewInterface $gridView, Filter $filter);
    */
}
