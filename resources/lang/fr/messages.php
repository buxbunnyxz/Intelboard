<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation / Common
    |--------------------------------------------------------------------------
    */
    'home'                  => 'Accueil',
    'back'                  => 'Retour',
    'search'                => 'Rechercher',
    'search_placeholder'    => 'Rechercher par nom, téléphone ou ID',
    'searchdriverpage'      => 'Rechercher',
    'yes'                   => 'Oui',
    'no'                    => 'Non',
    'close'                 => 'Fermer',
    'save'                  => 'Enregistrer',
    'cancel'                => 'Annuler',
    'status'                => '#',
    'added_by'              => 'Ajouté par',
    'created_on'            => 'Créé le',

    /*
    |--------------------------------------------------------------------------
    | Authentication / Login
    |--------------------------------------------------------------------------
    */
    'invalid_credentials'   => 'Les informations d\'identification fournies ne correspondent pas à nos dossiers.',
    'login_title'           => 'Connexion',
    'login_email_label'     => 'Adresse e-mail',
    'login_email_placeholder' => 'Entrez votre e-mail',
    'login_forgot_password' => 'Mot de passe oublié?',
    'login_password_label'  => 'Mot de passe',
    'login_password_placeholder' => 'Entrez votre mot de passe',
    'login_remember_me'     => 'Se souvenir de moi',
    'login_button'          => 'Connexion',
    'login_no_account'      => 'Vous n\'avez pas de compte?',
    'register_with_google'  => 'Continuer avec Google',
    'register_with_apple'   => 'Continuer avec Apple',
    'or_use_email'          => 'OU UTILISER L\'EMAIL',

    /*
    |--------------------------------------------------------------------------
    | Registration
    |--------------------------------------------------------------------------
    */
    'register_title'                     => 'S\'inscrire',
    'register_full_name_label'           => 'Nom complet',
    'register_full_name_placeholder'     => 'Entrez votre nom complet',
    'register_email_label'               => 'Adresse e-mail',
    'register_email_placeholder'         => 'Entrez votre e-mail',
    'register_phone_label'               => 'Numéro de téléphone',
    'register_phone_placeholder'         => 'Entrez votre numéro à 10 chiffres',
    'register_password_label'            => 'Mot de passe',
    'register_password_placeholder'      => 'Entrez votre mot de passe',
    'register_password_confirm_label'    => 'Confirmez le mot de passe',
    'register_password_confirm_placeholder' => 'Entrez à nouveau votre mot de passe',
    'register_button'                    => 'S\'inscrire',
    'register_already_have_account'      => 'Vous avez déjà un compte?',
    'register_phone_error'               => 'Veuillez entrer un numéro de téléphone valide à 10 chiffres.',
    'register_phone_title'               => 'Finaliser l\'inscription',
    'register_phone_welcome'             => 'Bienvenue, :name !',
    'register_phone_prompt'              => 'Veuillez entrer votre numéro de téléphone pour finaliser l\'inscription.',
    'register_phone_button'              => 'Finaliser l\'inscription',
    'register_phone_cancel_button'   => 'Annuler l\'inscription',
    'register_phone_cancel_confirm'  => 'Voulez-vous vraiment annuler l\'inscription?',
    'register_phone_cancelled'       => 'Inscription annulée.',
    'google_linked_success' => 'Votre compte a été lié à Google.',

    // Google existing email (HTML allowed)
    'google_existing_email'              => 'Un compte avec cet e-mail existe déjà. Veuillez <a href=":login_url">cliquer ici pour vous connecter</a>.',

    /*
    |--------------------------------------------------------------------------
    | Drivers
    |--------------------------------------------------------------------------
    */
    'drivers'                => 'Chauffeurs',
    'add_driver_btn'         => 'Ajouter un chauffeur',
    'add_driver'             => 'Ajouter un chauffeur',
    'id'                     => 'ID',
    'name'                   => 'Nom',
    'phone'                  => 'Téléphone',
    'actions'                => 'Actions',
    'edit_driver'            => 'Modifier le chauffeur',
    'delete_driver_btn'      => 'Supprimer le chauffeur',
    'confirm_delete_driver'  => 'Êtes-vous sûr de vouloir supprimer ce chauffeur?',
    'back_to_drivers'        => 'Retour aux chauffeurs',
    'full_name'              => 'Nom complet',
    'phone_number'           => 'Numéro de téléphone',
    'driver_id'              => 'ID du chauffeur',
    'license_number'         => 'Numéro de permis',
    'ssn'                    => 'NAS',
    'save_driver_btn'        => 'Enregistrer le chauffeur',
    'driver_added_success'   => 'Conducteur ajouté avec succès !',
    'driver_updated_success' => 'Conducteur mis à jour avec succès !',
    'driver_deleted_success' => 'Conducteur supprimé avec succès.',
    'driver'                 => 'Chauffeur',
    'active'                 => 'Actif',
    'default_percentage'     => 'Pourcentage par défaut',
    'default_rental_price'   => 'Prix de location par défaut',

    /*
    |--------------------------------------------------------------------------
    | Payments
    |--------------------------------------------------------------------------
    */
    'payments_page_title'            => 'Paiements',
    'batch_upload'                   => 'Téléversement groupé',
    'drop_files_here'                => 'Déposez les fichiers ici',
    'click_to_upload'                => 'Cliquez pour téléverser',
    'batch_upload_success'           => 'Le téléversement de lots est réussi. Les fichiers sont en cours de traitement.',
    'batch_upload_error'             => 'Échec du téléversement de lots. Veuillez réessayer.',
    'uploaded_invoices_summary'      => 'Récapitulatif des factures téléversées',
    'payments_processing_uploads'    => 'Traitement des téléversements ...',
    'payments_processing_wait'       => 'Veuillez patienter, extraction des données (minimum 5 secondes)',
    'pdf_only_max'                   => 'PDF uniquement. 5 Mo max chacun.',
    'id_name'                        => 'ID - Nom',
    'total_parcels'                  => 'Total Colis',
    'payments_completed_valid_drivers' => 'Terminé. Chauffeurs valides : :count.',
    'payments_summary_pattern'       => 'Chauffeurs : :drivers | Trouvés : :found | Non trouvés : :not_found',

    /*
    |--------------------------------------------------------------------------
    | Weeks / Labels
    |--------------------------------------------------------------------------
    */
    's_week'  => 'Semaine',
    'w_week'  => 'Semaine',
    'week'    => 'Semaine',
    'weekno'  => '#Semaine',

    /*
    |--------------------------------------------------------------------------
    | Calculation / Listing
    |--------------------------------------------------------------------------
    */
    'intelcom_invoice'       => 'Facture Intelcom',
    'total_invoice'          => 'Facture Totale',
    'daysworked'             => 'Jours travaillés',
    'bonus'                  => 'Prime',
    'cash_advance'           => 'Avance',
    'finalamount'            => '$-Final', // legacy
    'final_amount'           => 'Montant final',
    'benefit'                => 'Bénéfice',
    'calculatexx'            => '#',
    'calculate'              => 'Calculer',
    'payment_details'        => 'Détails de Paiement',
    'payments'               => 'Paiements',
    'calculation_for'        => 'Calcul pour :driver - Semaine: :week',

    /*
    |--------------------------------------------------------------------------
    | Calculation Edit
    |--------------------------------------------------------------------------
    */
    'edit'                   => 'Modifier',
    'reset'                  => 'Réinitialiser',
    'edit_calculation_title' => 'Modifier le calcul',
    'broker_percentage'      => 'Pourcentage du courtier',
    'vehicule_rental_price'  => 'Prix de location du véhicule',
    'vehicle_rental_price'   => 'Prix de location du véhicule',
    'percentage'             => 'Pourcentage (%)',
    'add_bonus'              => 'Ajouter une prime',
    'deduct_cash_advance'    => 'Déduire une avance en espèces',
    'vehicle_cost'           => 'Coût du véhicule',
    'additional_details'     => 'Détails supplémentaires',

    /*
    |--------------------------------------------------------------------------
    | Company / User Settings
    |--------------------------------------------------------------------------
    */
    'company_settings'        => 'Paramètres du compte',
    'company_name'            => 'Nom de l\'entreprise',
    'company_logo'            => 'Logo de l\'entreprise',
    'confirm'                 => 'Confirmer',
    'user_details_section'    => 'Détails utilisateur',
    'company_section'         => 'Informations sur l\'entreprise',
    'success'                 => 'Succès',
    'settings_saved_success'  => 'Détails enregistrés avec succès.',
    // Password change subsection
    'change_password'         => 'Changer le mot de passe',
    'password_section'        => 'Changer le mot de passe',
    'current_password'        => 'Mot de passe actuel',
    'new_password'            => 'Nouveau mot de passe',
    'new_password_placeholder'=> 'Entrer le nouveau mot de passe',
    'current_password_incorrect' => 'Le mot de passe actuel est incorrect.',
    'password_changed_success'=> 'Mot de passe mis à jour avec succès.',
    'password_min_rule'       => 'Doit contenir au moins 8 caractères.',
    'leave_blank_ignore'      => 'Laisser vide pour ignorer',
    'partial_details_saved'   => 'Détails enregistrés, mais mot de passe inchangé.',

    /*
    |--------------------------------------------------------------------------
    | Calculation Actions / Messages
    |--------------------------------------------------------------------------
    */
    'calculation_update_success'      => 'Calcul mis à jour avec succès.',
    'reset_calculation_title'         => 'Réinitialiser le calcul',
    'confirm_reset_calculation'       => 'Êtes-vous sûr de vouloir réinitialiser toutes les valeurs à 0 ?',
    'calculation_reset_success'       => 'Le calcul a été réinitialisé avec succès.',
    'reset_failed'                    => 'Échec de la réinitialisation. Veuillez réessayer.',
    'pdf_file_requirements'           => '(Seuls les fichiers PDF sont acceptés. Taille max: 5MB)',
    'pdf_extraction_failed'           => 'Impossible d\'extraire les données requises du PDF. Veuillez vérifier le fichier.',
    'file_upload_failed'              => 'Échec du téléversement du fichier.',
    'start'                           => 'Démarrer',
    'final_amount_save_prompt'        => 'Montant final : ',
    'wannasavit'                      => 'voulez-vous l\'enregistrer ?',
    'cash_advance_save_prompt'        => 'Avance : ',
    'save_failed'                     => 'Échec de l\'enregistrement',
    'saved_final_amount'              => 'Enregistré. Montant final : ',
    'error_saving_calculation'        => 'Erreur lors de l\'enregistrement du calcul.',
    'enter_broker_percentage'         => 'Entrez le pourcentage du courtier (ex. 20)',

    /*
    |--------------------------------------------------------------------------
    | Navigation Footer / Tabs
    |--------------------------------------------------------------------------
    */
    'pays'     => 'Paies',
    'stats'    => 'Statistiques',
    'settings' => 'Paramètres',

];  