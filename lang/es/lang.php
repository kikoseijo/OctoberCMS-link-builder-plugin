<?php

return [

    'links' => 'Enlaces',

    'plugin' => [
        'name'        => 'Motor de enlaces',
        'description' => 'Muestra un listado de enlaces en tu web o solo 1 usando los componentes.',
    ],

    'navigation' => [
        'label'    => 'Motor de enlaces',
        'sideMenu' => [
            'items'      => 'Enlaces',
            'categories' => 'Categorías',
            'settings'   => 'Ajustes',
        ],
    ],

    'settings' => [
        'menuLabel'       => 'Ajustes',
        'menuDescription' => 'Permite ajuster el framework y las páginas por defecto',
        'detail_page'     => 'Página detalle del link',
        'links_page'      => 'Página de los listados de links',
        'general'         => 'Opciones generales',
        'style'           => 'Opciones de renderizado de parciales',
        'syleLabel'       => 'Selecciona el framework para aplicar los estilos en los parciales',
    ],

    'button' => [
        'activate'   => 'Activar',
        'deactivate' => 'Ocultar',
        'import'     => 'Importar',
        'export'     => 'Exportar',
    ],

    'controller' => [
        'view' => [
            'items'      => [
                'new'                 => 'Nuevo enlace',
                'breadcrumb_label'    => 'Enlaces',
                'return'              => 'Volver al listado de enlaces',
                'creating'            => 'Creando enlace...',
                'delete_confirmation' => 'Seguro que quires eliminar este enlace?',
            ],
            'categories' => [
                'new'                 => 'Nueva categoría',
                'breadcrumb_label'    => 'Categorías',
                'return'              => 'Volver al listado de categorías',
                'creating'            => 'Creando categoría...',
                'delete_confirmation' => 'Seguro que quires borrar esta categoría?',
            ],
        ],
        'list' => [
            'items'      => 'Administrar enlaces',
            'categories' => 'Administrar categorías',
        ],
        'form' => [
            'items'      => [
                'title'       => 'Enlace',
                'create'      => 'Crear nuevo Enlace',
                'update'      => 'Actualizar enlace',
                'flashCreate' => 'El enlace se ha creado con éxito',
                'flashUpdate' => 'El enlace se ha actualizado con éxito',
                'flashDelete' => 'El enlace se ha eliminado con éxito',
            ],
            'categories' => [
                'title'       => 'Category',
                'create'      => 'Crear categoría',
                'update'      => 'Actualizar categoría',
                'flashCreate' => 'La categoría se ha creado con éxito',
                'flashUpdate' => 'La categoría se ha actualizado con éxito',
                'flashDelete' => 'La categoría se ha eliminado con éxito',
            ],
        ],
    ],

    'columns' => [
        'item'     => [
            'title'   => 'Titulo',
            'link'    => 'Enlace',
            'image'   => 'Imágen',
            'phone'   => 'Teléfono',
            'order'   => 'Orden',
            'target'  => 'Abrir enlace en nueva ventana',
            'enabled' => 'Habilitado',
        ],
        'category' => [
            'id'          => 'ID',
            'name'        => 'Categoría',
            'description' => 'Descripción',
        ],
    ],

    'fields' => [
        'item'     => [
            'title'      => 'Titulo',
            'link'       => 'Url del Enlace',
            'image'      => 'Imágen',
            'extra_data' => 'Link description',
            'phone'      => 'Teléfono',
            'order'      => 'Orden',
            'target'     => 'Abrir en ventana nueva',
            'enabled'    => 'Habilitado',
            'slug'       => 'Permalink del enlace (slug)',
        ],
        'category' => [
            'name'        => 'Nombre',
            'slug'        => 'Permalink (slug)',
            'description' => 'Descripción',
        ],
    ],

    'components' => [
        'visit_website' => 'Visitar sitio web',
        'item'          => [
            'name'        => 'Detalles del enlace',
            'description' => 'Mostrar enlace en la web.',
            'properties'  => [
                'item'     => [
                    'title'       => 'Enlace a mostrar',
                    'description' => 'Seleccione un enlace a mostrar. Será sobre-escrito por una posible variable en la url.',
                    'none'        => 'Ninguno',
                ],
                'itemSlug' => [
                    'title'       => 'Slug del enlace',
                    'description' => 'Identificador de la url del Slug del enlace.',
                ],
            ],
        ],
        'links'         => [
            'name'        => 'Listado de enlaces',
            'description' => 'Muestra un listado de enlaces',
            'properties'  => [
                'category'       => [
                    'title'       => 'Categoría',
                    'placeholder' => 'Seleccione categoría',
                    'all'         => 'Todas',
                ],
                'pageNumber'     => [
                    'title'       => 'Número de página',
                    'description' => 'Esta variable se usa para determinar el número de página en la que se encuentra el usuario.',
                ],
                'itemsPerPage'   => [
                    'title'             => 'Número de enlaces por página',
                    'validationMessage' => 'El formato del valor del número de página ha de ser numérico',
                ],
                'order'          => [
                    'title'       => 'Orden',
                    'placeholder' => 'Seleccione el orden',
                    'ascending'   => 'Ascendente',
                    'descending'  => 'Descendente',
                ],
                'group'          => [
                    'advanced'  => 'Avanzado',
                    'links'     => 'Enlaces',
                    'menuStyle' => 'Personaliza el template "Menú"',
                ],
                'selectedCat'    => [
                    'title'       => 'Seleccione categoría',
                    'description' => 'No modificar este valor (default: {{ :selected_cat }})',
                ],
                'itemPage'       => [
                    'title'       => 'Página de detalle',
                    'description' => 'Página donde se ha incluido el componente de vista en detalle.',
                ],
                'catListPage'    => [
                    'title'       => 'Listado de enlaces',
                    'description' => 'Página donde se ha includio el componente de listado de enlaces.',
                ],
                'listTemplate'   => [
                    'title'       => 'Plantilla para el listado',
                    'description' => 'Selecciona la plantilla que quieras usar para mostrar el listado.',
                ],
                'showCategories' => [
                    'title'       => 'Mostrar categorías',
                    'description' => 'Deshabilitado no mostrará la navegación por categorías.',
                ],
                'showPagination' => [
                    'title'       => 'Mostrar paginación',
                    'description' => 'Deshabilitado no mostrará los números de páginas.',
                ],
                'ulClass'        => [
                    'title'       => 'Estilo del ul',
                    'description' => 'El estilo se asignará al "ul" tag. (Solo válido en Menú template)',
                ],
                'liClass'        => [
                    'title'       => 'Estilo del li',
                    'description' => 'El estilo se asignará al "li" tag. (Solo válido en Menú template)',
                ],
                'aClass'         => [
                    'title'       => 'Estilo del a',
                    'description' => 'El estilo se asignará al "a" tag. (Solo válido en Menú template)',
                ],
            ],
        ],
    ],

    'form' => [
        'status'           => 'Estado',
        'status_published' => 'Publicado',
        'status_hide'      => 'Oculto',
        'status_draft'     => 'Borrador',
        'status_active'    => 'Activo',
        'featured'         => 'Destacado',
    ],

];
