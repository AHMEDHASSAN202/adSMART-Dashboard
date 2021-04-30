<?php


use App\Repositories\AuthRepository;

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
        'settings' => ['browse', 'update'],
        'logs' => ['browse'],
        'reports' => ['browse'],
        'roles' => ['browse', 'create', 'update', 'delete'],
        'localization' => ['browse', 'create', 'update', 'delete'],
        'users' => ['browse', 'create', 'update', 'delete'],
        'pages' => ['browse', 'create', 'update', 'delete'],
        'types' => ['browse', 'create', 'update', 'delete'],
        'categories' => ['browse', 'create', 'update', 'delete'],
        'chats' => ['browse'],
        'chat_groups' => ['browse', 'create'],
        'services' => ['browse', 'update'],
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
        return @$trans[$lang];
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
                'title'         => _e('dashboard'),
                'icon'          => 'fas fa-qrcode',
                'page'          => route('dashboard.index'),
                'extraClasses'  => '',
                'id'            => 'dashboard',
                'permissions'   => ['dashboard-browse']
            ],

            // Custom
            [
                'section' => _e('catalog'),
            ],
            [
                'title' => _e('categories'),
                'icon' => 'fas fa-user-friends',
                'page' => route('dashboard.categories.index'),
                'extraClasses' => '',
                'id'            => 'categories',
                'permissions'   => ['categories-browse']
            ],
            [
                'section' => _e('pages'),
            ],
            [
                'title' => _e('pages'),
                'page'  => route('dashboard.pages.index'),
                'extraClasses' => '',
                'icon'      => 'flaticon2-document',
                'permissions'   => ['pages-browse'],
                'id'           => 'pages',
            ],
            [
                'title' => _e(['pages', 'types']),
                'page'  => route('dashboard.types.index', ['type_key' => 'page_type']),
                'extraClasses' => '',
                'icon'      => 'flaticon2-medical-records',
                'permissions'   => ['types-browse'],
                'id'           => 'page_type',
            ],
            // Users
            [
                'section' => _e('users'),
            ],
            [
                'title' => _e('users'),
                'icon' => 'flaticon2-avatar',
                'page' => route('dashboard.users.index'),
                'extraClasses' => '',
                'permissions'   => ['users-browse'],
                'id'           => 'users',
            ],
            [
                'title' => _e('roles'),
                'icon' => 'flaticon2-shield',
                'page' => route('dashboard.roles.index'),
                'extraClasses' => '',
                'id'           => 'roles',
                'permissions'   => ['roles-browse']
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
                'id'           => 'languages',
                'permissions'   => ['localization-browse']
            ],
            [
                'title' => _e('translations'),
                'icon' => 'flaticon-exclamation-square',
                'page' => route('dashboard.translations.index'),
                'extraClasses' => '',
                'id'           => 'translations',
                'permissions'   => ['localization-browse']
            ],
            // Chat
            [
                'section' => _e('chat'),
            ],
            [
                'title' => _e('chat'),
                'icon' => 'flaticon2-talk',
                'page' => route('dashboard.chat.index'),
                'extraClasses' => '',
                'id'           => 'chat',
                'permissions'   => ['chats-browse']
            ],
            [
                'title' => _e('chat_groups'),
                'icon' => 'flaticon2-group',
                'page' => route('dashboard.chat_groups.index'),
                'extraClasses' => '',
                'id'           => 'chat_groups',
                'permissions'   => ['chat_groups-browse']
            ],

            // Settings
            [
                'section' => _e('settings'),
            ],
            [
                'title' => _e('services'),
                'icon' => 'flaticon2-email',
                'page' => route('dashboard.services.settings'),
                'extraClasses' => '',
                'id'           => 'services',
                'permissions'   => ['services-browse']
            ],
            [
                'title' => _e('settings'),
                'icon' => 'flaticon2-settings',
                'page' => route('dashboard.settings.index'),
                'extraClasses' => '',
                'id'           => 'settings',
                'permissions'   => ['settings-browse']
            ],
        ],
        'languages' => getLanguages(),
        'translations' => getLanguageTranslations(),
        'user_token' => app(AuthRepository::class)->getAdmin()->user_token
    ];
}

function getFlags() {
    $flags = \Illuminate\Support\Facades\Cache::rememberForever('flags', function () {
        return \App\Models\Flag::all();
    });

    return $flags;
}

function clearCacheAllLanguages($key) {
    $languages = getLanguages();
    foreach ($languages as $language) {
        \Illuminate\Support\Facades\Cache::forget($key . ':' . $language->language_code);
    }
}
