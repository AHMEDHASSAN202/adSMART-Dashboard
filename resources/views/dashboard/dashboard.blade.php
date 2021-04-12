<?php $language = getLanguage() ?>
<!DOCTYPE html>
<html lang="{{$language->language_code}}" dir="{{$language->language_direction}}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--begin::Fonts-->
        @if($language->language_direction == 'rtl')
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600&display=swap" rel="stylesheet">
        @else
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        @endif
        <!--end::Fonts-->

        <!--begin::Global Theme Styles(used by all pages)-->
        @if($language->language_direction == 'rtl')
            <link href="{{ asset('dashboard-assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
        @else
            <link href="{{ asset('dashboard-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        @endif
        <!--end::Global Theme Styles-->

        <!--begin::Layout Themes(used by all pages)-->
        @if($language->language_direction == 'rtl')
            <link href="{{ asset('dashboard-assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css"/>
        @else
            <link href="{{ asset('dashboard-assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('dashboard-assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css"/>
        @endif
        <!--end::Layout Themes-->

        <link rel="shortcut icon" href="{{ asset('dashboard-assets/media/logos/favicon.ico') }}"/>

        <link href="{{ mix('/css/dashboard.css') }}" rel="stylesheet"/>
        <script src="{{ mix('/js/dashboard.js') }}" defer></script>
        <script>
            <?php $initialData = initialDashboardData() ?>
            window.asideMenu = @json($initialData['asideMenu']);
            window.languages = @json($initialData['languages']);
            window.translations = @json($initialData['translations']);
            window.currentLanguage = @json($language);
            window.csrfToken = @json(csrf_token());
        </script>

    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

        @routes

        @inertia

    </body>
</html>
