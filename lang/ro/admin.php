<?php

return [

    'common' => [
        'created_at' => 'Creat la',
        'updated_at' => 'Actualizat la',
        'expiring_at' => 'Expiră la',
        'canceled_at' => 'Anulat la',
        'create' => 'Adaugă',
        'edit' => 'Actualizat',
        'delete' => 'Șterge',
        'view' => 'Vizualizare',
        'id' => 'ID',
    ],


    'dashboard' => [

    ],

    'navigation' => [
        'dashboard' => 'Panou de control',
        'groups' => [
            'users' => 'Utilizatori',
            'posts' => 'Postări',
            'finances' => 'Finanțe',
            'taxes' => 'Taxe',
            'streams' => 'Transmisiuni',
            'site' => 'Site',
            'settings' => 'Setări',
        ],
    ],

    'filters' => [
        'title' => 'Filtre',
        'start_date' => 'Data de început',
        'end_date' => 'Data de sfârșit',
        'today' => 'Astăzi',
        'week' => 'Ultima săptămână',
        'month' => 'Ultima lună',
        'year' => 'Anul acesta',
    ],

    'widgets' => [
        'stats_overview' => [
            'title' => 'Statistici din ultimele 7 zile',

            'revenue' => [
                'label' => 'Venituri',
                'description' => 'Venit total',
            ],
            'new_users' => [
                'label' => 'Utilizatori noi',
                'description' => 'Utilizatori înregistrați',
            ],
            'new_payments' => [
                'label' => 'Plăți noi',
                'description' => 'Plăți finalizate',
            ],
        ],

        'users_chart' => [
            'title' => 'Utilizatori',
            'datasets' => [
                'users' => 'Utilizatori',
                'user_messages' => 'Mesaje utilizatori',
            ],
        ],

        'posts_chart' => [
            'title' => 'Postări',
            'filters' => [
                'today' => 'Astăzi',
                'week' => 'Ultima săptămână',
                'month' => 'Ultima lună',
                'year' => 'Anul acesta',
            ],
            'datasets' => [
                'posts' => 'Postări',
                'comments' => 'Comentarii',
                'reactions' => 'Reacții',
            ],
        ],

        'transactions_chart' => [
            'title' => 'Plăți',
            'filters' => [
                'today' => 'Astăzi',
                'week' => 'Ultima săptămână',
                'month' => 'Ultima lună',
                'year' => 'Anul acesta',
            ],
            'datasets' => [
                'transactions' => 'Plăți',
                'subscriptions' => 'Abonamente',
            ],
        ],

        'product_info' => [
            'title' => 'Ghid rapid',
            'website' => [
                'title' => 'Website',
                'description' => 'Vizitează pagina oficială a produsului',
            ],
            'documentation' => [
                'title' => 'Documentație',
                'description' => 'Vizitează documentația a produsului',
            ],
            'changelog' => [
                'title' => 'Jurnal de modificări',
                'description' => 'Vizitează jurnalul de modificări',
            ],
        ],

        'transaction_stats' => [
            'heading' => 'Plăți din acest an',
            'total' => 'Total plăți',
            'completed' => 'Plăți finalizate',
            'average' => 'Preț mediu',
        ],

        'subscription_stats' => [
            'heading' => 'Abonamentele acestui an',
            'total' => 'Total abonamente',
            'active' => 'Abonamente active în prezent',
            'average_price' => 'Preț mediu',
        ],

    ],

    'resources' => [
        'user' => [
            'label' => 'Utilizator',
            'plural' => 'Utilizatori',

            'sections' => [
                'account_info' => 'Informații Cont',
                'paywall_info' => 'Informații Paywall',
                'profile_info' => 'Informații Profil',
                'withdrawals_info' => 'Informații Retrageri',
                'security_info' => 'Informații Securitate',
                'billing_info' => 'Informații Facturare',
            ],

            'fields' => [
                'id' => 'ID',
                'name' => 'Nume',
                'email' => 'Email',
                'username' => 'Utilizator',
                'password' => 'Parolă',
                'roles' => 'Rol',
                'email_verified_at' => 'Email Verificat La',
                'identity_verified_at' => 'ID Verificat La',
                'birthdate' => 'Data Nașterii',
                'paid_profile' => 'Profil Plătit',
                'public_profile' => 'Profil Public',
                'open_profile' => 'Profil Deschis',
                'profile_access_price' => 'Preț Acces',
                'profile_access_price_3_months' => 'Preț 3 Luni',
                'profile_access_price_6_months' => 'Preț 6 Luni',
                'profile_access_price_12_months' => 'Preț 12 Luni',
                'current_avatar' => 'Avatar actual',
                'avatar' => 'Avatar',
                'current_cover' => 'Copertă actuala',
                'cover' => 'Copertă',
                'bio' => 'Biografie',
                'location' => 'Locație',
                'gender_id' => 'Gen',
                'gender_pronoun' => 'Pronume',
                'website' => 'Website',
                'referral_code' => 'Cod Recomandare',
                'stripe_account_id' => 'ID Stripe Connect',
                'country_id' => 'Țară Stripe Connect',
                'stripe_onboarding_verified' => 'Stripe Verificat',
                'last_ip' => 'Ultimul IP',
                'last_active_at' => 'Ultima Activitate',
                'enable_geoblocking' => 'Activează Geo-blocare',
                'enable_2fa' => 'Activează 2FA',
                'billing_address' => 'Adresă Facturare',
                'first_name' => 'Prenume',
                'last_name' => 'Nume',
                'city' => 'Oraș',
                'country' => 'Țară',
                'state' => 'Județ',
                'postcode' => 'Cod Poștal'
            ],

            'actions' => [
                'impersonate' => 'Impersonare',
                'profile_url' => 'URL Profil',
            ],
        ],

        'user_verify' => [
            'label' => 'Verificare ID',
            'plural' => 'Verificări ID',

            'sections' => [
                'verification_details' => 'Detalii Verificare',
                'verification_details_descr' => 'Administrează cererea de verificare a utilizatorului.',
            ],

            'tabs' => [
                'all' => 'Toate',
                'pending' => 'În așteptare',
                'approved' => 'Aprobat',
                'rejected' => 'Respins',
            ],

            'fields' => [
                'user_id' => 'Utilizator',
                'status' => 'Stare',
                'rejectionReason' => 'Motiv Respingere',
                'files' => 'Vizualizare fisiere'
            ],

            'actions' => [
                'profile_url' => 'URL Profil',
            ],
        ],

        'wallet' => [
            'label' => 'Portofel',
            'plural' => 'Portofele',

            'sections' => [
                'wallet_details' => 'Detalii Portofel',
            ],

            'fields' => [
                'id' => 'ID Portofel',
                'user_id' => 'Utilizator',
                'total' => 'Sumă Totală'
            ],

            'helper_texts' => [
                'id' => 'Format UUID recomandat.',
            ],
        ],

        'notification' => [
            'label' => 'Notificare',
            'plural' => 'Notificări',

            'sections' => [
                'general_info' => 'Informații Generale',
                'notification_details' => 'Detalii Notificare',
                'linked_models' => 'Modele Asociate',
            ],

            'fields' => [
                'id' => 'ID Notificare',
                'from_user_id' => 'De la Utilizator',
                'to_user_id' => 'Către Utilizator',
                'type' => 'Tip Notificare',
                'read' => 'Citit',
                'post_id' => 'ID Postare',
                'post_comment_id' => 'ID Comentariu',
                'subscription_id' => 'ID Abonament',
                'transaction_id' => 'ID Tranzacție',
                'reaction_id' => 'ID Reacție',
                'withdrawal_id' => 'ID Retragere',
                'user_message_id' => 'ID Mesaj Utilizator',
                'stream_id' => 'ID Stream',
            ],

            'helper_texts' => [
                'id' => 'Format UUID recomandat.',
                'read' => 'Indică dacă utilizatorul a văzut notificarea.',
            ],

            'types' => [
                'ppv_unlock' => 'Conținut Deblocat',
                'expiring_stream' => 'Stream Expiră',
                'new_message' => 'Mesaj Nou',
                'withdrawal_action' => 'Actualizare Retragere',
                'new_subscription' => 'Abonament Nou',
                'new_comment' => 'Comentariu Nou',
                'new_reaction' => 'Reacție Nouă',
                'new_tip' => 'Tips Nou',
            ],
        ],

        'user_message' => [
            'label' => 'Mesaj',
            'plural' => 'Mesaje',

            'sections' => [
                'user_message_details' => 'Detalii Mesaj Utilizator',
                'user_message_details_descr' => 'Gestionează mesajele directe dintre utilizatori.',
            ],

            'fields' => [
                'sender_id' => 'Expeditor',
                'receiver_id' => 'Destinatar',
                'message' => 'Conținut Mesaj',
                'price' => 'Preț (Opțional)',
                'replyTo' => 'ID Mesaj Răspuns',
                'isSeen' => 'Este Văzut',
            ],

            'attachments' => [
                'title' => 'Vizualizare atașamente',
                'breadcrumb' => 'Atașamente',
                'nav_label' => 'Vezi atașamente',
                'file_link' => 'Deschide fișierul',
                'file' => 'Fișier',
                'actions' => [
                    'create' => 'Adaugă atașament',
                ],
            ],

            'transactions' => [
                'title' => 'Vizualizare plăți',
                'breadcrumb' => 'Plăți',
                'nav_label' => 'Vezi plăți',
                'fields' => [
                    'id' => 'ID',
                    'sender' => 'Expeditor',
                    'payer' => 'Plătitor',
                    'status' => 'Stare',
                    'type' => 'Tip',
                    'payment_provider' => 'Furnizor',
                    'amount' => 'Sumă',
                ],
                'actions' => [
                    'create' => 'Adăugare tranzactie',
                ],
            ],

        ],

        'reaction' => [
            'label' => 'Reacție',
            'plural' => 'Reacții',

            'sections' => [
                'reaction_info' => 'Informații Reacție',
                'reaction_info_descr' => 'Detalii despre utilizator și tipul reacției.',
                'target_content' => 'Conținut Țintă',
                'target_content_descr' => 'Specifică conținutul la care este atașată reacția.',
            ],

            'fields' => [
                'user_id' => 'Utilizator',
                'reaction_type' => 'Tip Reacție',
                'post_id' => 'ID Postare',
                'post_comment_id' => 'ID Comentariu',
            ],

            'types' => [
                'like' => 'Apreciere',
            ],
        ],

        'user_list' => [
            'label' => 'Listă',
            'plural' => 'Liste',

            'sections' => [
                'list_details' => 'Detalii listă',
                'list_details_descr' => 'Furnizează un nume și un tip pentru această listă de utilizatori.',
                'owner' => 'Proprietar',
                'owner_descr' => 'Selectează utilizatorul care deține această listă.',
            ],

            'fields' => [
                'name' => 'Nume listă',
                'type' => 'Tip listă',
                'user_id' => 'Proprietar listă',
            ],

            'placeholders' => [
                'name' => 'Introdu numele listei',
            ],

            'types' => [
                'blocked' => 'Utilizatori blocați',
                'following' => 'Urmărește',
                'followers' => 'Urmăritori',
                'custom' => 'Listă personalizată',
            ],

            'members' => [
                'title' => 'Vezi membrii listei',
                'breadcrumb' => 'Membri',
                'navigation_label' => 'Vezi Membri',
                'fields' => [
                    'id' => 'ID',
                    'username' => 'Utilizator',
                    'created_at' => 'Creat la',
                ],
            ],

        ],

        'user_list_member' => [
            'label' => 'Membru listă',
            'plural' => 'Membri listă',

            'actions' => [
                'create' => 'Adaugă membru',
            ],

            'sections' => [
                'list_association' => 'Asociere listă',
                'list_association_descr' => 'Atribuie un utilizator unei liste specifice.',
            ],

            'fields' => [
                'list_id' => 'ID Listă utilizator',
                'user_id' => 'Utilizator',
            ],

            'placeholders' => [
                'list_id' => 'Selectează o listă',
                'user_id' => 'Selectează un utilizator',
            ],
        ],

        'user_bookmark' => [
            'label' => 'Marcaj',
            'plural' => 'Marcaje',

            'sections' => [
                'bookmark_details' => 'Detalii Marcaj',
                'bookmark_details_descr' => 'Asociază un utilizator cu un articol marcat.',
            ],

            'fields' => [
                'user_id' => 'Utilizator',
                'post_id' => 'ID Postare',
                'username' => 'Utilizator',
                'created_at' => 'Creat la',
                'updated_at' => 'Actualizat la',
            ],
        ],

        'user_report' => [
            'label' => 'Raport',
            'plural' => 'Rapoarte',

            'sections' => [
                'reporter_reported' => 'Raportat / Raportator',
                'reporter_reported_descr' => 'Identifică utilizatorul care trimite raportul și pe cel raportat.',
                'reported_content' => 'Conținut Raportat (Opțional)',
                'reported_content_descr' => 'Leagă raportul de o postare, mesaj sau stream specific.',
                'report_details' => 'Detalii Raport',
            ],

            'tabs' => [
                'all' => 'Toate',
                'received' => 'Primite',
                'seen' => 'Văzute',
                'solved' => 'Rezolvate',
            ],

            'fields' => [
                'from_user_id' => 'Raportator',
                'user_id' => 'Utilizator Raportat',
                'post_id' => 'ID Postare',
                'message_id' => 'ID Mesaj',
                'stream_id' => 'ID Stream',
                'type' => 'Motiv Raport',
                'status' => 'Stare',
                'details' => 'Detalii Suplimentare',
            ],

            'types' => [
                'i_dont_like' => 'Nu-mi place',
                'spam' => 'Spam',
                'dmca' => 'DMCA',
                'offensive_content' => 'Conținut ofensator',
                'abuse' => 'Abuz',
            ],

            'statuses' => [
                'received' => 'Primit',
                'seen' => 'Văzut',
                'solved' => 'Rezolvat',
            ],

            'actions' => [
                'view_admin' => 'Vezi pagina admin',
                'view_public' => 'Vezi pagina publică',
            ],
        ],

        'featured_user' => [
            'label' => 'Utilizator Evidențiat',
            'plural' => 'Utilizatori Evidențiați',

            'sections' => [
                'main' => 'Evidențiază un utilizator',
                'main_descr' => 'Selectează un utilizator care va fi evidențiat pe platformă.',
            ],

            'fields' => [
                'user_id' => 'Utilizator Evidențiat',
                'username' => 'Nume utilizator'
            ],
        ],

        'user_tax' => [
            'label' => 'Informații fiscale',
            'plural' => 'Informații fiscale',

            'sections' => [
                'user' => 'Asociere utilizator',
                'user_descr' => 'Asociază informațiile fiscale unui utilizator și țării emitente.',

                'tax' => 'Identificare fiscală',
                'tax_descr' => 'Detalii legale și de identificare fiscală.',

                'personal' => 'Detalii personale',
                'personal_descr' => 'Informații personale și de adresă suplimentare.',
            ],

            'fields' => [
                'user_id' => 'Utilizator',
                'issuing_country_id' => 'Țara emitentă',
                'legal_name' => 'Nume legal',
                'tax_identification_number' => 'Cod fiscal',
                'vat_number' => 'Cod TVA',
                'tax_type' => 'Tip impozit',
                'date_of_birth' => 'Data nașterii',
                'primary_address' => 'Adresă principală',
            ],

            'descriptions' => [
                'primary_address' => 'Introduceți adresa completă',
            ],

            'placeholders' => [
                'user_id' => 'Selectează utilizator',
                'issuing_country_id' => 'Selectează țara',
            ],

            'options' => [
                'types' => [
                    'dac7' => 'DAC7',
                ],
            ],
        ],

        'post_comment' => [
            'label' => 'Comentariu',
            'plural' => 'Comentarii',

            'sections' => [
                'post_comment_details' => 'Detalii Comentariu Postare',
                'post_comment_details_descr' => 'Detalii despre comentariul la postare.',
            ],

            'fields' => [
                'id' => 'Id',
                'author' => 'Utilizator',
                'message' => 'Mesaj',
                'post_id' => 'Postare'
            ],
        ],

        'attachment' => [
            'label' => 'Atașament',
            'plural' => 'Atașamente',

            'sections' => [
                'file_and_metadata' => 'Fișier & Metadate',
                'associations' => 'Asocieri',
                'attachment_details' => 'Detalii Atașament',
                'attachment_details_descr' => 'Configurează sau revizuiește detaliile atașamentului.',
            ],

            'fields' => [
                'id' => 'ID',
                'filename' => 'Nume fișier',
                'file' => 'Fișier',
                'driver' => 'Driver de stocare',
                'type' => 'Tip',
                'user_id' => 'Utilizator',
                'post_id' => 'ID Postare',
                'message_id' => 'ID Mesaj',
                'payment_request_id' => 'ID Cerere Plată',
                'coconut_id' => 'ID Coconut',
                'has_thumbnail' => 'Are miniatură',
                'has_blurred_preview' => 'Previzualizare blurată',
                'open' => 'Deschide fișier'
            ],

            'help' => [
                'id' => 'Format UUID preferat.',
                'driver' => 'Selectează driverul de stocare pentru fișierele utilizatorului.',
            ],
        ],

        'poll' => [
            'label' => 'Sondaj',
            'plural' => 'Sondaje',

            'sections' => [
                'post_details' => 'Detalii Sondaj',
                'post_details_descr' => 'Configurează detaliile sondajului.',
            ],

            'fields' => [
                'user_id' => 'Utilizator',
                'post_id' => 'ID Postare',
                'ends_at' => 'Se Încheie La',
                'answer_id' => 'Răspuns Selectat',
                'answer' => 'Opțiune',
                'id' => 'ID',
            ],

            'filters' => [
                'poll.id' => 'ID Sondaj',
                'user.username' => 'Nume Utilizator',
            ],

            'poll_answers' => [
                'poll_choices' => 'Opțiuni Sondaj',
                'choices' => 'Opțiuni',
                'actions' => [
                    'create' => 'Adaugă opțiune nouă',
                    'edit' => 'Editează opțiunea',
                    'delete' => 'Șterge opțiunea',
                ],
            ],

            'user_poll_answers' => [
                'label' => 'Răspunsuri Utilizator',
                'fields' => [
                    'user_id' => 'Utilizator',
                    'answer_id' => 'Răspuns Selectat',
                    'answer' => 'Răspuns',
                ],
                'actions' => [
                    'create' => 'Adaugă răspuns',
                    'edit' => 'Editează răspunsul',
                    'delete' => 'Șterge răspunsul',
                ],
            ],

        ],

        'transaction' => [

            'label' => 'Tranzacție',
            'plural' => 'Tranzacții',

            'sections' => [
                'participants' => 'Participanți',
                'participants_descr' => 'Definește expeditorul și destinatarul implicați în tranzacție.',

                'details' => 'Detalii Tranzacție',
                'details_descr' => 'Setează statusul, tipul, furnizorul și datele de bază.',

                'related' => 'Entități Aferente',
                'related_descr' => 'Asociază această tranzacție cu conținut sau abonamente.',

                'provider_info' => 'Informații Furnizor',
                'provider_info_descr' => 'Adaugă ID-uri sau token-uri opționale de la furnizori externi.',
            ],

            'fields' => [
                'sender_user_id' => 'Expeditor',
                'recipient_user_id' => 'Destinatar',

                'status' => 'Status',
                'type' => 'Tip Tranzacție',
                'payment_provider' => 'Furnizor Plată',
                'currency' => 'Cod valută',
                'amount' => 'Sumă',
                'taxes' => 'Taxe',

                'subscription_id' => 'Abonament',
                'post_id' => 'Postare',
                'stream_id' => 'Stream',
                'invoice_id' => 'Factură',
                'user_message_id' => 'Mesaj',

                'paypal_payer_id' => 'PayPal Payer ID',
                'paypal_transaction_id' => 'PayPal Transaction ID',
                'paypal_transaction_token' => 'PayPal Transaction Token',

                'stripe_transaction_id' => 'Stripe Transaction ID',
                'stripe_session_id' => 'Stripe Session ID',

                'coinbase_charge_id' => 'Coinbase Charge ID',
                'coinbase_transaction_token' => 'Coinbase Transaction Token',

                'nowpayments_payment_id' => 'NowPayments Payment ID',
                'nowpayments_order_id' => 'NowPayments Order ID',

                'ccbill_transaction_token' => 'CCBill Transaction Token',
                'ccbill_transaction_id' => 'CCBill Transaction ID',
                'ccbill_subscription_id' => 'CCBill Subscription ID',

                'verotel_payment_token' => 'Verotel Transaction Token',
                'verotel_sale_id' => 'Verotel Sale ID',

                'paystack_payment_token' => 'Paystack Payment Token',

                'mercado_payment_token' => 'Mercado Pago Payment Token',
                'mercado_payment_id' => 'Mercado Pago Payment ID',

                'sender' => 'Expeditor',
                'receiver' => 'Destinatar',
                'receiver_user_id' => 'Utilizator Destinatar',
                'id' => 'ID'

            ],

            'helpers' => [
                'taxes' => 'Este necesar format JSON. Exemple pot fi luate din tranzacții create de aplicație.',
                'taxes_placeholder' => 'Introduceți detalii despre taxe sau notițe',
            ],


            'status_labels' => [
                'pending' => 'În așteptare',
                'refunded' => 'Rambursat',
                'partially_paid' => 'Parțial Plătit',
                'declined' => 'Refuzat',
                'initiated' => 'Inițiat',
                'canceled' => 'Anulat',
                'approved' => 'Aprobat',
            ],

            'type_labels' => [
                'tip' => 'Bacșiș',
                'deposit' => 'Depunere',
                'withdrawal' => 'Retragere',
                'chat_tip' => 'Bacșiș în chat',
                'stream_access' => 'Acces Stream',
                'message_unlock' => 'Deblocare Mesaj',
                'post_unlock' => 'Deblocare Postare',
                'one_month_subscription' => 'Abonament 1 Lună',
                'three_months_subscription' => 'Abonament 3 Luni',
                'six_months_subscription' => 'Abonament 6 Luni',
                'yearly_subscription' => 'Abonament Anual',
                'subscription_renewal' => 'Reînnoire  abonament',
            ],

            'tabs' => [
                'all' => 'Toate',
                'pending' => 'În așteptare',
                'approved' => 'Aprobat',
                'declined' => 'Respins',
            ],

        ],

        'post' => [
            'label' => 'Postare',
            'plural' => 'Postări',

            'sections' => [
                'details' => 'Detalii Postare',
                'details_descr' => 'Configurează detaliile postării.',
                'settings' => 'Setări Postare',
                'settings_descr' => 'Setări pentru preț, stare și programare.',
            ],

            'fields' => [
                'user_id' => 'Utilizator',
                'text' => 'Text Postare',
                'price' => 'Preț',
                'status' => 'Stare',
                'release_date' => 'Data Publicării',
                'expire_date' => 'Data Expirării',
                'is_pinned' => 'Fixează această postare',
            ],

            'actions' => [
                'post_url' => 'URL Postare',
            ],

            'status_labels' => [
                '0' => 'În așteptare',
                '1' => 'Aprobat',
                '2' => 'Respins',
            ],
        ],

        'subscription' => [
            'label' => 'Abonament',
            'plural' => 'Abonamente',

            'sections' => [
                'user_info' => 'Informații Utilizator',
                'subscription_details' => 'Detalii Abonament',
                'platform_identifiers' => 'Identificatori Platformă',
                'timestamps' => 'Marcaje Temporale',
            ],

            'fields' => [
                'sender_user_id' => 'Utilizator Abonat',
                'recipient_user_id' => 'Utilizator Creator',

                'subscriber.username' => 'Nume Abonat',
                'creator.username' => 'Nume Creator',

                'type' => 'Tip Abonament',
                'status' => 'Stare Abonament',
                'provider' => 'Procesator Plăți',
                'amount' => 'Sumă',

                'paypal_agreement_id' => 'ID Acord PayPal',
                'paypal_plan_id' => 'ID Plan PayPal',
                'stripe_subscription_id' => 'ID Abonament Stripe',
                'ccbill_subscription_id' => 'ID Abonament CCBill',
                'verotel_sale_id' => 'ID Vânzare Verotel',

                'expires_at' => 'Expiră La',
                'canceled_at' => 'Anulat La',
            ],

            'status_labels' => [
                'active' => 'Activ',
                'completed' => 'Finalizat',
                'canceled' => 'Anulat',
                'suspended' => 'Suspendat',
                'expired' => 'Expirat',
                'failed' => 'Eșuat',
                'pending' => 'În Așteptare',
            ],

            'type_labels' => [
                'one_month_subscription' => 'Abonament 1 Lună',
                'three_months_subscription' => 'Abonament 3 Luni',
                'six_months_subscription' => 'Abonament 6 Luni',
                'yearly_subscription' => 'Abonament 1 An',
            ],

            'tabs' => [
                'all' => 'Toate',
                'pending' => 'În așteptare',
                'active' => 'Activ',
                'canceled' => 'Anulat',
            ],

        ],

        'withdrawal' => [
            'label' => 'Retragere',
            'plural' => 'Retrageri',

            'sections' => [
                'details' => 'Detalii Retragere',
                'details_descr' => 'Configurează sau revizuiește detaliile cererii de retragere.',
            ],

            'fields' => [
                'id' => 'ID',
                'username' => 'Utilizator',
                'amount' => 'Sumă',
                'fee' => 'Comision',
                'status' => 'Stare',
                'processed' => 'Procesat',
                'payment_method' => 'Metodă de Plată',
                'payment_identifier' => 'Identificator Plată',
                'stripe_payout_id' => 'ID Plată Stripe',
                'stripe_transfer_id' => 'ID Transfer Stripe',
                'user_id' => 'Utilizator',
                'message' => 'Mesaj',
            ],

            'helpers' => [
                'stripe_connect_warning' => 'Retragerile prin Stripe Connect pot fi create doar de creatori',
                'status_creation_rule' => 'O retragere nouă trebuie să fie creată cu starea „solicitat”.',
                'processed_warning' => 'Această cerere de retragere a fost deja procesată',
                'amount_overflow' => 'Soldul creditului utilizatorului este mai mic decât suma retragerii. Încercați o sumă mai mică',
            ],

            'status_labels' => [
                'approved' => 'Aprobat',
                'requested' => 'Solicitat',
                'rejected' => 'Respins',
            ],

            'actions' => [
                'approve' => 'Aprobă',
                'reject' => 'Respinge',
            ],

            'tabs' => [
                'all' => 'Toate',
                'requested' => 'Solicitate',
                'approved' => 'Aprobate',
                'rejected' => 'Respinse',
            ],

            'navigation_badge_tooltip' => 'Numărul de retrageri în așteptare',
        ],

        'payment_request' => [
            'label' => 'Cerere Plată',
            'plural' => 'Cereri Plată',

            'sections' => [
                'payment_request' => 'Cerere Plată',
            ],

            'fields' => [
                'user_id' => 'Utilizator',
                'transaction_id' => 'ID Tranzacție',
                'amount' => 'Sumă',
                'status' => 'Stare',
                'type' => 'Tip',
                'reason' => 'Motivul Refuzului',
                'message' => 'Mesaj',
            ],

            'status_labels' => [
                'approved' => 'Aprobat',
                'pending' => 'În Așteptare',
                'rejected' => 'Respins',
            ],

            'type_labels' => [
                'deposit' => 'Depozit',
            ],

            'tabs' => [
                'all' => 'Toate',
                'pending' => 'În așteptare',
                'approved' => 'Aprobat',
                'rejected' => 'Respins',
            ],

        ],

        'invoice' => [
            'label' => 'Factură',
            'plural' => 'Facturi',

            'sections' => [
                'invoice_info' => 'Informații factură',
                'invoice_info_descr' => 'Aici poți vedea datele codificate ale unei facturi generate.',
            ],

            'fields' => [
                'invoice_id' => 'ID Factură',
                'transaction_id' => 'ID Tranzacție',
                'data' => 'Date',
            ],

            'actions' => [
                'invoice_url' => 'URL Factură',
            ],
        ],

        'tax' => [
            'label' => 'Taxă',
            'plural' => 'Taxe',

            'sections' => [
                'details' => 'Detalii Taxă',
                'details_descr' => 'Editează detaliile despre taxele platformei.',
            ],

            'fields' => [
                'name' => 'Nume',
                'type' => 'Tip',
                'percentage' => 'Valoare',
                'country_name' => 'Țară',
                'countries_name' => 'Țări',
                'hidden' => 'Ascuns',
            ],

            'type_labels' => [
                'fixed' => 'Fixă',
                'exclusive' => 'Exclusivă',
                'inclusive' => 'Inclusivă',
            ],
        ],

        'country' => [
            'label' => 'Țară',
            'plural' => 'Țări',

            'sections' => [
                'country_details' => 'Detalii Țară',
                'country_details_descr' => 'Detalii despre țară sau regiune.',
            ],

            'fields' => [
                'name' => 'Nume',
                'country_code' => 'Cod Țară',
                'phone_code' => 'Prefix Telefonic',
                'created_at' => 'Creat La',
                'updated_at' => 'Actualizat La',
            ],
        ],

        'stream' => [
            'label' => 'Stream',
            'plural' => 'Streamuri',

            'sections' => [
                'stream_details' => 'Detalii Stream',
                'stream_details_descr' => 'Informații de bază despre stream.',
                'stream_source' => 'Sursă & Redare Stream',
                'stream_source_descr' => 'Configurare pentru livrarea stream-ului și RTMP.',
                'advanced_metadata' => 'Avansat & Metadate',
            ],

            'fields' => [
                'name' => 'Nume Stream',
                'slug' => 'Slug',
                'price' => 'Preț Acces',
                'user_id' => 'Utilizator',
                'poster' => 'Imagine Poster',
                'status' => 'Stare',
                'requires_subscription' => 'Necesită Abonament',
                'is_public' => 'Stream Public',
                'sent_expiring_reminder' => 'Notificare de Expirare Trimisa',

                'driver' => 'Driver Streaming',
                'pushr_id' => 'ID Pushr',
                'rtmp_key' => 'Cheie RTMP',
                'rtmp_server' => 'Server RTMP',
                'hls_link' => 'Link Redare HLS',
                'vod_link' => 'Link VOD',

                'settings' => 'Setări Stream (JSON)',
                'ended_at' => 'Finalizat La',
                'created_at' => 'Creat La',
                'updated_at' => 'Actualizat La',
            ],

            'status_labels' => [
                'all' => 'Toate',
                'in_progress' => 'În Progres',
                'ended' => 'Finalizat',
                'deleted' => 'Sters',
            ],

            'driver_labels' => [
                1 => 'PushrCDN',
                2 => 'LiveKit',
            ],
        ],

        'stream_message' => [
            'label' => 'Mesaj Stream',
            'plural' => 'Mesaje Stream',

            'sections' => [
                'message_details' => 'Detalii Mesaj',
            ],

            'fields' => [
                'user_id' => 'Utilizator',
                'stream_id' => 'Stream',
                'message' => 'Conținut Mesaj',
                'created_at' => 'Creat La',
                'updated_at' => 'Actualizat La',
            ],

            'help' => [
                'user_id' => 'Selectează utilizatorul care a trimis mesajul.',
                'stream_id' => 'Alege stream-ul asociat acestui mesaj.',
                'message' => 'Conținutul mesajului din chat.',
            ],
        ],

        'public_page' => [
            'label' => 'Pagină Publică',
            'plural' => 'Pagini Publice',

            'sections' => [
                'page_details' => 'Detalii Pagină',
                'page_details_descr' => 'Configurează conținutul și structura acestei pagini publice.',
                'display_settings' => 'Setări de Afișare',
                'display_settings_descr' => 'Controlează modul și locul în care apare această pagină.',
            ],

            'fields' => [
                'title' => 'Titlu',
                'title_helper' => 'Titlul paginii afișat în antet și în listă.',
                'short_title' => 'Titlu Scurt',
                'short_title_helper' => 'Titlu alternativ mai scurt pentru navigații sau meniuri.',
                'slug' => 'Slug',
                'slug_helper' => 'Identificator unic folosit în URL (fără spații sau caractere speciale).',
                'shown_in_footer' => 'Afișat în Subsol',
                'shown_in_footer_helper' => 'Activează pentru a afișa pagina în subsolul site-ului.',
                'is_tos' => 'Termeni și Condiții',
                'is_tos_helper' => 'Activează dacă pagina reprezintă Termenii și Condițiile.',
                'is_privacy' => 'Politica de Confidențialitate',
                'is_privacy_helper' => 'Activează dacă pagina este Politica de Confidențialitate.',
                'show_last_update_date' => 'Afișează Data Ultimei Actualizări',
                'show_last_update_date_helper' => 'Dacă este activat, data ultimei modificări va fi afișată pe pagină.',
                'page_order' => 'Ordinea Paginilor',
                'page_order_helper' => 'Stabilește ordinea în care apare această pagină în listă.',
            ],

        ],

        'contact_message' => [
            'label' => 'Mesaj Contact',
            'plural' => 'Mesaje Contact',

            'fields' => [
                'email' => 'Email',
                'subject' => 'Subiect',
                'message' => 'Mesaj',
                'created_at' => 'Creat La',
                'updated_at' => 'Actualizat La',
            ],
        ],

        'global_announcement' => [
            'label' => 'Anunț',
            'plural' => 'Anunțuri',

            'fields' => [
                'content' => 'Conținut',
                'size' => 'Dimensiune',
                'expiring_at' => 'Expiră La',
                'is_published' => 'Publicat',
                'is_dismissible' => 'Poate Fi Închis',
                'is_sticky' => 'Sticky',
                'is_global' => 'Global',
            ],

            'sections' => [
                'content' => 'Conținut',
                'content_descr' => 'Detalii despre anunț.',
                'visibility' => 'Vizibilitate',
                'visibility_descr' => 'Activează/dezactivează comportamentele de afișare.',
            ],

            'size_labels' => [
                'regular' => 'Normal',
                'small' => 'Mic',
            ],
        ],


        'reward' => [
            'label'  => 'Recomandare',
            'plural' => 'Recomandări',

            'sections' => [
                'referral_info'       => 'Informații despre recompensa de recomandare',
                'referral_info_descr' => 'Atribuiți recompensele generate din activitatea de recomandare.',
            ],

            'fields' => [
                'id'                     => 'ID',
                'from_user_id'           => 'Recomandator',
                'to_user_id'             => 'Utilizator recomandat',
                'referral_code_usage_id' => 'Utilizare cod de recomandare',
                'amount'                 => 'Valoarea recompensei',
                'transaction_id'         => 'ID tranzacție',
                'reward_type'            => 'Tipul recompensei',
            ],

            'help' => [
                'reward_type' => 'Codul tipului pentru recompensă.',
            ],
        ],

    ],

    'settings' => [
        'general' => 'General',
        'profiles' => 'Profiluri',
        'feed' => 'Feed',
        'media' => 'Media',
        'storage' => 'Stocare',
        'payments' => 'Plăți',
        'websockets' => 'Websockets',
        'emails' => 'Emailuri',
        'social' => 'Rețele sociale',
        'code_and_ads' => 'Cod și reclame',
        'streams' => 'Transmisiuni',
        'compliance' => 'Conformitate',
        'security' => 'Securitate',
        'referrals' => 'Recomandări',
        'ai' => 'AI',
        'admin' => 'Administrare',
        'theme' => 'Temă',
        'license' => 'Licență',
    ],

];
