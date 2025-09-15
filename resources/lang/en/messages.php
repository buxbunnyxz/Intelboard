<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation / Common
    |--------------------------------------------------------------------------
    */
    'home'                  => 'Home',
    'back'                  => 'Back',
    'search'                => 'Search',
    'search_placeholder'    => 'Search by name, phone or ID',
    'searchdriverpage'      => 'Search anything',
    'yes'                   => 'Yes',
    'no'                    => 'No',
    'close'                 => 'Close',
    'save'                  => 'Save',
    'cancel'                => 'Cancel',
    'status'                => '#',
    'added_by'              => 'Added By',
    'created_on'            => 'Created On',

    /*
    |--------------------------------------------------------------------------
    | Authentication / Login
    |--------------------------------------------------------------------------
    */
    'invalid_credentials'   => 'The provided credentials do not match our records.',
    'login_title'           => 'Log In',
    'login_email_label'     => 'Email address',
    'login_email_placeholder' => 'Enter your email',
    'login_forgot_password' => 'Forgot your password?',
    'login_password_label'  => 'Password',
    'login_password_placeholder' => 'Enter your password',
    'login_remember_me'     => 'Remember me',
    'login_button'          => 'Log In',
    'login_no_account'      => 'Don\'t have an account?',
    'register_with_google'  => 'Continue with Google',
    'register_with_apple'   => 'Continue with Apple',
    'or_use_email'          => 'OR USE EMAIL',

    /*
    |--------------------------------------------------------------------------
    | Registration
    |--------------------------------------------------------------------------
    */
    'register_title'                     => 'Sign Up',
    'register_full_name_label'           => 'Full Name',
    'register_full_name_placeholder'     => 'Enter your full name',
    'register_email_label'               => 'Email address',
    'register_email_placeholder'         => 'Enter your email',
    'register_phone_label'               => 'Phone number',
    'register_phone_placeholder'         => 'Enter your 10-digit phone number',
    'register_password_label'            => 'Password',
    'register_password_placeholder'      => 'Enter your password',
    'register_password_confirm_label'    => 'Confirm Password',
    'register_password_confirm_placeholder' => 'Enter your password again',
    'register_button'                    => 'Sign Up',
    'register_already_have_account'      => 'Already have an account?',
    'register_phone_error'               => 'Please enter a valid 10-digit phone number.',
    'register_phone_title'               => 'Finish Registration',
    'register_phone_welcome'             => 'Welcome, :name!',
    'register_phone_prompt'              => 'Please enter your phone number to finish the registration.',
    'register_phone_button'              => 'Finish Registration',
    'google_linked_success' => 'Your account has been linked with Google.',
    'register_phone_cancel_button'   => 'Cancel Registration',
    'register_phone_cancel_confirm'  => 'Are you sure you want to cancel the registration?',
    'register_phone_cancelled'       => 'Registration cancelled.',

    // Google existing email (HTML allowed)
    'google_existing_email'              => 'An account with this email already exists. Please <a href=":login_url">click here to log in</a>.',

    /*
    |--------------------------------------------------------------------------
    | User / Company Settings
    |--------------------------------------------------------------------------
    */
    'company_settings'        => 'Profile Settings',
    'company_name'            => 'Company Name',
    'company_logo'            => 'Company Logo',
    'confirm'                 => 'Confirm',
    'user_details_section'    => 'User Details',
    'company_section'         => 'Company Information',
    'success'                 => 'Success',
    'settings_saved_success'  => 'Details successfully saved.',
    // Password change subsection
    'change_password'         => 'Change Password',
    'password_section'        => 'Change Password',
    'current_password'        => 'Current Password',
    'new_password'            => 'New Password',
    'new_password_placeholder'=> 'Enter new password',
    'current_password_incorrect' => 'Current password is incorrect.',
    'password_changed_success'=> 'Password updated successfully.',
    'password_min_rule'       => 'Must be at least 8 characters.',
    'leave_blank_ignore'      => 'Leave blank to ignore',
    'partial_details_saved'   => 'Details saved, but password not changed.',

    /*
    |--------------------------------------------------------------------------
    | Drivers
    |--------------------------------------------------------------------------
    */
    'drivers'                => 'Drivers',
    'add_driver_btn'         => 'Add Driver',
    'add_driver'             => 'Add a driver',
    'id'                     => 'ID',
    'name'                   => 'Name',
    'phone'                  => 'Phone',
    'actions'                => 'Actions',
    'edit_driver'            => 'Edit driver',
    'delete_driver_btn'      => 'Delete Driver',
    'confirm_delete_driver'  => 'Are you sure you want to delete this driver?',
    'back_to_drivers'        => 'Back to drivers',
    'full_name'              => 'Full name',
    'phone_number'           => 'Phone number',
    'driver_id'              => 'Driver ID',
    'license_number'         => 'License number',
    'ssn'                    => 'SSN',
    'save_driver_btn'        => 'Save Driver',
    'driver_added_success'   => 'Driver added successfully!',
    'driver_updated_success' => 'Driver updated successfully!',
    'driver_deleted_success' => 'Driver deleted successfully.',
    'driver'                 => 'Driver',
    'active'                 => 'Active',
    'default_percentage'     => 'Default Percentage',
    'default_rental_price'   => 'Default Rental Price',

    /*
    |--------------------------------------------------------------------------
    | Payments
    |--------------------------------------------------------------------------
    */
    'payments_page_title'            => 'Payments',
    'batch_upload'                   => 'Batch Invoice Upload',
    'drop_files_here'                => 'Drop files here',
    'click_to_upload'                => 'Click to upload',
    'batch_upload_success'           => 'Batch upload successful. Files are being processed.',
    'batch_upload_error'             => 'Batch upload failed. Please try again.',
    'uploaded_invoices_summary'      => 'Uploaded Invoices Summary',
    'payments_processing_uploads'    => 'Processing uploads ...',
    'payments_processing_wait'       => 'Please wait, extracting invoice data (minimum 5 seconds)',
    'pdf_only_max'                   => 'PDFs only. Max 5MB each.',
    'id_name'                        => 'ID - Name',
    'total_parcels'                  => 'Total Parcels',
    'payments_completed_valid_drivers' => 'Completed. Valid drivers: :count.',
    'payments_summary_pattern'       => 'Drivers: :drivers | Found: :found | Not Found: :not_found',

    /*
    |--------------------------------------------------------------------------
    | Weeks / Labels
    |--------------------------------------------------------------------------
    */
    's_week'  => 'Week',
    'w_week'  => 'Week',
    'week'    => 'Week',
    'weekno'  => 'Week #',

    /*
    |--------------------------------------------------------------------------
    | Calculation (Listing / Display)
    |--------------------------------------------------------------------------
    */
    'intelcom_invoice'       => 'Intelcom Invoice',
    'total_invoice'          => 'Total Invoice',
    'daysworked'             => 'Days Worked',
    'bonus'                  => 'Bonus',
    'cash_advance'           => 'Cash Advance',
    'finalamount'            => 'Final Amount', // Legacy key
    'final_amount'           => 'Final Amount', // Preferred key
    'benefit'                => 'Benefit',
    'calculatexx'            => '#',
    'calculate'              => 'Calculate',
    'payment_details'        => 'Payment Details',
    'payments'               => 'Payments',
    'calculation_for'        => 'Calculation for :driver - Week: :week',

    /*
    |--------------------------------------------------------------------------
    | Calculation Edit
    |--------------------------------------------------------------------------
    */
    'edit'                   => 'Edit',
    'reset'                  => 'Reset',
    'edit_calculation_title' => 'Edit Calculation',
    'broker_percentage'      => 'Broker percentage',
    'vehicule_rental_price'  => 'Vehicle rental price',
    'vehicle_rental_price'   => 'Vehicle rental price',
    'percentage'             => 'Percentage (%)',
    'add_bonus'              => 'Add Bonus',
    'deduct_cash_advance'    => 'Deduct Cash Advance',
    'vehicle_cost'           => 'Vehicle Cost',
    'additional_details'     => 'Additional Details',

    /*
    |--------------------------------------------------------------------------
    | Calculation Actions / Messages
    |--------------------------------------------------------------------------
    */
    'calculation_update_success'      => 'Calculation updated successfully.',
    'reset_calculation_title'         => 'Reset Calculation',
    'confirm_reset_calculation'       => 'Are you sure you want to reset all values to 0?',
    'calculation_reset_success'       => 'Calculation has been reset successfully.',
    'reset_failed'                    => 'Reset failed. Please try again.',
    'pdf_file_requirements'           => '(Only PDF files are accepted. Max size: 5MB)',
    'pdf_extraction_failed'           => 'Could not extract required data from the PDF. Please check the file.',
    'file_upload_failed'              => 'File upload failed.',
    'start'                           => 'Start',
    'final_amount_save_prompt'        => 'Final amount: ',
    'wannasavit'                      => 'Do you want to save it?',
    'cash_advance_save_prompt'        => 'Cash advance: ',
    'save_failed'                     => 'Save failed',
    'saved_final_amount'              => 'Saved. Final amount: ',
    'error_saving_calculation'        => 'Error saving calculation.',
    'enter_broker_percentage'         => 'Enter broker percentage (e.g. 20)',

    /*
    |--------------------------------------------------------------------------
    | Navigation (Footer / Tabs)
    |--------------------------------------------------------------------------
    */
    'pays'     => 'Pays',
    'stats'    => 'Stats',
    'settings' => 'Settings',

];