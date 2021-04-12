<?php


function _e($key, $lang=null) {
    $lang = $lang ?: app()->getLocale();

    $keyword = app('App\Repositories\LocalizationRepository')->getTranslate($lang, $key);

    if (!$keyword) {
        return str_replace('_', ' ', $key);
    }

    return $keyword;
}

function _flagSvg($svg) {
    return asset('dashboard-assets/media/flags/' . $svg);
}

function getOption($optionKey) {
    return app(\App\Repositories\OptionRepository::class)->getOption($optionKey);
}

function getOptionValue($optionKey, $default=null) {
    $option = getOption($optionKey);
    return $option ? $option->option_value : $default;
}

function deleteFile($file, $disk='public') {
    return \Illuminate\Support\Facades\Storage::disk($disk)->delete($file);
}

function getAllPermissions($groups=true) {
    $permissions = [
        'dashboard' => ['browse'],
        'settings' => ['browse'],
        'logs' => ['browse'],
        'reports' => ['browse'],
        'roles' => ['browse', 'create', 'update'],
        'localization' => ['browse', 'create', 'update'],
        'users' => ['browse', 'create', 'update'],
    ];

    if ($groups) {
        return $permissions;
    }

    $pers = [];
    foreach ($permissions as $key => $value) {
        foreach ($value as $v) {
            $pers[] = $key . '-' . $v;
        }
    }

    return $pers;
}

function editHtmlButton($editUrl)
{
    return (new HtmlString('
            <a href="'.$editUrl.'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                <i class="flaticon2-edit"></i>
            </a>
        '))->toHtml();
}

function deleteHtmlButton($action, $deleteId)
{
    return (new HtmlString('
            <form action="'.$action.'" method="post" class="d-inline-block">
                ' . csrf_field() . method_field('DELETE') . '
                <input type="hidden" name="ids" value="'.$deleteId.'">
                <button class="btn btn-icon btn-light btn-hover-danger btn-sm mx-3">
                    <i class="flaticon2-rubbish-bin"></i>
                </button>
            </form>      
        '))->toHtml();
}

function checkBoxHtmlInput($rowId)
{
    return (new HtmlString('
            <label class="checkbox checkbox-inline">
                <input type="checkbox" name="ids[]" value="'.$rowId.'" form="deleteForm">
                <span></span>
            </label>
        '))->toHtml();
}

function getLanguages() {
    return app(\App\Repositories\LocalizationRepository::class)->getLanguages();
}

function getLanguage($code=null, $id=null) {
    if (!$code && !$id) {
        $code = app()->getLocale();
    }
    if ($code) return app(\App\Repositories\LocalizationRepository::class)->getLanguage($code);
    if ($id) return app(\App\Repositories\LocalizationRepository::class)->getLanguageById($id);
}

function getLanguageTranslations($lang=null) {
    $lang = is_null($lang) ? app()->getLocale() : $lang;
    $translations = app(\App\Repositories\LocalizationRepository::class)->getTranslations();
    $languageTranslations = $translations->map(function ($trans, $key) use ($lang) {
        return $trans[$lang];
    });
    return $languageTranslations;
}

function alertFromStatus($status) {
    if (!$status) {
        $res = [
            'alert' => [
                'class' => 'danger',
                'title' => _e('error_message'),
                'icon'  => 'flaticon-warning'
            ],
        ];
    }else {
        $res = [
            'alert' => [
                'class' => 'info',
                'title' => _e('success_message'),
                'icon'  => 'flaticon-like'
            ],
        ];
    }
    return $res;
}

function makeAlert($class, $title, $icon) {
    return [
        'alert' => [
            'class' => $class,
            'title' => $title,
            'icon'  => $icon
        ],
    ];
}

function initialDashboardData() {
    return [
        'asideMenu' => [
            // Dashboard
            [
                'title' => _e('dashboard'),
                'icon' => 'fas fa-qrcode',
                'page' => route('dashboard.index'),
                'extraClasses' => '',
            ],

            // Custom
            [
                'section' => _e('catalog'),
            ],
            [
                'title' => _e('categories'),
                'icon' => 'fas fa-user-friends',
                'page' => '#',
                'extraClasses' => '',
                'submenu' => [
                    [
                        'title' => _e('new_category'),
                        'page'  => '#',
                        'extraClasses' => '',
                        'icon'      => 'flaticon2-line'
                    ],
                    [
                        'title' => _e('categories'),
                        'page'  => '#',
                        'extraClasses' => '',
                        'icon'      => 'flaticon2-line'
                    ]
                ]
            ],
            [
                'title' => _e('pages'),
                'icon' => 'fas fa-user-friends',
                'extraClasses' => '',
                'page' => '#',
                'submenu' => [
                    [
                        'title' => _e('new_page'),
                        'page'  => '#',
                        'extraClasses' => '',
                        'icon'      => 'flaticon2-line'
                    ],
                    [
                        'title' => _e('pages'),
                        'page'  => '#',
                        'extraClasses' => '',
                        'icon'      => 'flaticon2-line'
                    ]
                ]
            ],
            [
                'title' => _e('media'),
                'icon' => 'fas fa-user-friends',
                'page' => '#',
                'extraClasses' => '',
            ],

            // Users
            [
                'section' => _e('users'),
            ],
            [
                'title' => _e('users'),
                'icon' => 'fas fa-user-friends',
                'page' => '#',
                'extraClasses' => '',
                'submenu' => [
                    [
                        'title' => _e('new_user'),
                        'page'  => '#',
                        'bullet' => 'dot',
                        'extraClasses' => '',
                        'icon'      => 'flaticon2-line'
                    ],
                    [
                        'title' => _e('users'),
                        'page'  => '#',
                        'bullet' => 'dot',
                        'extraClasses' => '',
                        'icon'      => 'flaticon2-line'
                    ]
                ],
            ],
            [
                'title' => _e('roles'),
                'icon' => 'flaticon2-shield',
                'page' => route('dashboard.roles.index'),
                'extraClasses' => '',
            ],

            // Localization
            [
                'section' => _e('localization'),
            ],
            [
                'title' => _e('languages'),
                'icon' => 'flaticon-squares-1',
                'page' => route('dashboard.languages.index'),
                'extraClasses' => '',
            ],
            [
                'title' => _e('translations'),
                'icon' => 'flaticon-exclamation-square',
                'page' => route('dashboard.translations.index'),
                'extraClasses' => '',
            ],

            // Settings
            [
                'section' => _e('settings'),
            ],
            [
                'title' => _e('reports'),
                'icon' => 'fas fa-user-friends',
                'page' => '#',
                'extraClasses' => '',
            ],
            [
                'title' => _e('settings'),
                'icon' => 'flaticon2-settings',
                'page' => route('dashboard.settings.index'),
                'extraClasses' => '',
            ],
        ],
        'languages' => getLanguages(),
        'translations' => getLanguageTranslations()
    ];
}

function getFlags() {
    $flags = \Illuminate\Support\Facades\Cache::rememberForever('flags', function () {
        return \App\Models\Flag::all();
    });

    return $flags;
}
