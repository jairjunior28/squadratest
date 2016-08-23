<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array
(

    'router' => array
    (
        'routes' => array
        (
            'home' => array
            (
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array
                (
                    'route'    => '/',
                    'defaults' => array
                    (
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action

            'sistemas' => array
            (
                'type'    => 'Segment',
                'options' => array
                (
                    'route'    => '/sistemas',
                    'defaults' => array
                    (
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Sistemas',
                        'action'        =>  'Index',


                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array
                (
                    'default' => array
                    (
                        'type'    => 'Segment',
                        'options' => array
                        (
                            'route'    => '[/:action]/[:id]',
                            'constraints' => array
                            (
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=> '[0-9_-]*'

                            ),

                        )
                    ),
                    'paginator' => array
                        (
                            'type'    => 'Segment',
                            'options' => array
                            (
                                'route'    => '[/:descricao][/:sigla][:email][/page][/:page]',
                                'constraints' => array
                                (
                                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'id'=> '[0-9_-]*',
                                    'page'=> '[0-9_-]*',
                                    'descricao'=> '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'sigla'=> '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'email'=> '[a-zA-Z][a-zA-Z0-9_-]*',

                                ),

                            )
                        )

                ),
            ),


        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Users' => 'Application\Controller\UsersController',
            'Application\Controller\Funcionarios' => 'Application\Controller\FuncionariosController',
            'Application\Controller\Sistemas' => 'Application\Controller\SistemasController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',

        ),
    ),
    'paginator' => array(
        'type' => 'Segment',
        'options' => array(
            'route' => '[/page/:page]',
            'constraints' => array(
                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                'page' => 'd+'
            ),
            'defaults' => array(
                'action' => 'index',
                'page' => 1
            ))),
    'view_helpers' => array(
        'invokables'=> array(
            'PaginationHelper' => 'Application\View\Helper\PaginationHelper'        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . "/src/Application/Model"
                ),
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Application\Model' => 'my_annotation_driver'
                )
            )
        )
    )

);
