<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Templating\Helper;

use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\User\Renderer\UserRendererInterface;
use Component\Grid\View\GridView;
use Symfony\Component\Templating\Helper\Helper;
use Bundle\UserBundle\Entity\User;
use Bundle\CategoryBundle\Entity\Category;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserHelper extends Helper
{
	/**
	 * @var ContainerInterface
	 */
	private $container;
	
    /**
     * @var UserRendererInterface
     */
    private $userRenderer;

    /**
     * @param UserRendererInterface $userRenderer
     */
    public function __construct(UserRendererInterface $userRenderer, ContainerInterface $container)
    {
	    $this->container = $container;
	    $this->userRenderer = $userRenderer;
    }

    // JAFETH
    public function profileAboutMe(string $template = null)
    {
        return $this->userRenderer->profileAboutMe($template);
    }

    public function appUserName(User $user, $start, $length = null)
    {
        $name = $user->getName();
        $name = !is_null($name) ? substr($name, $start, $length) : '';

        $lastName = $user->getLastName();
        $lastName = !is_null($lastName) ? substr($lastName, $start, $length) : '';

        return $name .' '. $lastName;
    }

    public function reverseRecursiveCategory(Category $category = null)
    {
    	
	    $obj1 = $this->container->get("tianos.repository.category")->find($category->getId());
	    

	    if ($obj1 && $obj1->getCategory()) {
		
		    $obj2 = $this->container->get("tianos.repository.category")->find($obj1->getCategory()->getId());
	    	
		    return '<span class="badge bg-light-blue-active">' . $obj2->getName() . '</span> <i class="fa fa-fw fa-arrow-right"></i> <span class="badge bg-light-blue-active">' . $obj1->getName() . '</span>';
	    }
	
	    return '<span class="badge bg-light-blue-active">' . $obj1->getName() . '</span>';
    }
    
    
    
    
    

//
//    /**
//     * @param GridView $gridView
//     * @param string|null $template
//     *
//     * @return mixed
//     */
//    public function renderGrid(GridView $gridView, ?string $template = null)
//    {
//        //JAFETH
//        return $this->userRenderer->render($gridView, $template);
//    }
//
//    /**
//     * @param GridView $gridView
//     * @param Field $field
//     * @param mixed $data
//     *
//     * @return mixed
//     */
//    public function renderField(GridView $gridView, Field $field, $data)
//    {
//        return $this->userRenderer->renderField($gridView, $field, $data);
//    }
//
//    /**
//     * @param GridView $gridView
//     * @param Action $action
//     * @param mixed|null $data
//     *
//     * @return mixed
//     */
//    public function renderAction(GridView $gridView, Action $action, $data = null)
//    {
//        return $this->userRenderer->renderAction($gridView, $action, $data);
//    }
//
//    /**
//     * @param GridView $gridView
//     * @param Filter $filter
//     *
//     * @return mixed
//     */
//    public function renderFilter(GridView $gridView, Filter $filter)
//    {
//        return $this->userRenderer->renderFilter($gridView, $filter);
//    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'sylius_grid';
    }
}
