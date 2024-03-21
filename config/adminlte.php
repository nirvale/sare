<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'SARE-DGTG-IT | ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>SARE - </b>DGTG',
    'logo_img' => 'g30-3.png',
    'logo_img_class' => 'brand-image  elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Dirección de Tecnologías para la Gestión - GEM',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'g30-3.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'loader.png',
            'alt' => 'Dirección de Tecnologías para la Gestión',
            'effect' => 'animation__shake',
            'width' => 620,
            'height' =>150,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-danger',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-danger',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-secondary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-danger elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-dark navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false, //habilita menu de configuracion de usuario
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => false, //menu de configuración usuario sobre el fondo
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'cerrarsp',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'forgot-password',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => false,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        // [
        //     'type' => 'sidebar-menu-search',
        //     'text' => 'search',
        // ],
    /*    [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],*/
       /* [
            'text'        => 'pages',
            'url'         => 'admin/pages',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
        ],*/
/*        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => '/admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => '/admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ],*/
        ['header' => 'SISTEMA','can' => ['adming','admin'],'key'=>'menu_sistema'],
        [
            'text' => 'Usuarios',
            'url'  => '/admin/listausuarios',
            'icon' => 'fas fa-fw fa-users-cog',
            'can'  => ['adming','admin'],

        ],
        ['header' => 'ADMINISTRACIÓN','can' => ['adming','admin','ver_esquema','infraestructura']],
        [
            'text'    => 'Catálogos',
            'icon'    => 'fas fa-compress-arrows-alt',
            'can' => ['adming','admin','ver_esquema','infraestructura'],
            'submenu' => [

                [
                    'text' => 'Ambientes',
                    //'url'  => '/admin/esquemahome',
                    'route'  => 'ambientes.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                ],
                [
                    'text' => 'Backups',
                    //'url'  => '/admin/esquemahome',
                    //'route'  => 'datacenters.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    'submenu' => [
                          [
                              'text' => 'Backups',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'backups.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                          [
                              'text' => 'Estado de Backup',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'estadobackups.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                    ]
                ],

                [
                    'text' => 'Datacenter',
                    //'url'  => '/admin/esquemahome',
                    //'route'  => 'datacenters.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    'submenu' => [
                          [
                            'text' => 'Datacenters',
                            //'url'  => '/admin/esquemahome',
                            'route'  => 'datacenters.indexdt',
                            //'icon'    => 'fas fa-puzzle-piece',
                            'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                          [
                              'text' => 'Tipos de Datacenter',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'tipodcs.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                    ]
                ],
                [
                    'text' => 'Dominios',
                    //'url'  => '/admin/esquemahome',
                    'route'  => 'dominios.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                ],
                [
                    'text' => 'Hardware',
                    //'url'  => '/admin/esquemahome',
                    //'route'  => 'datacenters.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    'submenu' => [
                          [
                              'text' => 'Marca de Hardware',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'mhardwares.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                          [
                              'text'    => 'NICS',
                              'url'     => '#',
                              'submenu' => [
                                [
                                    'text' => 'Tipo de NIC',
                                    //'url'  => '/admin/esquemahome',
                                    'route'  => 'tnics.indexdt',
                                    'icon'    => 'fa fa-list-ol',
                                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                ],
                                [
                                    'text' => 'NICs',
                                    //'url'  => '/admin/esquemahome',
                                    'route'  => 'nics.indexdt',
                                    'icon'    => 'fa fa-list-ol',
                                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                ],
                                  // [
                                  //     'text' => 'level_three',
                                  //     'url'  => '#',
                                  // ],
                              ],
                          ],
                          [
                              'text' => 'Procesadores',
                              //'url'  => '/admin/esquemahome',
                              //'route'  => 'datacenters.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                              'submenu' => [
                                    [
                                        'text' => 'Fabricantes',
                                        //'url'  => '/admin/esquemahome',
                                        'route'  => 'mprocesadors.indexdt',
                                        'icon'    => 'fa fa-list-ol',
                                        'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                    ],
                                    [
                                        'text' => 'Arquitecturas',
                                        //'url'  => '/admin/esquemahome',
                                        'route'  => 'aprocesadors.indexdt',
                                        'icon'    => 'fa fa-list-ol',
                                        'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                    ],
                                    [
                                        'text' => 'Procesadores',
                                        //'url'  => '/admin/esquemahome',
                                        'route'  => 'procesadors.indexdt',
                                        'icon'    => 'fa fa-list-ol',
                                        'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                    ],
                              ]
                          ],
                          [
                              'text' => 'Storage',
                              //'url'  => '/admin/esquemahome',
                              //'route'  => 'datacenters.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                              'submenu' => [
                                    [
                                        'text' => 'Cajas de Storage',
                                        //'url'  => '/admin/esquemahome',
                                        'route'  => 'storageremotos.indexdt',
                                        'icon'    => 'fa fa-list-ol',
                                        'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                    ],
                                    [
                                        'text' => 'Formatos',
                                        //'url'  => '/admin/esquemahome',
                                        'route'  => 'dformatos.indexdt',
                                        'icon'    => 'fa fa-list-ol',
                                        'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                    ],
                                    [
                                        'text' => 'Tecnologías Storage Remoto',
                                        //'url'  => '/admin/esquemahome',
                                        'route'  => 'tecremotadiscos.indexdt',
                                        'icon'    => 'fa fa-list-ol',
                                        'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                    ],
                                    [
                                        'text' => 'Tipos de Storage',
                                        //'url'  => '/admin/esquemahome',
                                        'route'  => 'tdiscos.indexdt',
                                        'icon'    => 'fa fa-list-ol',
                                        'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                    ],
                                    [
                                        'text' => 'Utilidades Storage Remoto',
                                        //'url'  => '/admin/esquemahome',
                                        'route'  => 'udremotas.indexdt',
                                        'icon'    => 'fa fa-list-ol',
                                        'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                                    ],
                              ]
                          ],
                    ]
                ],
                [
                    'text' => 'DNS',
                    //'url'  => '/admin/esquemahome',
                    'route'  => 'dnss.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    // 'submenu' => [
                    //       [
                    //           'text' => 'Manejadores de BD',
                    //           //'url'  => '/admin/esquemahome',
                    //           'route'  => 'rdbmss.indexdt',
                    //           //'icon'    => 'fas fa-puzzle-piece',
                    //           'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    //       ],
                    //       [
                    //           'text' => 'Versiones de BD',
                    //           //'url'  => '/admin/esquemahome',
                    //           'route'  => 'rdbmsversions.indexdt',
                    //           //'icon'    => 'fas fa-puzzle-piece',
                    //           'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    //       ],
                    // ]
                ],

                [
                    'text' => 'Sistemas de BD',
                    //'url'  => '/admin/esquemahome',
                    //'route'  => 'datacenters.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    'submenu' => [
                          [
                              'text' => 'Manejadores de BD',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'rdbmss.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                          [
                              'text' => 'Versiones de BD',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'rdbmsversions.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                    ]
                ],
                [
                    'text' => 'Operación',
                    //'url'  => '/admin/esquemahome',
                    //'route'  => 'datacenters.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    'submenu' => [
                          [
                              'text' => 'Programas',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'programas.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                          [
                              'text' => 'Dependencias',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'dependencias.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                          [
                              'text' => 'Oficinas/Areas',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'oficinas.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                    ]
                ],


                [
                    'text' => 'Sistemas Operativos',
                    //'url'  => '/admin/esquemahome',
                    //'route'  => 'datacenters.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                    'submenu' => [
                          [
                              'text' => 'Sistemas Operativos',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'oss.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                          [
                              'text' => 'Distriuciones OS',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'distribucions.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                          [
                              'text' => 'Versiones OS',
                              //'url'  => '/admin/esquemahome',
                              'route'  => 'osversions.indexdt',
                              //'icon'    => 'fas fa-puzzle-piece',
                              'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                          ],
                    ]
                ],

                [
                    'text' => 'Tipo de Objeto',
                    //'url'  => '/admin/esquemahome',
                    'route'  => 'tipos.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                ],
                [
                    'text' => 'Virtulizador',
                    //'url'  => '/admin/esquemahome',
                    'route'  => 'virtualizadors.indexdt',
                    'icon'    => 'fas fa-puzzle-piece',
                    'can' => ['adming','admin','ver_catalogos','editar_catalogos','crear_catalogos','imprimir_catalogos','eliminar_catalogos'],
                ],

/*                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],*/
/*                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],*/
              ],

        ],
        [
            'text'    => 'Bases de datos',
            'icon'    => 'fas fa-database',
            'can' => ['adming','admin','ver_esquema','infraestructura'],
            'submenu' => [
                [
                    'text' => 'Esquemas',
                    //'url'  => '/admin/esquemahome',
                    //'route'  => 'esquema.home',
                    'icon'    => 'fas fa-fw fa-table',
                    'can' => ['adming','admin','ver_esquema','editar_esquema','crear_esquema','imprimir_esquema','eliminar_esquema'],
                ],
/*                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],*/
/*                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],*/
              ],
            //'can' => ['adming','admin','ver_esquema','infraestructura']//BORRAR?
        ],
        ['header' => 'BACKUPS','can' => ['adming','admin','ver_bitacora','infraestructura']],
        [
            'text'    => 'Bitácoras','can' => ['adming','admin','ver_bitacora','infraestructura'],
            'icon'    => 'fas fa-clipboard-list',
            'submenu' => [
                [
                    'text' => 'Diario',
                    //'url'  => '/admin/bdiariahome',
                    //'route'  => 'bdiaria.home',
                    'icon'    => 'fas fa-clipboard-check',
                    'can' => ['adming','admin','ver_bitacora','editar_bitacora','crear_bitacora','imprimir_bitacora','eliminar_bitacora'],
                ],
                [
                    'text' => 'Semanal',
                  //  'url'  => '/admin/bsemanalhome',
                    //'route'  => 'bsemanal.home',
                    'icon'    => 'fas fa-calendar-check',
                    'can' => ['adming','admin','ver_bitacora','editar_bitacora','crear_bitacora','imprimir_bitacora','eliminar_bitacora'],
                ],
                [
                    'text' => 'Manual',
                    //'url'  => '/admin/bmanualhome',
                    //'route'  => 'bmanual.home',
                    'icon'    => 'fas fa-tasks',
                    'can' => ['adming','admin','ver_bitacora','editar_bitacora','crear_bitacora','imprimir_bitacora','eliminar_bitacora'],
                ],
              ],
        ],
        [
            'text'    => 'Restore','can' => ['adming','admin','ver_bitacora','infraestructura'],
            'icon'    => 'fas fa-trash-restore',
            'submenu' => [
                [
                    'text' => 'test',
                    //'url'  => '/admin/bdiariahome',
                    //'route'  => 'recovere.home',
                    'icon'    => 'fas fa-check-circle',
                    'can' => ['adming','admin','ver_bitacora','editar_bitacora','crear_bitacora','imprimir_bitacora','eliminar_bitacora'],
                    //'can' => ['adming','admin'],
                ],
              ],
        ],
   /*     ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],*/
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
      'Datatables' => [
          'active' => true,
          'files' => [
              [
                  'type' => 'js',
                  'asset' => true,
                  'location' => 'vendor/DataTables/DataTables-2.0.1/js/dataTables.min.js',
              ],
              [
                  'type' => 'js',
                  'asset' => true,
                  'location' => 'vendor/DataTables/DataTables-2.0.1/js/dataTables.bootstrap5.min.js',
              ],
              [
                  'type' => 'css',
                  'asset' => true,
                  'location' => 'vendor/DataTables/DataTables-2.0.1/css/dataTables.bootstrap5.min.css',
              ],
          ],
      ],
      'DatatablesResponsive' => [
          'active' => true,
          'files' => [
              [
                  'type' => 'js',
                  'asset' => true,
                  'location' => 'vendor/DataTables/plugins/Responsive-3.0.0/js/dataTables.responsive.min.js',
              ],
              [
                  'type' => 'js',
                  'asset' => true,
                  'location' => 'vendor/DataTables/plugins/Responsive-3.0.0/js/responsive.bootstrap5.min.js',
              ],
              [
                  'type' => 'css',
                  'asset' => true,
                  'location' => 'vendor/DataTables/plugins/Responsive-3.0.0/css/responsive.bootstrap5.min.css',
              ],
          ],
      ],
      'DatatablesButtons' => [
          'active' => true,
          'files' => [
              [
                  'type' => 'js',
                  'asset' => true,
                  'location' => 'vendor/DataTables/plugins/Buttons-3.0.0/js/dataTables.buttons.min.js',
              ],
              [
                  'type' => 'js',
                  'asset' => true,
                  'location' => 'vendor/DataTables/plugins/Buttons-3.0.0/js/buttons.bootstrap5.min.js',
              ],
              // [
              //     'type' => 'js',
              //     'asset' => true,
              //     'location' => 'vendor/datatables/buttons.server-side.js',
              // ],
              [
                  'type' => 'css',
                  'asset' => true,
                  'location' => 'vendor/DataTables/plugins/Buttons-3.0.0/css/buttons.bootstrap5.min.css',
              ],
          ],
      ],
      'DatatablesPorcentageBar' => [
          'active' => true,
          'files' => [
              [
                  'type' => 'js',
                  'asset' => true,
                  'location' => 'vendor/DataTables/plugins/dataRender/porcentageBars.js',
              ],
          ],
      ],
        // 'Datatables' => [
        //     'active' => true,
        //     'files' => [
        //         [
        //             'type' => 'js',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/js/jquery.dataTables.min.js',
        //         ],
        //         [
        //             'type' => 'js',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/js/dataTables.bootstrap5.min.js',
        //         ],
        //         [
        //             'type' => 'css',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/css/dataTables.bootstrap5.min.css',
        //         ],
        //     ],
        // ],
        // 'DatatablesResponsive' => [
        //     'active' => true,
        //     'files' => [
        //         [
        //             'type' => 'js',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/plugins/Responsive-2.5.0/js/dataTables.responsive.min.js',
        //         ],
        //         [
        //             'type' => 'js',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/plugins/Responsive-2.5.0/js/responsive.bootstrap5.min.js',
        //         ],
        //         [
        //             'type' => 'css',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/plugins/Responsive-2.5.0/css/responsive.bootstrap5.min.css',
        //         ],
        //     ],
        // ],
        // 'DatatablesButtons' => [
        //     'active' => true,
        //     'files' => [
        //         [
        //             'type' => 'js',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/plugins/Buttons-2.4.2/js/dataTables.buttons.min.js',
        //         ],
        //         [
        //             'type' => 'js',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/plugins/Buttons-2.4.2/js/buttons.bootstrap5.min.js',
        //         ],
        //         // [
        //         //     'type' => 'js',
        //         //     'asset' => true,
        //         //     'location' => 'vendor/datatables/buttons.server-side.js',
        //         // ],
        //         [
        //             'type' => 'css',
        //             'asset' => true,
        //             'location' => 'vendor/DataTables/DataTables-1.13.10/plugins/Buttons-2.4.2/css/buttons.bootstrap5.min.css',
        //         ],
        //     ],
        // ],
        // 'Select2' => [
        //     'active' => false,
        //     'files' => [
        //         [
        //             'type' => 'js',
        //             'asset' => false,
        //             'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
        //         ],
        //         [
        //             'type' => 'css',
        //             'asset' => false,
        //             'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
        //         ],
        //     ],
        // ],
        'AlertifyJS' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/alertify/alertifyjs/alertify.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/alertify/alertifyjs/css/alertify.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/alertify/alertifyjs/css/themes/default.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
