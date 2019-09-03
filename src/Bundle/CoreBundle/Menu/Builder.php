<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Menu;

use Bundle\CategoryBundle\Entity\Category;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Bundle\ProfileBundle\Entity\Profile;
use Bundle\RoleBundle\Entity\Role;
use Bundle\UserBundle\Entity\User;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\TicketBundle\Entity\Ticket;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $_route;

    const CIRCLE_1 = 'fa-circle-o text-yellow';
    const CIRCLE_2 = 'fa-circle-o text-aqua';
    const CIRCLE_3 = 'fa-circle-o text-blue';
    const CIRCLE_4 = 'fa-circle-o text-teal';
    const CIRCLE_5 = 'fa-circle-o text-red';
    const CIRCLE_6 = 'fa-circle-o text-purple';
    const CIRCLE_7 = 'fa-circle-o text-maroon';
    const CIRCLE_8 = 'fa-circle-o text-green';
    const CIRCLE_9 = 'fa-circle-o text-orange';

    function __construct() {

    }

    public function mainMenu(FactoryInterface $factory, array $options)
    {

        $request = $this->container->get('request_stack')->getCurrentRequest();
        $this->_route = $request->attributes->get('_route');

        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'sidebar-menu tree',
                'data-widget' => 'tree',
            ],
        ])
        ;
	
	
        
        /*
	    $user = $this->getUser();
	    echo 'ROLES GATO:::<pre>';
	    print_r($user->getRoles());
	    exit;
        */
        
        
	    
        /**
         * DASHBOARD
         */
        $menu->addChild('Dashboard', [
            'route' => 'backend_dashboard_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-tv')
        ->setAttribute('class', $this->activeRoute('backend_dashboard_index'))
        ->setDisplay(true)
        ;
        /**
         * DASHBOARD
         */
	
        

        

        /**
         * ACCOUNTS
         */
	    $isGranted = $this->isGranted([
		    User::ROLE_USER_VIEW,
		    User::ROLE_CLIENT_VIEW,
		    User::ROLE_EMPLOYEE_VIEW
	    ]);
        $menu->addChild('Usuarios', [
            'route' => 'frontend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
	        'backend_user_profile',
	        'backend_user_index',
	        'backend_user_client_index',
	        'backend_user_employee_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-user')
        ->setDisplay($isGranted)
        ;

        $menu['Usuarios']->addChild('Todos', [
            'route' => 'backend_user_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_user_index'))
        ->setDisplay($this->isGranted([User::ROLE_USER_VIEW]))
        ;

        $menu['Usuarios']->addChild('Clientes', [
            'route' => 'backend_user_client_index'
        ])
        ->setAttribute('icon', self::CIRCLE_2)
        ->setAttribute('class', $this->activeRoute('backend_user_client_index'))
        ->setDisplay($this->isGranted([User::ROLE_CLIENT_VIEW]))
        ;

        $menu['Usuarios']->addChild('Empleados', [
            'route' => 'backend_user_employee_index'
        ])
        ->setAttribute('icon', self::CIRCLE_3)
        ->setAttribute('class', $this->activeRoute('backend_user_employee_index'))
        ->setDisplay($this->isGranted([User::ROLE_EMPLOYEE_VIEW]))
        ;
        /**
         * ACCOUNTS
         */
	
	
        
	
	    /**
	     * POINTS OF SALES
	     */
	    $isGranted = $this->isGranted([
		    Pointofsale::ROLE_PDV_VIEW
	    ]);
	
	    $menu->addChild('Puntos de venta', [
		    'route' => 'backend_pointofsale_index',
		    'extras' => ['safe_label' => true],
		    'childrenAttributes' => [
			    'class' => 'treeview-menu',
		    ],
	    ])
	    ->setAttribute('allow_angle', true)
	    ->setAttribute('class', 'treeview')
	    ->setAttribute('class', $this->activeRoute([
		    'backend_pointofsale_index',
		    'backend_pointofsale_opening_index',
		    'backend_pointofsale_map_index',
		    'backend_pointofsale_add_user_index',
		    'backend_pointofsale_pdv_child_index',
	    ]))
	    ->setAttribute('icon', 'fa-fw fa-map-marker')
	    ->setDisplay($isGranted)
	    ;
	
	    $menu['Puntos de venta']->addChild('Gestionar', [
		    'route' => 'backend_pointofsale_index'
	    ])
	    ->setAttribute('icon', self::CIRCLE_1)
	    ->setAttribute('class', $this->activeRoute('backend_pointofsale_index'))
	    ->setDisplay($isGranted)
	    ;
	
	    $menu['Puntos de venta']->addChild('Mapa', [
		    'route' => 'backend_pointofsale_map_index'
	    ])
	    ->setAttribute('icon', self::CIRCLE_2)
	    ->setAttribute('class', $this->activeRoute('backend_pointofsale_map_index'))
	    ->setDisplay($isGranted)
	    ;
	    /**
	     * POINTS OF SALES
	     */
	
	
	
	
	
	    /**
         * STOCK - INVENTORY
         */
        $isGranted = $this->isGranted([
	        Category::ROLE_CATEGORY_VIEW
        ]);

        $menu->addChild('Inventario', [
            'route' => 'backend_product_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'backend_product_index',
            'backend_color_index',
            'backend_category_tree_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-dropbox')
        ->setDisplay($isGranted)
        ;

        $menu['Inventario']->addChild('Categoria', [
            'route' => 'backend_category_tree_index',
            'routeParameters' => [
                'entity_type' => Category::TYPE_PRODUCT
            ]
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_category_tree_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Inventario']->addChild('Producto', [
            'route' => 'backend_product_index'
        ])
        ->setAttribute('icon', self::CIRCLE_2)
        ->setAttribute('class', $this->activeRoute('backend_product_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Inventario']->addChild('Color', [
            'route' => 'backend_color_index'
        ])
        ->setAttribute('icon', self::CIRCLE_3)
        ->setAttribute('class', $this->activeRoute('backend_color_index'))
        ->setDisplay($isGranted)
        ;
        /**
         * STOCK - INVENTORY
         */
		
        
        
	
	    /**
         * SALES
         */
        $isGranted = $this->isGranted([
	        Ticket::ROLE_TICKET_VIEW,
        ]);

        $menu->addChild('Ventas', [
            'route' => 'backend_sales_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
	        'backend_sales_index',
	        'backend_sales_create',
            'backend_paymenttype_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-shopping-cart')
        ->setDisplay($isGranted)
        ;
        
	    $menu['Ventas']->addChild('Crear venta', [
		    'route' => 'backend_sales_create'
	    ])
		    ->setAttribute('icon', self::CIRCLE_1)
		    ->setAttribute('class', $this->activeRoute('backend_sales_create'))
		    ->setDisplay($isGranted)
	    ;
	    
	    $menu['Ventas']->addChild('Gestionar ventas', [
		    'route' => 'backend_sales_index'
	    ])
	    ->setAttribute('icon', self::CIRCLE_2)
	    ->setAttribute('class', $this->activeRoute([
		    'backend_sales_index',
	    ]))
	    ->setDisplay($isGranted)
	    ;
	    
	    $menu['Ventas']->addChild('Tipos de pago', [
		    'route' => 'backend_paymenttype_index'
	    ])
	    ->setAttribute('icon', self::CIRCLE_3)
	    ->setAttribute('class', $this->activeRoute('backend_paymenttype_index'))
	    ->setDisplay($isGranted)
	    ;
	    
        /**
         * SALES
         */
	
        
        
        
	
	    /**
         * ORDERS
         */
        $isGranted = $this->isGranted([
	        Ticket::ROLE_TICKET_VIEW,
        ]);

        $menu->addChild('Pedidos', [
            'route' => 'backend_orders_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
	        'backend_orders_index',
	        'backend_orders_create',
        ]))
        ->setAttribute('icon', 'fa-fw fa-file-text')
        ->setDisplay($isGranted)
        ;
        
	    $menu['Pedidos']->addChild('Crear pedido', [
		    'route' => 'backend_orders_create'
	    ])
		    ->setAttribute('icon', self::CIRCLE_1)
		    ->setAttribute('class', $this->activeRoute('backend_orders_create'))
		    ->setDisplay($isGranted)
	    ;
	    
	    $menu['Pedidos']->addChild('Gestionar pedido', [
		    'route' => 'backend_orders_index'
	    ])
	    ->setAttribute('icon', self::CIRCLE_2)
	    ->setAttribute('class', $this->activeRoute([
		    'backend_orders_index',
	    ]))
	    ->setDisplay($isGranted)
	    ;
        /**
         * ORDERS
         */
	

        
        

        /**
         * REPORTS
         */
        $isGranted = $this->isGranted([
	        Role::ROLE_STADISTICS,
        ]);

        $menu->addChild('Reportes', [
            'route' => 'backend_report_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'backend_report_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-bar-chart')
        ->setDisplay($isGranted)
        ;
        
	    $menu['Reportes']->addChild('Reporte por Pdv', [
		    'route' => 'backend_report_index'
	    ])
	    ->setAttribute('icon', self::CIRCLE_1)
	    ->setAttribute('class', $this->activeRoute('backend_report_index'))
	    ->setDisplay($isGranted)
	    ;
     
//	    $menu['Reportes']->addChild('Pie chart', [
//		    'route' => 'backend_statistics_pie_chart'
//	    ])
//	    ->setAttribute('icon', self::CIRCLE_2)
//	    ->setAttribute('class', $this->activeRoute('backend_statistics_pie_chart'))
//	    ->setDisplay($isGranted)
//	    ;
        /**
         * REPORTS
         */
	
        

        
        

        /**
         * STATISTICS
         */
        $isGranted = $this->isGranted([
	        Role::ROLE_STADISTICS,
        ]);

        $menu->addChild('Estadísticas', [
            'route' => 'backend_statistics_combo_chart',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'backend_statistics_pie_chart',
            'backend_statistics_combo_chart',
        ]))
        ->setAttribute('icon', 'fa-fw fa-line-chart')
        ->setDisplay($isGranted)
        ;
        
	    $menu['Estadísticas']->addChild('Combo chart', [
		    'route' => 'backend_statistics_combo_chart'
	    ])
	    ->setAttribute('icon', self::CIRCLE_1)
	    ->setAttribute('class', $this->activeRoute('backend_statistics_combo_chart'))
	    ->setDisplay($isGranted)
	    ;
     
	    $menu['Estadísticas']->addChild('Pie chart', [
		    'route' => 'backend_statistics_pie_chart'
	    ])
	    ->setAttribute('icon', self::CIRCLE_2)
	    ->setAttribute('class', $this->activeRoute('backend_statistics_pie_chart'))
	    ->setDisplay($isGranted)
	    ;
        /**
         * STATISTICS
         */
	
        
        
	
	
	    /**
	     * SECURITY
	     */
	    $isGranted = $this->isGranted([
		    Profile::ROLE_PROFILE_VIEW
	    ]);
	
	    $menu->addChild('Seguridad', [
		    'route' => 'frontend_default_index',
		    'extras' => ['safe_label' => true],
		    'childrenAttributes' => [
			    'class' => 'treeview-menu',
		    ],
	    ])
		    ->setAttribute('allow_angle', true)
		    ->setAttribute('class', 'treeview')
		    ->setAttribute('class', $this->activeRoute([
			    'backend_role_index',
			    'backend_session_index',
			    'backend_profile_index',
		    ]))
		    ->setAttribute('icon', 'fa-fw fa-lock')
		    ->setDisplay($isGranted)
	    ;
	    $menu['Seguridad']->addChild('Perfil', [
		    'route' => 'backend_profile_index',
		    'extras' => ['safe_label' => true],
		    'childrenAttributes' => [
			    'class' => 'treeview-menu',
		    ],
	    ])
		    ->setAttribute('icon', 'fa-fw fa-user-secret')
		    ->setAttribute('class', $this->activeRoute([
			    'backend_profile_index',
		    ]))
		    ->setDisplay($isGranted)
	    ;
	    $menu['Seguridad']->addChild('Rol', [
		    'route' => 'backend_role_index',
		    'extras' => ['safe_label' => true],
		    'childrenAttributes' => [
			    'class' => 'treeview-menu',
		    ],
	    ])
		    ->setAttribute('icon', 'fa-fw fa-expeditedssl')
		    ->setAttribute('class', $this->activeRoute([
			    'backend_role_index',
		    ]))
		    ->setDisplay($isGranted)
	    ;
	
	    /*
		$menu['Seguridad']->addChild('Sesión', [
			'route' => 'backend_session_index',
			'extras' => ['safe_label' => true],
			'childrenAttributes' => [
				'class' => 'treeview-menu',
			],
		])
			->setAttribute('icon', 'fa-fw fa-history')
			->setAttribute('class', $this->activeRoute([
				'backend_session_index',
			]))
			->setDisplay($isGranted)
		;
		*/
	    /**
	     * SECURITY
	     */
	
	    
	
	
	    /**
	     * SETTINGS
	     */
	    $isGranted = $this->isGranted([
		    Role::ROLE_SETTINGS,
	    ]);
	
	    $menu->addChild('Settings', [
		    'route' => 'backend_settings_edit',
		    'extras' => ['safe_label' => true],
		    'childrenAttributes' => [
			    'class' => 'treeview-menu',
		    ],
	    ])
	    ->setAttribute('class', 'treeview')
	    ->setAttribute('class', $this->activeRoute([
		    'backend_settings_edit',
	    ]))
	    ->setAttribute('icon', 'fa-fw fa-cog')
	    ->setDisplay($isGranted)
	    ;
	    /**
	     * SETTINGS
	     */













//        *************************************************************************
//        *************************************************************************
//        *************************************************************************

        /**
         * ASSOCIATION
         */

        /*
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

        $menu->addChild('Asociación', [
            'route' => 'frontend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'backend_associative_user_has_route_index',
            'backend_associative_profile_has_role_index',
            'backend_associative_route_has_pointofsale_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-exchange')
        ->setDisplay($isGranted)
        ;

        $menu['Asociación']->addChild('Perfil <i class="fa fa-fw fa-arrow-right"></i> Rol', [
            'route' => 'backend_associative_profile_has_role_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_associative_profile_has_role_index'))
        ->setDisplay($isGranted)
        ;
        /**
         * ASSOCIATION
         */



        return $menu;
    }

    protected function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

    protected function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

    protected function activeRoute($routes): string
    {
        if(is_array($routes)){
            foreach ($routes as $key => $route){
                if($this->_route === $route){
                    return 'active';
                }
            }
        }

        if($this->_route === $routes){
            return 'active';
        }

        return '';
    }

}