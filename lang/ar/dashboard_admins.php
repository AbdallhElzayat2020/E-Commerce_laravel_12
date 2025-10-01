<?php

return [
    // Page Titles
    'title' => 'إدارة الأدمن',
    'create_title' => 'إضافة أدمن جديد',
    'edit_title' => 'تعديل الأدمن',
    'show_title' => 'عرض الأدمن',

    // Table Headers
    'table' => [
        'id' => '#',
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'role' => 'الدور',
        'status' => 'الحالة',
        'actions' => 'الإجراءات',
    ],

    // Form Fields
    'form' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'role' => 'الدور',
        'status' => 'الحالة',
        'select_role' => 'اختر الدور',
        'select_status' => 'اختر الحالة',
    ],

    // Status Options
    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    // Buttons
    'buttons' => [
        'add_new' => 'إضافة أدمن جديد',
        'create' => 'إنشاء أدمن',
        'update' => 'تحديث الأدمن',
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'cancel' => 'إلغاء',
        'confirm' => 'تأكيد',
        'change_status' => 'تغيير الحالة',
        'back' => 'رجوع',
    ],

    // Messages
    'messages' => [
        'created_successfully' => 'تم إنشاء الأدمن بنجاح',
        'updated_successfully' => 'تم تحديث الأدمن بنجاح',
        'deleted_successfully' => 'تم حذف الأدمن بنجاح',
        'status_updated_successfully' => 'تم تحديث حالة الأدمن بنجاح',
        'not_found' => 'الأدمن غير موجود',
        'delete_failed' => 'فشل في حذف الأدمن',
        'update_failed' => 'فشل في تحديث الأدمن',
        'create_failed' => 'فشل في إنشاء الأدمن',
        'something_wrong' => 'حدث خطأ ما',
    ],

    // Modal Messages
    'modal' => [
        'delete_title' => 'حذف الأدمن',
        'delete_message' => 'هل أنت متأكد من حذف هذا الأدمن؟',
        'delete_warning' => 'تحذير: لا يمكن التراجع عن هذا الإجراء!',
        'status_change_title' => 'تغيير حالة الأدمن',
        'status_change_message' => 'هل أنت متأكد من تغيير حالة هذا الأدمن؟',
        'current_status' => 'الحالة الحالية',
        'new_status' => 'الحالة الجديدة',
    ],

    // Labels
    'labels' => [
        'admin' => 'الأدمن',
        'super_admin' => 'الأدمن الرئيسي',
        'no_role' => 'بدون دور',
        'no_admins_found' => 'لا توجد أدمن',
        'password_leave_blank' => '(اتركه فارغاً للاحتفاظ بالحالي)',
        'required_field' => 'حقل مطلوب',
    ],

    // Tooltips
    'tooltips' => [
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'change_status' => 'تغيير الحالة',
        'cannot_edit_super_admin' => 'لا يمكن تعديل الأدمن الرئيسي',
        'cannot_delete_super_admin' => 'لا يمكن حذف الأدمن الرئيسي',
    ],
];
