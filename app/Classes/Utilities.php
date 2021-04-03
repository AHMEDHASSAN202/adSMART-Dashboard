<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Classes;


use App\Models\Flag;
use App\Repositories\LocalizationRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\HtmlString;

class Utilities
{
    public static $paginationPerPage = 10;
    private static $language = null;

    public static function KtDatatableResponse($data, $perpage=null, $sort='asc', $field='id')
    {
        $perpage = $perpage ?: self::$paginationPerPage;

        if (is_array($data) || $data instanceof \Illuminate\Support\Collection) {
            $total = count($data);
            $data = $data;
        }elseif ($data instanceof LengthAwarePaginator) {
            $total = $data->total();
            $data = $data->items();
        }

        $meta['page'] = (int)request()->input('pagination.page', 1);
        $meta['pages'] = ceil($total / $perpage);
        $meta['perpage'] = $perpage;
        $meta['total'] = $total;
        $meta['sort']  = $sort;
        $meta['field']  = $field;

        return ['data' => $data, 'meta' => $meta];
    }

    public static function echoScripts($position='header')
    {
        $scripts = app('document')->getScripts($position);
        $s = '';
        foreach ($scripts as $script) {
            $s .= '<script src="'.$script.'" type="text/javascript"></script>';
        }
        echo $s;
    }

    public static function getAllPermissions()
    {
        $permissions = [
            'dashboard' => ['browse'],
            'settings' => ['browse'],
            'logs' => ['browse'],
            'reports' => ['browse'],
            'roles' => ['browse', 'create', 'update'],
            'localization' => ['browse', 'create', 'update'],
            'users' => ['browse', 'create', 'update'],
        ];

        return $permissions;
    }

    public static function editHtmlButton($editUrl)
    {
        return (new HtmlString('
            <a href="'.$editUrl.'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                <i class="flaticon2-edit"></i>
            </a>
        '))->toHtml();
    }

    public static function deleteHtmlButton($action, $deleteId)
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

    public static function checkBoxHtmlInput($rowId)
    {
        return (new HtmlString('
            <label class="checkbox checkbox-inline">
                <input type="checkbox" name="ids[]" value="'.$rowId.'" form="deleteForm">
                <span></span>
            </label>
        '))->toHtml();
    }

    public static function getLanguages()
    {
        return app(LocalizationRepository::class)->getLanguages();
    }

    public static function setLanguage($language)
    {
        static::$language = $language;
    }

    public static function getLanguage($code=null, $id=null)
    {
        if (!$code && !$id) return static::$language;
        if ($code) return app(LocalizationRepository::class)->getLanguage($code);
        if ($id) return app(LocalizationRepository::class)->getLanguageById($id);
    }

    public static function getLanguageTranslations($lang=null)
    {
        $lang = is_null($lang) ? app()->getLocale() : $lang;
        $translations = app(LocalizationRepository::class)->getTranslations();
        $languageTranslations = $translations->map(function ($trans, $key) use ($lang) {
            return $trans[$lang];
        });
        return $languageTranslations;
    }

    public static function alertFromStatus($status)
    {
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

    public static function initialDashboardData()
    {
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
                    'icon' => 'fas fa-user-friends', // or can be 'flaticon-home' or any flaticon-*
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
                    'icon' => 'flaticon2-shield', // or can be 'flaticon-home' or any flaticon-*
                    'page' => route('dashboard.roles.index'),
                    'extraClasses' => '',
                ],

                // Localization
                [
                    'section' => _e('localization'),
                ],
                [
                    'title' => _e('languages'),
                    'icon' => 'flaticon-squares-1', // or can be 'flaticon-home' or any flaticon-*
                    'page' => route('dashboard.languages.index'),
                    'extraClasses' => '',
                ],
                [
                    'title' => _e('translations'),
                    'icon' => 'flaticon-exclamation-square', // or can be 'flaticon-home' or any flaticon-*
                    'page' => route('dashboard.translations.index'),
                    'extraClasses' => '',
                ],

                // Settings
                [
                    'section' => _e('settings'),
                ],
                [
                    'title' => _e('reports'),
                    'icon' => 'fas fa-user-friends', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '#',
                    'extraClasses' => '',
                ],
                [
                    'title' => _e('settings'),
                    'icon' => 'fas fa-user-friends', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '#',
                    'extraClasses' => '',
                ],
            ],
            'languages' => Utilities::getLanguages(),
            'translations' => Utilities::getLanguageTranslations()
        ];
    }

    public static function getFlags()
    {
        $flags = \Illuminate\Support\Facades\Cache::rememberForever('flags', function () {
            return Flag::all();
        });

        return $flags;
    }
}
