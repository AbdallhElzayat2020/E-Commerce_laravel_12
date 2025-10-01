<?php

return [
    // Page Titles
    'title' => 'Admins Management',
    'create_title' => 'Create New Admin',
    'edit_title' => 'Edit Admin',
    'show_title' => 'View Admin',

    // Table Headers
    'table' => [
        'id' => '#',
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
        'status' => 'Status',
        'actions' => 'Actions',
    ],

    // Form Fields
    'form' => [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'role' => 'Role',
        'status' => 'Status',
        'select_role' => 'Select Role',
        'select_status' => 'Select Status',
    ],

    // Status Options
    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    // Buttons
    'buttons' => [
        'add_new' => 'Add New Admin',
        'create' => 'Create Admin',
        'update' => 'Update Admin',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'cancel' => 'Cancel',
        'confirm' => 'Confirm',
        'change_status' => 'Change Status',
        'back' => 'Back',
    ],

    // Messages
    'messages' => [
        'created_successfully' => 'Admin created successfully',
        'updated_successfully' => 'Admin updated successfully',
        'deleted_successfully' => 'Admin deleted successfully',
        'status_updated_successfully' => 'Admin status updated successfully',
        'not_found' => 'Admin not found',
        'delete_failed' => 'Failed to delete admin',
        'update_failed' => 'Failed to update admin',
        'create_failed' => 'Failed to create admin',
        'something_wrong' => 'Something went wrong',
    ],

    // Modal Messages
    'modal' => [
        'delete_title' => 'Delete Admin',
        'delete_message' => 'Are you sure you want to delete this admin?',
        'delete_warning' => 'Warning: This action cannot be undone!',
        'status_change_title' => 'Change Admin Status',
        'status_change_message' => 'Are you sure you want to change the status of this admin?',
        'current_status' => 'Current Status',
        'new_status' => 'New Status',
    ],

    // Labels
    'labels' => [
        'admin' => 'Admin',
        'super_admin' => 'Super Admin',
        'no_role' => 'No Role',
        'no_admins_found' => 'No admins found',
        'password_leave_blank' => '(Leave blank to keep current)',
        'required_field' => 'Required field',
    ],

    // Tooltips
    'tooltips' => [
        'edit' => 'Edit',
        'delete' => 'Delete',
        'change_status' => 'Change Status',
        'cannot_edit_super_admin' => 'Cannot edit Super Admin',
        'cannot_delete_super_admin' => 'Cannot delete Super Admin',
    ],
];
