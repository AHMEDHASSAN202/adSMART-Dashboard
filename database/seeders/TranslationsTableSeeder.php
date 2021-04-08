<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translation;

class TranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Translation::insert([
            [
                'translation_key'       => 'website',
                'translation_value'     => 'Website',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'website',
                'translation_value'     => 'الموقع',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'dashboard',
                'translation_value'     => 'Dashboard',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'dashboard',
                'translation_value'     => 'لوحة التحكم',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'dashboard_description',
                'translation_value'     => 'Dashboard Description',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'dashboard_description',
                'translation_value'     => 'الصفحة الرئيسية للموقع',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'general',
                'translation_value'     => 'General',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'general',
                'translation_value'     => 'عام',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'stores',
                'translation_value'     => 'Stores',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'stores',
                'translation_value'     => 'المتاجر',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'all_stores',
                'translation_value'     => 'All Stores',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'all_stores',
                'translation_value'     => 'جميع المتاجر',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'store_approvals',
                'translation_value'     => 'Store Approvals',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'store_approvals',
                'translation_value'     => 'موافقات المتاجر',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'catalog',
                'translation_value'     => 'Catalog',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'catalog',
                'translation_value'     => 'الفهرس',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'products',
                'translation_value'     => 'Products',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'products',
                'translation_value'     => 'المنتجات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'categories',
                'translation_value'     => 'Categories',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'categories',
                'translation_value'     => 'الاقسام',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'brands',
                'translation_value'     => 'Brands',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'brands',
                'translation_value'     => 'علامات تجارية',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'attributes',
                'translation_value'     => 'Attributes',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'attributes',
                'translation_value'     => 'السمات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'attribute_groups',
                'translation_value'     => 'Attribute Groups',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'attribute_groups',
                'translation_value'     => 'مجموعات السمات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'options',
                'translation_value'     => 'Options',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'options',
                'translation_value'     => 'الخيارات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'tags',
                'translation_value'     => 'Tags',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'tags',
                'translation_value'     => 'تاج',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'reviews',
                'translation_value'     => 'Reviews',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'reviews',
                'translation_value'     => 'تقييم',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'sale',
                'translation_value'     => 'Sales',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'sale',
                'translation_value'     => 'المبيعات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'orders',
                'translation_value'     => 'Orders',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'orders',
                'translation_value'     => 'الطلبات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'order',
                'translation_value'     => 'Order',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'order',
                'translation_value'     => 'طلب',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'transaction',
                'translation_value'     => 'Transaction',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'transaction',
                'translation_value'     => 'التحويلات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'returns',
                'translation_value'     => 'Returns',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'returns',
                'translation_value'     => 'المرتجعات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'customers',
                'translation_value'     => 'Customers',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'customers',
                'translation_value'     => 'العملاء',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'customer',
                'translation_value'     => 'Customer',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'customer',
                'translation_value'     => 'عميل',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'customer_approvals',
                'translation_value'     => 'Customer Approvals',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'customer_approvals',
                'translation_value'     => 'موافقات العملاء',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'coupon',
                'translation_value'     => 'Coupon',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'coupon',
                'translation_value'     => 'كوبون',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'pages',
                'translation_value'     => 'Pages',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'pages',
                'translation_value'     => 'الصفحات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'new_page',
                'translation_value'     => 'New Page',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'new_page',
                'translation_value'     => 'صفحة جديدة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'media',
                'translation_value'     => 'Media',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'media',
                'translation_value'     => 'الصور',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'localization',
                'translation_value'     => 'Localization',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'localization',
                'translation_value'     => 'اللغات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'languages',
                'translation_value'     => 'Languages',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'languages',
                'translation_value'     => 'اللغات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'language',
                'translation_value'     => 'Language',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'language',
                'translation_value'     => 'للغة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'translations',
                'translation_value'     => 'Translations',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'translations',
                'translation_value'     => 'الترجمة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'currency_rate',
                'translation_value'     => 'Currency Rate',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'currency_rate',
                'translation_value'     => 'اسعار العملات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'taxes',
                'translation_value'     => 'Taxes',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'taxes',
                'translation_value'     => 'الضريبة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'users',
                'translation_value'     => 'Users',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'users',
                'translation_value'     => 'المستخدمين',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'roles',
                'translation_value'     => 'Roles',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'roles',
                'translation_value'     => 'الصلاحيات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'role',
                'translation_value'     => 'Role',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'role',
                'translation_value'     => 'صلاحية',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'reports',
                'translation_value'     => 'Reports',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'reports',
                'translation_value'     => 'التقارير',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'report',
                'translation_value'     => 'Report',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'report',
                'translation_value'     => 'تقرير',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'posts',
                'translation_value'     => 'Posts',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'posts',
                'translation_value'     => 'منشورات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'post',
                'translation_value'     => 'Post',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'post',
                'translation_value'     => 'منشور',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'logs',
                'translation_value'     => 'Logs',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'logs',
                'translation_value'     => 'للوج',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'settings',
                'translation_value'     => 'Settings',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'settings',
                'translation_value'     => 'الاعدادات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'cache',
                'translation_value'     => 'Cache',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'cache',
                'translation_value'     => 'كاش',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'clear_cache',
                'translation_value'     => 'Clear Cache',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'clear_cache',
                'translation_value'     => 'مسح الكاش',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'settings_description',
                'translation_value'     => 'Browse and Modify Settings',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'settings_description',
                'translation_value'     => 'تصفح وحدث الاعدادات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'create',
                'translation_value'     => 'Create',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'create',
                'translation_value'     => 'اضافة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'save',
                'translation_value'     => 'Save',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'save',
                'translation_value'     => 'حفظ',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'send',
                'translation_value'     => 'Send',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'send',
                'translation_value'     => 'ارسال',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'add',
                'translation_value'     => 'Add',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'add',
                'translation_value'     => 'اضافة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'delete',
                'translation_value'     => 'Delete',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'delete',
                'translation_value'     => 'حذف',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'edit',
                'translation_value'     => 'Edit',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'edit',
                'translation_value'     => 'تعديل',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'update',
                'translation_value'     => 'Update',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'update',
                'translation_value'     => 'تحديث',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'browse',
                'translation_value'     => 'Browse',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'browse',
                'translation_value'     => 'تصفح',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'click',
                'translation_value'     => 'Click',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'click',
                'translation_value'     => 'اضغط',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'actions',
                'translation_value'     => 'Actions',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'actions',
                'translation_value'     => 'الاجراءات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'search',
                'translation_value'     => 'Search',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'search',
                'translation_value'     => 'بحث',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'name',
                'translation_value'     => 'Name',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'name',
                'translation_value'     => 'الاسم',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'email',
                'translation_value'     => 'Email',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'email',
                'translation_value'     => 'البريد الالكتروني',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'location',
                'translation_value'     => 'Location',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'location',
                'translation_value'     => 'الموقع',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'phone',
                'translation_value'     => 'Phone',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'phone',
                'translation_value'     => 'الهاتف',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'registration_date',
                'translation_value'     => 'Registration date',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'registration_date',
                'translation_value'     => 'تاريخ التسجيل',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'view',
                'translation_value'     => 'View',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'view',
                'translation_value'     => 'عرض',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'view_all',
                'translation_value'     => 'View all',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'view_all',
                'translation_value'     => 'عرض الكل',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'profile_info',
                'translation_value'     => 'My Profile',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'profile_info',
                'translation_value'     => 'معلوماتك الشخصية',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'account_desc',
                'translation_value'     => 'Account settings and more',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'account_desc',
                'translation_value'     => 'اعدادات الحساب والامان',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'manage_the_profile_data',
                'translation_value'     => 'Manage the profile data',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'manage_the_profile_data',
                'translation_value'     => 'حدث معلوماتك الشخصية',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'password',
                'translation_value'     => 'Password',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'password',
                'translation_value'     => 'كلمة المرور',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'update_password',
                'translation_value'     => 'Update Password',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'update_password',
                'translation_value'     => 'تعديل كلمة المرور',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'current_password',
                'translation_value'     => 'Current Password',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'current_password',
                'translation_value'     => 'كلمة المرور الحالية',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'new_password',
                'translation_value'     => 'New Password',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'new_password',
                'translation_value'     => 'كلمة المرور الجديدة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'confirm_password',
                'translation_value'     => 'Confirm Password',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'confirm_password',
                'translation_value'     => 'تأكيد كلمة المرور',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'hi',
                'translation_value'     => 'He',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'hi',
                'translation_value'     => 'مرحبا',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'new_category',
                'translation_value'     => 'New Category',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'new_category',
                'translation_value'     => 'قسم جديد',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'new_user',
                'translation_value'     => 'New User',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'new_user',
                'translation_value'     => 'مستخدم جديد',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'new_users',
                'translation_value'     => 'New Users',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'new_users',
                'translation_value'     => 'مستخدمين جدد',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'quick_access',
                'translation_value'     => 'Quick access',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'quick_access',
                'translation_value'     => 'الوصول السريع',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'user_profile',
                'translation_value'     => 'User Profile',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'user_profile',
                'translation_value'     => 'الحساب الشخصي',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'messages',
                'translation_value'     => 'Messages',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'messages',
                'translation_value'     => 'رسالة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'the_messages',
                'translation_value'     => 'Messages',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'the_messages',
                'translation_value'     => 'الرسائل',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'my_messages',
                'translation_value'     => 'My Messages',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'my_messages',
                'translation_value'     => 'رسائلي',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'my_messages_desc',
                'translation_value'     => 'My Messages and Inbox',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'my_messages_desc',
                'translation_value'     => 'رسائلي والصندوق الوارد',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'my_activities',
                'translation_value'     => 'My Activities',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'my_activities',
                'translation_value'     => 'نشاطي',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'notification',
                'translation_value'     => 'Notification',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'notification',
                'translation_value'     => 'اشعارات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'my_notification',
                'translation_value'     => 'My Notification',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'my_notification',
                'translation_value'     => 'اشعاراتي',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'recent_notifications',
                'translation_value'     => 'Recent Notifications',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'recent_notifications',
                'translation_value'     => 'اخر الاشعارات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'sales_stat',
                'translation_value'     => 'Sales Stat',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'sales_stat',
                'translation_value'     => 'إحصائيات المبيعات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'weekly_sales',
                'translation_value'     => 'Weekly Sales',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'weekly_sales',
                'translation_value'     => 'المبيعات الأسبوعية',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'export',
                'translation_value'     => 'Export',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'export',
                'translation_value'     => 'تصدير',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'import',
                'translation_value'     => 'Import',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'import',
                'translation_value'     => 'استيراد',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'import',
                'translation_value'     => 'Import',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'import',
                'translation_value'     => 'استيراد',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'add_new',
                'translation_value'     => 'Add New',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'add_new',
                'translation_value'     => 'اضافة جديد',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'events',
                'translation_value'     => 'Events',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'events',
                'translation_value'     => 'أحداث',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'event',
                'translation_value'     => 'Event',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'event',
                'translation_value'     => 'حدث',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'files',
                'translation_value'     => 'Files',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'files',
                'translation_value'     => 'ملفات',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'file',
                'translation_value'     => 'File',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'file',
                'translation_value'     => 'ملف',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'item_orders',
                'translation_value'     => 'Item Orders',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'item_orders',
                'translation_value'     => 'العناصر المطلوبة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'items',
                'translation_value'     => 'Items',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'items',
                'translation_value'     => 'عناصر',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'item',
                'translation_value'     => 'Item',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'item',
                'translation_value'     => 'عنصر',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'bug_reports',
                'translation_value'     => 'Bug Reports',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'bug_reports',
                'translation_value'     => 'تقارير الأخطاء',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'recent_activities',
                'translation_value'     => 'Recent Activities',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'recent_activities',
                'translation_value'     => 'أنشطة حالية',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'your_weekly_sales_chart',
                'translation_value'     => 'Your Weekly Sales Chart',
                'translation_lang'      => 'en',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'your_weekly_sales_chart',
                'translation_value'     => 'مخطط المبيعات الأسبوعي الخاص بك',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'please_wait',
                'translation_value'     => 'Please wait',
                'translation_lang'      => 'en',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'please_wait',
                'translation_value'     => 'انتظر من فضلك',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'success_message',
                'translation_value'     => 'Action completed successfully',
                'translation_lang'      => 'en',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'success_message',
                'translation_value'     => 'الاجراء تم بنجاح',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'error_message',
                'translation_value'     => 'Sorry, an error occurred',
                'translation_lang'      => 'en',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'error_message',
                'translation_value'     => 'عفوا. حدث خطأ',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'yes',
                'translation_value'     => 'Yes',
                'translation_lang'      => 'en',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'yes',
                'translation_value'     => 'نعم',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'no',
                'translation_value'     => 'No',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'no',
                'translation_value'     => 'لا',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'rtl',
                'translation_value'     => 'Right To Left',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'rtl',
                'translation_value'     => 'من اليمين الى اليسار',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'ltr',
                'translation_value'     => 'Left To Right',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'ltr',
                'translation_value'     => 'من اليسار الى اليمين',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'code',
                'translation_value'     => 'Code',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'code',
                'translation_value'     => 'الرمز',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'direction',
                'translation_value'     => 'Direction',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'direction',
                'translation_value'     => 'الإتجاه',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'display_front',
                'translation_value'     => 'Display Front',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'display_front',
                'translation_value'     => 'يظهر في الواجهة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'username',
                'translation_value'     => 'Username',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'username',
                'translation_value'     => 'اسم المُستخدم',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'first_name',
                'translation_value'     => 'First name',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'first_name',
                'translation_value'     => 'الاسم الأول',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'last_name',
                'translation_value'     => 'Last name',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'last_name',
                'translation_value'     => 'اسم العائلة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'password_confirmation',
                'translation_value'     => 'Password confirmation',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'password_confirmation',
                'translation_value'     => 'تأكيد كلمة المرور',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'city',
                'translation_value'     => 'City',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'city',
                'translation_value'     => 'المدينة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'country',
                'translation_value'     => 'Country',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'country',
                'translation_value'     => 'الدولة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'address',
                'translation_value'     => 'address',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'address',
                'translation_value'     => 'العنوان',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'phone',
                'translation_value'     => 'Phone',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'phone',
                'translation_value'     => 'الهاتف',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'mobile',
                'translation_value'     => 'Mobile',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'mobile',
                'translation_value'     => 'الجوال',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'age',
                'translation_value'     => 'age',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'age',
                'translation_value'     => 'العمر',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'sex',
                'translation_value'     => 'Sex',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'sex',
                'translation_value'     => 'الجنس',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'gender',
                'translation_value'     => 'Gender',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'gender',
                'translation_value'     => 'النوع',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'day',
                'translation_value'     => 'day',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'day',
                'translation_value'     => 'اليوم',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'month',
                'translation_value'     => 'month',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'month',
                'translation_value'     => 'الشهر',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'year',
                'translation_value'     => 'year',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'year',
                'translation_value'     => 'السنة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'hour',
                'translation_value'     => 'hour',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'hour',
                'translation_value'     => 'ساعة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'minute',
                'translation_value'     => 'minute',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'minute',
                'translation_value'     => 'دقيقة',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'second',
                'translation_value'     => 'second',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'second',
                'translation_value'     => 'ثانية',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'content',
                'translation_value'     => 'Content',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'content',
                'translation_value'     => 'المُحتوى',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'description',
                'translation_value'     => 'description',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'description',
                'translation_value'     => 'الوصف',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'excerpt',
                'translation_value'     => 'excerpt',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'excerpt',
                'translation_value'     => 'المُلخص',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'date',
                'translation_value'     => 'date',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'date',
                'translation_value'     => 'تاريخ',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'time',
                'translation_value'     => 'time',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'time',
                'translation_value'     => 'الوقت',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'available',
                'translation_value'     => 'available',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'available',
                'translation_value'     => 'مُتاح',
                'translation_lang'      => 'ar',
            ],
            [
                'translation_key'       => 'size',
                'translation_value'     => 'size',
                'translation_lang'      => 'en',
            ],
            [
                'translation_key'       => 'size',
                'translation_value'     => 'الحجم',
                'translation_lang'      => 'ar',
            ],
            [
                "translation_key" => "validation::accepted",
                "translation_value" => "The :attribute must be accepted.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::accepted",
                "translation_value" => "يجب قبول :attribute.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::active_url",
                "translation_value" => "The :attribute is not a valid URL.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::active_url",
                "translation_value" => ":attribute لا يُمثّل رابطًا صحيحًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::after",
                "translation_value" => "The :attribute must be a date after :date.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::after",
                "translation_value" => "يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::after_or_equal",
                "translation_value" => "The :attribute must be a date after or equal to :date.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::after_or_equal",
                "translation_value" => ":attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::alpha",
                "translation_value" => "The :attribute may only contain letters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::alpha",
                "translation_value" => "يجب أن لا يحتوي :attribute سوى على حروف.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::alpha_dash",
                "translation_value" => "The :attribute may only contain letters, numbers, dashes and underscores.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::alpha_dash",
                "translation_value" => "يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::alpha_num",
                "translation_value" => "The :attribute may only contain letters and numbers.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::alpha_num",
                "translation_value" => "يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::array",
                "translation_value" => "The :attribute must be an array.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::array",
                "translation_value" => "يجب أن يكون :attribute ًمصفوفة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::before",
                "translation_value" => "The :attribute must be a date before :date.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::before",
                "translation_value" => "يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::before_or_equal",
                "translation_value" => "The :attribute must be a date before or equal to :date.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::before_or_equal",
                "translation_value" => ":attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::between.numeric",
                "translation_value" => "The :attribute must be between :min and :max.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::between.numeric",
                "translation_value" => "يجب أن تكون قيمة :attribute بين :min و :max.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::between.file",
                "translation_value" => "The :attribute must be between :min and :max kilobytes.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::between.file",
                "translation_value" => "يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::between.string",
                "translation_value" => "The :attribute must be between :min and :max characters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::between.string",
                "translation_value" => "يجب أن يكون عدد حروف النّص :attribute بين :min و :max.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::between.array",
                "translation_value" => "The :attribute must have between :min and :max items.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::between.array",
                "translation_value" => "يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::boolean",
                "translation_value" => "The :attribute field must be true or false.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::boolean",
                "translation_value" => "يجب أن تكون قيمة :attribute إما true أو false .",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::confirmed",
                "translation_value" => "The :attribute confirmation does not match.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::confirmed",
                "translation_value" => "حقل التأكيد غير مُطابق للحقل :attribute.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::date",
                "translation_value" => "The :attribute is not a valid date.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::date",
                "translation_value" => ":attribute ليس تاريخًا صحيحًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::date_equals",
                "translation_value" => "The :attribute must be a date equal to :date.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::date_equals",
                "translation_value" => "يجب أن يكون :attribute مطابقاً للتاريخ :date.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::date_format",
                "translation_value" => "The :attribute does not match the format :format.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::date_format",
                "translation_value" => "لا يتوافق :attribute مع الشكل :format.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::different",
                "translation_value" => "The :attribute and :other must be different.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::different",
                "translation_value" => "يجب أن يكون الحقلان :attribute و :other مُختلفين.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::digits",
                "translation_value" => "The :attribute must be :digits digits.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::digits",
                "translation_value" => "يجب أن يحتوي :attribute على :digits رقمًا/أرقام.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::digits_between",
                "translation_value" => "The :attribute must be between :min and :max digits.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::digits_between",
                "translation_value" => "يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::dimensions",
                "translation_value" => "The :attribute has invalid image dimensions.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::dimensions",
                "translation_value" => "الـ :attribute يحتوي على أبعاد صورة غير صالحة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::distinct",
                "translation_value" => "The :attribute field has a duplicate value.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::distinct",
                "translation_value" => "للحقل :attribute قيمة مُكرّرة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::email",
                "translation_value" => "The :attribute must be a valid email address.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::email",
                "translation_value" => "يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::ends_with",
                "translation_value" => "The :attribute must end with one of the following: :values.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::ends_with",
                "translation_value" => "يجب أن ينتهي :attribute بأحد القيم التالية: :values",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::exists",
                "translation_value" => "The selected :attribute is invalid.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::exists",
                "translation_value" => "القيمة المحددة :attribute غير موجودة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::file",
                "translation_value" => "The :attribute must be a file.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::file",
                "translation_value" => "الـ :attribute يجب أن يكون ملفا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::filled",
                "translation_value" => "The :attribute field must have a value.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::filled",
                "translation_value" => ":attribute إجباري.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::gt.numeric",
                "translation_value" => "The :attribute must be greater than :value.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::gt.numeric",
                "translation_value" => "يجب أن تكون قيمة :attribute أكبر من :value.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::gt.file",
                "translation_value" => "The :attribute must be greater than :value kilobytes.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::gt.file",
                "translation_value" => "يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::gt.string",
                "translation_value" => "The :attribute must be greater than :value characters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::gt.string",
                "translation_value" => "يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::gt.array",
                "translation_value" => "The :attribute must have more than :value items.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::gt.array",
                "translation_value" => "يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::gte.numeric",
                "translation_value" => "The :attribute must be greater than or equal :value.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::gte.numeric",
                "translation_value" => "يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::gte.file",
                "translation_value" => "The :attribute must be greater than or equal :value kilobytes.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::gte.file",
                "translation_value" => "يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::gte.string",
                "translation_value" => "The :attribute must be greater than or equal :value characters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::gte.string",
                "translation_value" => "يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::gte.array",
                "translation_value" => "The :attribute must have :value items or more.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::gte.array",
                "translation_value" => "يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::image",
                "translation_value" => "The :attribute must be an image.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::image",
                "translation_value" => "يجب أن يكون :attribute صورةً.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::in",
                "translation_value" => "The selected :attribute is invalid.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::in",
                "translation_value" => ":attribute غير موجود.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::in_array",
                "translation_value" => "The :attribute field does not exist in :other.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::in_array",
                "translation_value" => ":attribute غير موجود في :other.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::integer",
                "translation_value" => "The :attribute must be an integer.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::integer",
                "translation_value" => "يجب أن يكون :attribute عددًا صحيحًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::ip",
                "translation_value" => "The :attribute must be a valid IP address.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::ip",
                "translation_value" => "يجب أن يكون :attribute عنوان IP صحيحًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::ipv4",
                "translation_value" => "The :attribute must be a valid IPv4 address.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::ipv4",
                "translation_value" => "يجب أن يكون :attribute عنوان IPv4 صحيحًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::ipv6",
                "translation_value" => "The :attribute must be a valid IPv6 address.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::ipv6",
                "translation_value" => "يجب أن يكون :attribute عنوان IPv6 صحيحًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::json",
                "translation_value" => "The :attribute must be a valid JSON string.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::json",
                "translation_value" => "يجب أن يكون :attribute نصًا من نوع JSON.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::lt.numeric",
                "translation_value" => "The :attribute must be less than :value.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::lt.numeric",
                "translation_value" => "يجب أن تكون قيمة :attribute أصغر من :value.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::lt.file",
                "translation_value" => "The :attribute must be less than :value kilobytes.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::lt.file",
                "translation_value" => "يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::lt.string",
                "translation_value" => "The :attribute must be less than :value characters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::lt.string",
                "translation_value" => "يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::lt.array",
                "translation_value" => "The :attribute must have less than :value items.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::lt.array",
                "translation_value" => "يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::lte.numeric",
                "translation_value" => "The :attribute must be less than or equal :value.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::lte.numeric",
                "translation_value" => "يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::lte.file",
                "translation_value" => "The :attribute must be less than or equal :value kilobytes.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::lte.file",
                "translation_value" => "يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::lte.string",
                "translation_value" => "The :attribute must be less than or equal :value characters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::lte.string",
                "translation_value" => "يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::lte.array",
                "translation_value" => "The :attribute must not have more than :value items.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::lte.array",
                "translation_value" => "يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::max.numeric",
                "translation_value" => "The :attribute may not be greater than :max.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::max.numeric",
                "translation_value" => "يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::max.file",
                "translation_value" => "The :attribute may not be greater than :max kilobytes.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::max.file",
                "translation_value" => "يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::max.string",
                "translation_value" => "The :attribute may not be greater than :max characters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::max.string",
                "translation_value" => "يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::max.array",
                "translation_value" => "The :attribute may not have more than :max items.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::max.array",
                "translation_value" => "يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::mimes",
                "translation_value" => "The :attribute must be a file of type: :values.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::mimes",
                "translation_value" => "يجب أن يكون ملفًا من نوع : :values.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::mimetypes",
                "translation_value" => "The :attribute must be a file of type: :values.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::mimetypes",
                "translation_value" => "يجب أن يكون ملفًا من نوع : :values.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::min.numeric",
                "translation_value" => "The :attribute must be at least :min.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::min.numeric",
                "translation_value" => "يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::min.file",
                "translation_value" => "The :attribute must be at least :min kilobytes.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::min.file",
                "translation_value" => "يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::min.string",
                "translation_value" => "The :attribute must be at least :min characters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::min.string",
                "translation_value" => "يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::min.array",
                "translation_value" => "The :attribute must have at least :min items.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::min.array",
                "translation_value" => "يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::not_in",
                "translation_value" => "The selected :attribute is invalid.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::not_in",
                "translation_value" => "العنصر :attribute غير صحيح.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::not_regex",
                "translation_value" => "The :attribute format is invalid.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::not_regex",
                "translation_value" => "صيغة :attribute غير صحيحة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::numeric",
                "translation_value" => "The :attribute must be a number.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::numeric",
                "translation_value" => "يجب على :attribute أن يكون رقمًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::password",
                "translation_value" => "The password is incorrect.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::password",
                "translation_value" => "كلمة المرور غير صحيحة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::present",
                "translation_value" => "The :attribute field must be present.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::present",
                "translation_value" => "يجب تقديم :attribute.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::regex",
                "translation_value" => "The :attribute format is invalid.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::regex",
                "translation_value" => "صيغة :attribute .غير صحيحة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::required",
                "translation_value" => "The :attribute field is required.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::required",
                "translation_value" => ":attribute مطلوب.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::required_if",
                "translation_value" => "The :attribute field is required when :other is :value.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::required_if",
                "translation_value" => ":attribute مطلوب في حال ما إذا كان :other يساوي :value.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::required_unless",
                "translation_value" => "The :attribute field is required unless :other is in :values.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::required_unless",
                "translation_value" => ":attribute مطلوب في حال ما لم يكن :other يساوي :values.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::required_with",
                "translation_value" => "The :attribute field is required when :values is present.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::required_with",
                "translation_value" => ":attribute مطلوب إذا توفّر :values.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::required_with_all",
                "translation_value" => "The :attribute field is required when :values are present.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::required_with_all",
                "translation_value" => ":attribute مطلوب إذا توفّر :values.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::required_without",
                "translation_value" => "The :attribute field is required when :values is not present.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::required_without",
                "translation_value" => ":attribute مطلوب إذا لم يتوفّر :values.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::required_without_all",
                "translation_value" => "The :attribute field is required when none of :values are present.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::required_without_all",
                "translation_value" => ":attribute مطلوب إذا لم يتوفّر :values.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::same",
                "translation_value" => "The :attribute and :other must match.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::same",
                "translation_value" => "يجب أن يتطابق :attribute مع :other.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::size.numeric",
                "translation_value" => "The :attribute must be :size.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::size.numeric",
                "translation_value" => "يجب أن تكون قيمة :attribute مساوية لـ :size.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::size.file",
                "translation_value" => "The :attribute must be :size kilobytes.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::size.file",
                "translation_value" => "يجب أن يكون حجم الملف :attribute :size كيلوبايت.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::size.string",
                "translation_value" => "The :attribute must be :size characters.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::size.string",
                "translation_value" => "يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::size.array",
                "translation_value" => "The :attribute must contain :size items.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::size.array",
                "translation_value" => "يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::starts_with",
                "translation_value" => "The :attribute must start with one of the following: :values.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::starts_with",
                "translation_value" => "يجب أن يبدأ :attribute بأحد القيم التالية: :values",
                "translation_lang" => "ar",
            ],[
                "translation_key" => "validation::string",
                "translation_value" => "The :attribute must be a string.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::string",
                "translation_value" => "يجب أن يكون :attribute نصًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::timezone",
                "translation_value" => "The :attribute must be a valid zone.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::timezone",
                "translation_value" => "يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::unique",
                "translation_value" => "The :attribute has already been taken.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::unique",
                "translation_value" => "قيمة :attribute مُستخدمة من قبل.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::uploaded",
                "translation_value" => "The :attribute failed to upload.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::uploaded",
                "translation_value" => "فشل في تحميل الـ :attribute.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::url",
                "translation_value" => "The :attribute format is invalid.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::url",
                "translation_value" => "صيغة الرابط :attribute غير صحيحة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "validation::uuid",
                "translation_value" => "The :attribute must be a valid UUID.",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "validation::uuid",
                "translation_value" => ":attribute يجب أن يكون بصيغة UUID سليمة.",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "translation_key",
                "translation_value" => "Translation key",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "translation_key",
                "translation_value" => "مفتاح الترجمة",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "translation_value",
                "translation_value" => "Translation Value",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "translation_value",
                "translation_value" => "الترجمة",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "no_records_found",
                "translation_value" => "No records found",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "no_records_found",
                "translation_value" => "لا توجد سجلات",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "not_found",
                "translation_value" => "Not found",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "not_found",
                "translation_value" => "غير موجود",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "sign_out",
                "translation_value" => "Sign Out",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "sign_out",
                "translation_value" => "تسجيل خروج",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "sign_in",
                "translation_value" => "Sign in",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "sign_in",
                "translation_value" => "تسجيل دخول",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "new_role",
                "translation_value" => "New Role",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "new_role",
                "translation_value" => "صلاحية جديدة",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "created_at",
                "translation_value" => "Created at",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "created_at",
                "translation_value" => "أنشئت في",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "updated_at",
                "translation_value" => "Updated_at",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "updated_at",
                "translation_value" => "تم التحديث في",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "reset",
                "translation_value" => "Reset",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "reset",
                "translation_value" => "إعادة تعيين",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "image",
                "translation_value" => "Image",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "image",
                "translation_value" => "صورة",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "avatar",
                "translation_value" => "Avatar",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "avatar",
                "translation_value" => "صورة شخصية",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "icon",
                "translation_value" => "Icon",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "icon",
                "translation_value" => "أيقونة",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "permissions",
                "translation_value" => "Permissions",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "permissions",
                "translation_value" => "الصلاحيات",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "login",
                "translation_value" => "Login",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "login",
                "translation_value" => "تسجيل دخول",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "logout",
                "translation_value" => "Logout",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "logout",
                "translation_value" => "تسجيل خروج",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "signin",
                "translation_value" => "Sign in",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "signin",
                "translation_value" => "تسجيل دخول",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "signout",
                "translation_value" => "Sign out",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "signout",
                "translation_value" => "تسجيل خروج",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "rememberme",
                "translation_value" => "Remember Me",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "rememberme",
                "translation_value" => "تذكرني",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "invalid_email_or_password_msg",
                "translation_value" => "invalid email or password",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "invalid_email_or_password_msg",
                "translation_value" => "خطأ في البريد الالكتروني او كلمة المرور",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "need_verify_email_msg",
                "translation_value" => "please check your email to verify your account!",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "need_verify_email_msg",
                "translation_value" => "يرجى التحقق من بريدك الإلكتروني للتحقق من حسابك!",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "success_verify_msg",
                "translation_value" => "The account has been activated successfully!",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "success_verify_msg",
                "translation_value" => "تم تفعيل االحساب بنجاح",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "dashboard_login_title",
                "translation_value" => "Admin Dashboard",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "dashboard_login_title",
                "translation_value" => "لوحة التحكم",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "dashboard_forgot_password_title",
                "translation_value" => "Reset Password",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "dashboard_forgot_password_title",
                "translation_value" => "إعادة تعيين كلمة المرور",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "reset_link_sent_msg",
                "translation_value" => "please check your email to reset password",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "reset_link_sent_msg",
                "translation_value" => "يرجى التحقق من بريدك الإلكتروني لإعادة تعيين كلمة المرور",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "reset_link_success_msg",
                "translation_value" => "Reset Password Successfully",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "reset_link_success_msg",
                "translation_value" => "تم تغيير كلمة المرور",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "profile_information",
                "translation_value" => "Profile Information",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "profile_information",
                "translation_value" => "المعلومات الشخصية",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "update_your_profile_msg",
                "translation_value" => "update your profile information and emails",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "update_your_profile_msg",
                "translation_value" => "تحديث معلومات ملفك الشخصي ورسائل البريد الإلكتروني",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "personal_options",
                "translation_value" => "Personal Options",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "personal_options",
                "translation_value" => "الخيارات الشخصية",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "update_your_personal_options_msg",
                "translation_value" => "Update your personal options",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "update_your_personal_options_msg",
                "translation_value" => "تحديث خياراتك الشخصية",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "account_management",
                "translation_value" => "Account Management",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "account_management",
                "translation_value" => "إدارة الحساب",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "update_your_account_management_msg",
                "translation_value" => "Manage your account",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "update_your_account_management_msg",
                "translation_value" => "إدارة حسابك",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "update_my_activities_msg",
                "translation_value" => "Manage and show your activities",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "update_my_activities_msg",
                "translation_value" => "إدارة وإظهار أنشطتك",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "change_password",
                "translation_value" => "Change Password",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "change_password",
                "translation_value" => "تغيير كلمة المرور",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "change_password_desc",
                "translation_value" => "Set new password",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "change_password_desc",
                "translation_value" => "قم بتعيين كلمة مرور جديدة",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "browser_sessions",
                "translation_value" => "Browser Sessions",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "browser_sessions",
                "translation_value" => "قم بتعيين كلمة مرور جديدة",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "browser_sessions_desc",
                "translation_value" => "Manage and logout your active sessions on other browsers",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "browser_sessions_desc",
                "translation_value" => "إدارة جلساتك النشطة وتسجيل الخروج منها على متصفحات أخرى",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "feel_account_has_been_compromised_msg",
                "translation_value" => "if you feel your account has been compromised you should also update your password",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "feel_account_has_been_compromised_msg",
                "translation_value" => "إذا شعرت أنه تم اختراق حسابك ، فيجب عليك أيضًا تحديث كلمة المرور الخاصة بك",
                "translation_lang" => "ar",
            ],
            [
                "translation_key" => "logout_others_sessions",
                "translation_value" => "Logout Others Sessions",
                "translation_lang" => "en",
            ],
            [
                "translation_key" => "logout_others_sessions",
                "translation_value" => "تسجيل الخروج من الجلسات الاخرى",
                "translation_lang" => "ar",
            ]
        ]);
    }
}
