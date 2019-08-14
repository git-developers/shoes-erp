<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\CategoryBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Session\Session;
use Bundle\TicketBundle\Entity\TicketHasProducts;
use Bundle\TicketBundle\Entity\Ticket;

class BackendController extends GridController
{

}
