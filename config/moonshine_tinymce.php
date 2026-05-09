<?php

return [
    'token' => env('TINYMCE_TOKEN', ''),
    'plugins' => [
        'anchor', 'autolink', 'autoresize', 'charmap', 'codesample', 'code', 'emoticons', 'image', 'link',
        'lists', 'advlist', 'media', 'searchreplace', 'table', 'wordcount', 'directionality',
        'fullscreen', 'help', 'nonbreaking', 'pagebreak', 'preview', 'visualblocks', 'visualchars'
    ],
    'menubar' => 'file edit insert view format table tools',
    'toolbar' => 'undo redo | blocks fontfamily fontsize styles | bold italic underline strikethrough | '
        . 'link image media table tabledelete hr nonbreaking pagebreak | align lineheight | '
        . 'numlist bullist indent outdent | emoticons charmap | removeformat | codesample | ltr rtl | '
        . 'tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | '
        . 'tableinsertcolbefore tableinsertcolafter tabledeletecol | '
        . 'myblocks | fullscreen preview print visualblocks visualchars code | help',

    'options' => [
        'extended_valid_elements' => 'section[class|style|id|data-*],div[class|style|id|data-*]',

        // ВАШИ КЛАССЫ ЗДЕСЬ ↓
        'style_formats' => [
            // Секции с вашими классами
            ['title' => 'Секция - основной контент', 'block' => 'section', 'classes' => 'content-section', 'wrapper' => true],
            ['title' => 'Секция - герой блок', 'block' => 'section', 'classes' => 'hero-section', 'wrapper' => true],
            ['title' => 'Секция - услуги', 'block' => 'section', 'classes' => 'services', 'wrapper' => true],
            ['title' => 'Секция - о компании', 'block' => 'section', 'classes' => 'about-company', 'wrapper' => true],

            // Div с вашими классами
            ['title' => 'Контейнер 1200px', 'block' => 'div', 'classes' => 'container-1200', 'wrapper' => true],
            ['title' => 'Текстовый блок', 'block' => 'div', 'classes' => 'text-block', 'wrapper' => true],
            ['title' => 'Изображение с подписью', 'block' => 'div', 'classes' => 'image-caption', 'wrapper' => true],
            ['title' => 'Цитата', 'block' => 'div', 'classes' => 'quote-block', 'wrapper' => true],

            // Элементы с несколькими классами
            ['title' => 'Карточка', 'block' => 'div', 'classes' => 'card shadow rounded', 'wrapper' => true],
            ['title' => 'Кнопка', 'selector' => 'a,button', 'classes' => 'btn btn-primary'],
            ['title' => 'Алерт', 'block' => 'div', 'classes' => 'alert alert-info', 'wrapper' => true],
        ],

        'content_style' => '
            .content-section { padding: 40px 0; }
            .hero-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 80px 0; }
            .services { background: #f8f9fa; padding: 60px 0; }
            .container-1200 { max-width: 1200px; margin: 0 auto; padding: 0 15px; }
            .text-block { line-height: 1.6; margin-bottom: 20px; }
            .image-caption { margin: 20px 0; }
            .image-caption img { max-width: 100%; }
            .quote-block { border-left: 4px solid #3498db; padding-left: 20px; font-style: italic; margin: 20px 0; }
            .card { padding: 20px; border: 1px solid #ddd; margin: 15px 0; }
            .shadow { box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            .rounded { border-radius: 8px; }
            .btn { display: inline-block; padding: 10px 20px; background: #007bff; color: white;
                   text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
            .btn-primary { background: #007bff; }
            .alert { padding: 15px; border-radius: 4px; margin: 15px 0; }
            .alert-info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; }
        ',
    ],

    'callbacks' => [
        'setup' => "function(editor) {
            // Кнопка для вставки блока с выбором класса
            editor.ui.registry.addButton('myblocks', {
                icon: 'plus',
                tooltip: 'Вставить блок',
                onAction: function() {
                    editor.windowManager.open({
                        title: 'Вставить блок с вашим классом',
                        body: {
                            type: 'panel',
                            items: [
                                {
                                    type: 'selectbox',
                                    name: 'blocktype',
                                    label: 'Тип элемента',
                                    items: [
                                        { value: 'section', text: 'Секция (section)' },
                                        { value: 'div', text: 'Блок (div)' },
                                        { value: 'article', text: 'Статья (article)' }
                                    ]
                                },
                                {
                                    type: 'selectbox',
                                    name: 'presetclass',
                                    label: 'Готовый класс',
                                    items: [
                                        { value: '', text: '-- Без класса --' },
                                        { value: 'content-section', text: 'Основная секция' },
                                        { value: 'hero-section', text: 'Герой блок' },
                                        { value: 'services', text: 'Секция услуг' },
                                        { value: 'container-1200', text: 'Контейнер 1200px' },
                                        { value: 'text-block', text: 'Текстовый блок' },
                                        { value: 'card shadow rounded', text: 'Карточка' }
                                    ]
                                },
                                {
                                    type: 'input',
                                    name: 'customclass',
                                    label: 'Или свой класс'
                                },
                                {
                                    type: 'checkbox',
                                    name: 'addtitle',
                                    label: 'Добавить заголовок H2'
                                }
                            ]
                        },
                        buttons: [
                            { type: 'cancel', text: 'Отмена' },
                            {
                                type: 'submit',
                                text: 'Вставить',
                                primary: true
                            }
                        ],
                        onSubmit: function(api) {
                            var data = api.getData();
                            var className = data.customclass || data.presetclass;
                            var classAttr = className ? ' class=\"' + className + '\"' : '';

                            var content = '<' + data.blocktype + classAttr + '>';
                            if (data.addtitle) content += '<h2>Заголовок</h2>';
                            content += '<p>Содержимое блока. Отредактируйте этот текст.</p>';
                            content += '</' + data.blocktype + '>';

                            editor.insertContent(content);
                            api.close();
                        }
                    });
                }
            });

            // Быстрые кнопки для часто используемых блоков
            editor.ui.registry.addButton('insertherosection', {
                text: 'Герой блок',
                tooltip: 'Вставить герой секцию',
                onAction: function() {
                    editor.insertContent(
                        '<section class=\"hero-section\">' +
                        '<h1>Заголовок героя</h1>' +
                        '<p>Описание герой блока. Измените этот текст.</p>' +
                        '</section>'
                    );
                }
            });

            editor.ui.registry.addButton('insertcard', {
                text: 'Карточка',
                tooltip: 'Вставить карточку',
                onAction: function() {
                    editor.insertContent(
                        '<div class=\"card shadow rounded\">' +
                        '<h3>Заголовок карточки</h3>' +
                        '<p>Содержимое карточки. Редактируйте этот текст.</p>' +
                        '</div>'
                    );
                }
            });

            // Контекстное меню для изменения классов существующих элементов
            editor.ui.registry.addContextToolbar('changeclass', {
                predicate: function(node) {
                    return node.nodeName === 'SECTION' || node.nodeName === 'DIV' || node.nodeName === 'ARTICLE';
                },
                items: 'myblocks | removeformat',
                position: 'node',
                scope: 'node'
            });
        }"
    ],
];
