<?php

return [
    'dashboard' => [

    ],

    'common' => [
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'expiring_at' => 'Expiring at',
        'canceled_at' => 'Canceled at',
        'create' => 'Create',
        'edit' => 'Update',
        'delete' => 'Delete',
        'view' => 'View',
    ],

    'navigation' => [
        'dashboard' => 'Dashboard',
        'groups' => [
            'users' => 'Users',
            'posts' => 'Posts',
            'finances' => 'Finances',
            'taxes' => 'Taxes',
            'streams' => 'Streams',
            'site' => 'Site',
            'settings' => 'Settings',
        ],
    ],

    'filters' => [
        'title' => 'Filters',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'today' => 'Today',
        'week' => 'Last week',
        'month' => 'Last month',
        'year' => 'This year',
    ],

    'widgets' => [
        'stats_overview' => [
//            'title' => 'Last 7 days stats',

            'revenue' => [
                'label' => 'Revenue',
                'description' => 'Total revenue',
            ],
            'new_users' => [
                'label' => 'New Users',
                'description' => 'Registered users',
            ],
            'new_payments' => [
                'label' => 'New Payments',
                'description' => 'Completed payments',
            ],
        ],

        'users_chart' => [
            'title' => 'Users',
            'datasets' => [
                'users' => 'Users',
                'user_messages' => 'User Messages',
            ],
        ],

        'posts_chart' => [
            'title' => 'Posts',
            'filters' => [
                'today' => 'Today',
                'week' => 'Last week',
                'month' => 'Last month',
                'year' => 'This year',
            ],
            'datasets' => [
                'posts' => 'Posts',
                'comments' => 'Comments',
                'reactions' => 'Reactions',
            ],
        ],

        'transactions_chart' => [
            'title' => 'Payments',
            'filters' => [
                'today' => 'Today',
                'week' => 'Last week',
                'month' => 'Last month',
                'year' => 'This year',
            ],
            'datasets' => [
                'transactions' => 'Payments',
                'subscriptions' => 'Subscriptions',
            ],
        ],

        'streams_chart' => [
            'title' => 'Streams',
            'filters' => [
                'today' => 'Today',
                'week' => 'Last week',
                'month' => 'Last month',
                'year' => 'This year',
            ],
            'datasets' => [
                'streams' => 'Streams',
                'stream_messages' => 'Stream Messages',
            ],
        ],

        'product_info' => [
            'title' => 'Quickstart',
            'website' => [
                'title' => 'Website',
                'description' => 'Visit the official product page',
            ],
            'documentation' => [
                'title' => 'Documentation',
                'description' => 'Visit the official product docs',
            ],
            'changelog' => [
                'title' => 'Changelog',
                'description' => 'Visit the official product changelog',
            ],
        ],

        'transaction_stats' => [
            'heading' => 'This year payments',
            'total' => 'Total payments',
            'completed' => 'Completed payments',
            'average' => 'Average price',
        ],

        'subscription_stats' => [
            'heading' => 'This year subscriptions',
            'total' => 'Total subscriptions',
            'active' => 'Currently active subscriptions',
            'average_price' => 'Average price',
        ],

    ],

    'resources' => [
        'user' => [
            'label' => 'User',
            'plural' => 'Users',
            'sections' => [
                'account_info' => 'Account Info',
                'paywall_info' => 'Paywall Info',
                'profile_info' => 'Profile Info',
                'withdrawals_info' => 'Withdrawals Info',
                'security_info' => 'Security Info',
                'billing_info' => 'Billing Info',
            ],
            'fields' => [
                'id' => 'ID',
                'name' => 'Name',
                'email' => 'Email',
                'username' => 'Username',
                'password' => 'Password',
                'roles' => 'Role',
                'email_verified_at' => 'Email Verified At',
                'identity_verified_at' => 'ID Verified At',
                'birthdate' => 'Birthdate',
                'paid_profile' => 'Paid Profile',
                'public_profile' => 'Public Profile',
                'open_profile' => 'Open Profile',
                'profile_access_price' => 'Access Price',
                'profile_access_price_3_months' => '3 Months Access Price',
                'profile_access_price_6_months' => '6 Months Access Price',
                'profile_access_price_12_months' => '12 Months Access Price',
                'current_avatar' => 'Current avatar',
                'avatar' => 'Avatar',
                'current_cover' => 'Current cover',
                'cover' => 'Cover',
                'bio' => 'Bio',
                'location' => 'Location',
                'gender_id' => 'Gender',
                'gender_pronoun' => 'Pronoun',
                'website' => 'Website',
                'referral_code' => 'Referral Code',
                'stripe_account_id' => 'Stripe Connect ID',
                'country_id' => 'Stripe Connect Country',
                'stripe_onboarding_verified' => 'Stripe Onboarding Verified',
                'last_ip' => 'Last IP',
                'last_active_at' => 'Last Active At',
                'enable_geoblocking' => 'Enable Geo-blocking',
                'enable_2fa' => 'Enable 2FA',
                'billing_address' => 'Billing Address',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'city' => 'City',
                'country' => 'Country',
                'state' => 'State',
                'postcode' => 'Postcode'
            ],
            'actions' => [
                'impersonate' => 'Impersonate',
                'profile_url' => 'Profile URL',
            ],
        ],

        'user_verify' => [
            'label' => 'ID-Check',
            'plural' => 'ID-Checks',

            'sections' => [
                'verification_details' => 'Verification Details',
                'verification_details_descr' => 'Manage user verification request.',
            ],

            'tabs' => [
                'all' => 'All',
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Declined',
            ],

            'fields' => [
                'user_id' => 'User',
                'status' => 'Status',
                'rejectionReason' => 'Rejection Reason',
                'files' => 'Files preview'
            ],

            'actions' => [
                'profile_url' => 'Profile URL',
            ],
        ],

        'wallet' => [
            'label' => 'Wallet',
            'plural' => 'Wallets',

            'sections' => [
                'wallet_details' => 'Wallet Details',
            ],

            'fields' => [
                'id' => 'Wallet ID',
                'user_id' => 'User',
                'total' => 'Total Amount',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],

            'helper_texts' => [
                'id' => 'UUID format preferred.',
            ],

        ],

        'notification' => [
            'label' => 'Notification',
            'plural' => 'Notifications',

            'sections' => [
                'general_info' => 'General Information',
                'notification_details' => 'Notification Details',
                'linked_models' => 'Linked Models',
            ],

            'fields' => [
                'id' => 'Notification ID',
                'from_user_id' => 'From User',
                'to_user_id' => 'To User',
                'type' => 'Notification Type',
                'read' => 'Mark as Read',
                'post_id' => 'Post ID',
                'post_comment_id' => 'Post Comment ID',
                'subscription_id' => 'Subscription ID',
                'transaction_id' => 'Transaction ID',
                'reaction_id' => 'Reaction ID',
                'withdrawal_id' => 'Withdrawal ID',
                'user_message_id' => 'User Message ID',
                'stream_id' => 'Stream ID'
            ],

            'helper_texts' => [
                'id' => 'UUID format preferred.',
                'read' => 'Indicates whether the user has seen the notification.',
            ],

            'types' => [
                'ppv_unlock' => 'Content Unlocked',
                'expiring_stream' => 'Expiring Stream',
                'new_message' => 'New Message',
                'withdrawal_action' => 'Withdrawal Update',
                'new_subscription' => 'New Subscription',
                'new_comment' => 'New Comment',
                'new_reaction' => 'New Reaction',
                'new_tip' => 'New Tip',
            ],
        ],

        'user_message' => [
            'label' => 'Message',
            'plural' => 'Messages',

            'sections' => [
                'user_message_details' => 'User Message Details',
                'user_message_details_descr' => 'Manage direct messages between users.',
            ],

            'fields' => [
                'sender_id' => 'Sender',
                'receiver_id' => 'Receiver',
                'message' => 'Message Content',
                'price' => 'Price (Optional)',
                'replyTo' => 'Reply To Message ID',
                'isSeen' => 'Is Seen'
            ],

            'attachments' => [
                'title' => 'View :name Attachments',
                'breadcrumb' => 'Attachments',
                'nav_label' => 'View Attachments',
                'file_link' => 'Open File',
                'actions' => [
                    'create' => 'Add new attachment',
                ],
            ],

            'transactions' => [
                'title' => 'View :record Payments',
                'breadcrumb' => 'Payments',
                'nav_label' => 'View Payments',
                'fields' => [
                    'id' => 'ID',
                    'sender' => 'Sender',
                    'payer' => 'Payer',
                    'status' => 'Status',
                    'type' => 'Type',
                    'payment_provider' => 'Provider',
                    'amount' => 'Amount',
                ],
                'actions' => [
                    'create' => 'Add new transaction',
                ],
            ]

        ],

        'reaction' => [
            'label' => 'Reaction',
            'plural' => 'Reactions',

            'sections' => [
                'reaction_info' => 'Reaction Info',
                'reaction_info_descr' => 'Details about the user and the type of reaction.',
                'target_content' => 'Target Content',
                'target_content_descr' => 'Specify the content this reaction is attached to.',
            ],

            'fields' => [
                'user_id' => 'User',
                'reaction_type' => 'Reaction Type',
                'post_id' => 'Post ID',
                'post_comment_id' => 'Comment ID'
            ],

            'types' => [
                'like' => 'Like',
            ],
        ],

        'user_list' => [
            'label' => 'List',
            'plural' => 'Lists',

            'sections' => [
                'list_details' => 'List Details',
                'list_details_descr' => 'Provide a name and type for this user list.',
                'owner' => 'Owner',
                'owner_descr' => 'Select the user who owns this list.',
            ],

            'fields' => [
                'name' => 'List Name',
                'type' => 'List Type',
                'user_id' => 'List Owner'
            ],

            'placeholders' => [
                'name' => 'Enter list name',
            ],

            'types' => [
                'blocked' => 'Blocked Users',
                'following' => 'Following',
                'followers' => 'Followers',
                'custom' => 'Custom List',
            ],

            'members' => [
                'title' => 'View :name Members',
                'breadcrumb' => 'Members',
                'navigation_label' => 'View Members',
                'fields' => [
                    'id' => 'ID',
                    'username' => 'User',
                    'created_at' => 'Created At',
                ],
            ],


        ],

        'user_list_member' => [
            'label' => 'List Member',
            'plural' => 'List Members',

            'actions' => [
                'create' => 'Add new member',
            ],

            'sections' => [
                'list_association' => 'List Association',
                'list_association_descr' => 'Assign a user to a specific list.',
            ],

            'fields' => [
                'list_id' => 'User List ID',
                'user_id' => 'User',
            ],

            'placeholders' => [
                'list_id' => 'Select a list',
                'user_id' => 'Select a user',
            ],
        ],

        'user_bookmark' => [
            'label' => 'Bookmark',
            'plural' => 'Bookmarks',

            'sections' => [
                'bookmark_details' => 'Bookmark Details',
                'bookmark_details_descr' => 'Link a user to a bookmarked post.',
            ],

            'fields' => [
                'user_id' => 'User',
                'post_id' => 'Post ID',
                'username' => 'Username'
            ],
        ],


        'user_report' => [
            'label' => 'Report',
            'plural' => 'Reports',

            'sections' => [
                'reporter_reported' => 'Reporter & Reported Users',
                'reporter_reported_descr' => 'Identify the user submitting the report and the user being reported.',

                'reported_content' => 'Reported Content (Optional)',
                'reported_content_descr' => 'Link this report to a specific piece of content.',

                'report_details' => 'Report Details',
            ],

            'tabs' => [
                'all' => 'All',
                'received' => 'Received',
                'seen' => 'Seen',
                'solved' => 'Solved',
            ],

            'fields' => [
                'from_user_id' => 'Reporter',
                'user_id' => 'Reported User',
                'post_id' => 'Post ID',
                'message_id' => 'Message ID',
                'stream_id' => 'Stream ID',
                'type' => 'Report Reason',
                'status' => 'Status',
                'details' => 'Additional Details'
            ],

            'types' => [
                'i_dont_like' => 'I Don’t Like This',
                'spam' => 'Spam',
                'dmca' => 'DMCA',
                'offensive_content' => 'Offensive Content',
                'abuse' => 'Abuse',
            ],

            'statuses' => [
                'received' => 'Received',
                'seen' => 'Seen',
                'solved' => 'Solved',
            ],

            'actions' => [
                'view_admin' => 'View Admin Page',
                'view_public' => 'View Public Page',
            ],
        ],

        'featured_user' => [
            'label' => 'Featured User',
            'plural' => 'Featured Users',

            'sections' => [
                'main' => 'Feature a User',
                'main_descr' => 'Select a user to highlight as featured on the platform.',
            ],

            'fields' => [
                'user_id' => 'Featured User',
                'username' => 'Username',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
        ],

        'user_tax' => [
            'label' => 'Tax Information',
            'plural' => 'Tax Information',

            'sections' => [
                'user' => 'User Association',
                'user_descr' => 'Link the tax information to a user and their issuing country.',

                'tax' => 'Tax Identification',
                'tax_descr' => 'Legal and tax identification details.',

                'personal' => 'Personal Details',
                'personal_descr' => 'Additional personal and address information.',
            ],

            'fields' => [
                'user_id' => 'User',
                'issuing_country_id' => 'Issuing Country',
                'legal_name' => 'Legal Name',
                'tax_identification_number' => 'Tax ID Number',
                'vat_number' => 'VAT Number',
                'tax_type' => 'Tax Type',
                'date_of_birth' => 'Date of Birth',
                'primary_address' => 'Primary Address'
            ],

            'descriptions' => [
                'primary_address' => 'Enter full address',
            ],

            'placeholders' => [
                'user_id' => 'Select user',
                'issuing_country_id' => 'Select country',
            ],

            'options' => [
                'types' => [
                    'dac7' => 'DAC7',
                ],
            ],
        ],

        'post_comment' => [
            'label' => 'Comment',
            'plural' => 'Comments',

            'sections' => [
                'post_comment_details' => 'Post Comment Details',
                'post_comment_details_descr' => 'Post comment details.',
            ],

            'fields' => [
                'id' => 'Id',
                'author' => 'User',
                'message' => 'Message',
                'post_id' => 'Post'
            ],
        ],

        'attachment' => [
            'label' => 'Attachment',
            'plural' => 'Attachments',

            'sections' => [
                'file_and_metadata' => 'File & Metadata',
                'associations' => 'Associations',
                'attachment_details' => 'Attachment Details',
                'attachment_details_descr' => 'Configure or review the attachment details.',
            ],

            'fields' => [
                'id' => 'ID',
                'filename' => 'Filename',
                'file' => 'File',
                'driver' => 'Storage Driver',
                'type' => 'Type',
                'user_id' => 'User',
                'post_id' => 'Post ID',
                'message_id' => 'Message ID',
                'payment_request_id' => 'Payment Request ID',
                'coconut_id' => 'Coconut ID',
                'has_thumbnail' => 'Has Thumbnail',
                'has_blurred_preview' => 'Has Blurred Preview',
                'open' => 'Open file'
            ],

            'help' => [
                'id' => 'UUID format preferred.',
                'driver' => 'Select which storage driver to use for the user assets.',
            ],
        ],

        'poll' => [
            'label' => 'Poll',
            'plural' => 'Polls',

            'sections' => [
                'post_details' => 'Poll Details',
                'post_details_descr' => 'Set up the poll details.',
            ],

            'fields' => [
                'user_id' => 'User',
                'post_id' => 'Post ID',
                'ends_at' => 'Ends At',
                'answer_id' => 'Selected Answer',
                'answer' => 'Choice',
                'id' => 'Id',
            ],

            'filters' => [
                'poll.id' => 'Poll ID',
                'user.username' => 'Username',
            ],

            'poll_answers' => [
                'poll_choices' => 'Poll Choices',
                'choices' => 'Choices',
                'actions' => [
                    'create' => 'Add new choice',
                    'edit' => 'Edit choice',
                    'delete' => 'Delete choice',
                ]
            ],

            'user_poll_answers' => [
                'label' => 'User Answers',
                'fields' => [
                    'user_id' => 'User',
                    'answer_id' => 'Selected Answer',
                    'answer' => 'Answer',
                ],
                'actions' => [
                    'create' => 'Add answer',
                    'edit' => 'Edit answer',
                    'delete' => 'Delete answer',
                ],
            ],

        ],

        'transaction' => [

            'label' => 'Transaction',
            'plural' => 'Transactions',

            'sections' => [
                'participants' => 'Participants',
                'participants_descr' => 'Define the sender and recipient involved in the transaction.',

                'details' => 'Transaction Details',
                'details_descr' => 'Set the status, type, provider, and core data.',

                'related' => 'Related Entities',
                'related_descr' => 'Associate this transaction with content or subscriptions.',

                'provider_info' => 'Provider-Specific Info',
                'provider_info_descr' => 'Add optional IDs or tokens from external providers.',
            ],

            'fields' => [
                'sender_user_id' => 'Sender (Buyer)',
                'recipient_user_id' => 'Recipient (Seller)',

                'status' => 'Status',
                'type' => 'Transaction Type',
                'payment_provider' => 'Payment Provider',
                'currency' => 'Currency code',
                'amount' => 'Amount',
                'taxes' => 'Taxes',

                'subscription_id' => 'Subscription',
                'post_id' => 'Post',
                'stream_id' => 'Stream',
                'invoice_id' => 'Invoice',
                'user_message_id' => 'Message',

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

                'sender' => 'Sender',
                'receiver' => 'Recipient',
                'receiver_user_id' => 'Receiver Username',
                'id' => 'ID'

            ],

            'helpers' => [
                'taxes' => 'JSON required. Examples can be taken out of app-created transactions.',
                'taxes_placeholder' => 'Enter tax breakdown or notes',
            ],

            'status_labels' => [
                'pending' => 'Pending',
                'refunded' => 'Refunded',
                'partially_paid' => 'Partially Paid',
                'declined' => 'Declined',
                'initiated' => 'Initiated',
                'canceled' => 'Canceled',
                'approved' => 'Approved',
            ],

            'type_labels' => [
                'tip' => 'Tip',
                'deposit' => 'Deposit',
                'withdrawal' => 'Withdrawal',
                'chat_tip' => 'Chat Tip',
                'stream_access' => 'Stream Access',
                'message_unlock' => 'Message Unlock',
                'post_unlock' => 'Post Unlock',
                'one_month_subscription' => '1-Month Subscription',
                'three_months_subscription' => '3-Month Subscription',
                'six_months_subscription' => '6-Month Subscription',
                'yearly_subscription' => 'Yearly Subscription',
                'subscription_renewal' => 'Subscription Renewal',
            ],

            'tabs' => [
                'all' => 'All',
                'pending' => 'Pending',
                'approved' => 'Approved',
                'declined' => 'Declined',
            ],

        ],

        'post' => [
            'label' => 'Post',
            'plural' => 'Posts',

            'sections' => [
                'details' => 'Post Details',
                'details_descr' => 'Set up the post details.',
                'settings' => 'Post Settings',
                'settings_descr' => 'Pricing, status, and timing settings.',
            ],

            'fields' => [
                'user_id' => 'User',
                'text' => 'Post Text',
                'price' => 'Price',
                'status' => 'Status',
                'release_date' => 'Release Date',
                'expire_date' => 'Expire Date',
                'is_pinned' => 'Pin this post',
            ],

            'actions' => [
                'post_url' => 'Post URL',
            ],

            'status_labels' => [
                '0' => 'Pending',
                '1' => 'Approved',
                '2' => 'Rejected',
            ],
        ],
        'subscription' => [
            'label' => 'Subscription',
            'plural' => 'Subscriptions',

            'sections' => [
                'user_info' => 'User Info',
                'subscription_details' => 'Subscription Details',
                'platform_identifiers' => 'Platform Identifiers',
                'timestamps' => 'Timestamps',
            ],

            'fields' => [
                'sender_user_id' => 'Subscriber Username',
                'recipient_user_id' => 'Creator Username',

                'subscriber.username' => 'Subscriber Username',
                'creator.username' => 'Creator Username',

                'type' => 'Subscription Type',
                'status' => 'Subscription Status',
                'provider' => 'Payment Provider',
                'amount' => 'Amount',

                'paypal_agreement_id' => 'PayPal Agreement ID',
                'paypal_plan_id' => 'PayPal Plan ID',
                'stripe_subscription_id' => 'Stripe Subscription ID',
                'ccbill_subscription_id' => 'CCBill Subscription ID',
                'verotel_sale_id' => 'Verotel Sale ID',

                'expires_at' => 'Expires At',
                'canceled_at' => 'Canceled At',
            ],

            'status_labels' => [
                'active' => 'Active',
                'completed' => 'Completed',
                'canceled' => 'Canceled',
                'suspended' => 'Suspended',
                'expired' => 'Expired',
                'failed' => 'Failed',
                'pending' => 'Pending',
            ],

            'tabs' => [
                'all' => 'All',
                'pending' => 'Pending',
                'active' => 'Active',
                'canceled' => 'Canceled',
            ],

            'type_labels' => [
                'one_month_subscription' => '1-Month Subscription',
                'three_months_subscription' => '3-Month Subscription',
                'six_months_subscription' => '6-Month Subscription',
                'yearly_subscription' => '1-Year Subscription',
            ],
        ],

        'withdrawal' => [
            'label' => 'Withdrawal',
            'plural' => 'Withdrawals',

            'sections' => [
                'details' => 'Withdrawal Details',
                'details_descr' => 'Configure or review the withdrawal request details.',
            ],

            'fields' => [
                'id' => 'ID',
                'username' => 'Username',
                'amount' => 'Amount',
                'fee' => 'Fee',
                'status' => 'Status',
                'processed' => 'Processed',
                'payment_method' => 'Payment Method',
                'payment_identifier' => 'Payment Identifier',
                'stripe_payout_id' => 'Stripe Payout ID',
                'stripe_transfer_id' => 'Stripe Transfer ID',
                'user_id' => 'User',
                'message' => 'Message',
            ],

            'helpers' => [
                'stripe_connect_warning' => 'Withdrawals using Stripe Connect can only be created by creators',
                'status_creation_rule' => 'A new withdrawal must be created with the requested status.',
                'processed_warning' => 'This withdrawal request has already been processed',
                'amount_overflow' => "This user's credit balance is lower than the withdrawal amount. Try a lower amount",
            ],

            'status_labels' => [
                'approved' => 'Approved',
                'requested' => 'Requested',
                'rejected' => 'Rejected',
            ],

            'actions' => [
                'approve' => 'Approve',
                'reject' => 'Reject',
            ],

            'tabs' => [
                'all' => 'All',
                'requested' => 'Requested',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ],

            'navigation_badge_tooltip' => 'The number of pending withdrawals',
        ],


        'payment_request' => [
            'label' => 'Payment Request',
            'plural' => 'Payment Requests',

            'sections' => [
                'payment_request' => 'Payment Request',
            ],

            'fields' => [
                'user_id' => 'User',
                'transaction_id' => 'Transaction ID',
                'amount' => 'Amount',
                'status' => 'Status',
                'type' => 'Type',
                'reason' => 'Rejection Reason',
                'message' => 'Message',
            ],

            'status_labels' => [
                'approved' => 'Approved',
                'pending' => 'Pending',
                'rejected' => 'Rejected',
            ],

            'type_labels' => [
                'deposit' => 'Deposit',
            ],

            'tabs' => [
                'all' => 'All',
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ],

        ],

        'invoice' => [
            'label' => 'Invoice',
            'plural' => 'Invoices',

            'sections' => [
                'invoice_info' => 'Invoice information',
                'invoice_info_descr' => 'Here you can see the encoded data of a generated invoice.',
            ],

            'fields' => [
                'invoice_id' => 'Invoice ID',
                'transaction_id' => 'Transaction ID',
                'data' => 'Data',
            ],

            'actions' => [
                'invoice_url' => 'Invoice URL',
            ],
        ],

        'tax' => [
            'label' => 'Tax',
            'plural' => 'Taxes',

            'sections' => [
                'details' => 'Tax details',
                'details_descr' => 'Edit your site fees details.',
            ],

            'fields' => [
                'name' => 'Name',
                'type' => 'Type',
                'percentage' => 'Value',
                'country_name' => 'Country',
                'countries_name' => 'Countries',
                'hidden' => 'Hidden',
            ],

            'type_labels' => [
                'fixed' => 'Fixed',
                'exclusive' => 'Exclusive',
                'inclusive' => 'Inclusive',
            ],

        ],

        'country' => [
            'label' => 'Country',
            'plural' => 'Countries',

            'sections' => [
                'country_details' => 'Country Details',
                'country_details_descr' => 'Country/region details.',
            ],

            'fields' => [
                'name' => 'Name',
                'country_code' => 'Country Code',
                'phone_code' => 'Phone Code',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
        ],

        'stream' => [
            'label' => 'Stream',
            'plural' => 'Streams',

            'sections' => [
                'stream_details' => 'Stream Details',
                'stream_details_descr' => 'Basic details about the stream.',
                'stream_source' => 'Stream Source & Playback',
                'stream_source_descr' => 'Configuration for stream delivery & RTMP.',
                'advanced_metadata' => 'Advanced & Metadata',
            ],

            'fields' => [
                'name' => 'Stream Name',
                'slug' => 'Slug',
                'price' => 'Access Price',
                'user_id' => 'User',
                'poster' => 'Poster Image',
                'status' => 'Status',
                'requires_subscription' => 'Requires Subscription',
                'is_public' => 'Public Stream',
                'sent_expiring_reminder' => 'Sent Expiration Reminder',

                'driver' => 'Streaming Driver',
                'pushr_id' => 'Pushr ID',
                'rtmp_key' => 'RTMP Key',
                'rtmp_server' => 'RTMP Server',
                'hls_link' => 'HLS Playback Link',
                'vod_link' => 'VOD Link',

                'settings' => 'Stream Settings (JSON)',
                'ended_at' => 'Ended At',
                'created_at' => 'Created',
                'updated_at' => 'Updated',
            ],

            'status_labels' => [
                'all' => 'All',
                'in_progress' => 'In Progress',
                'ended' => 'Ended',
                'deleted' => 'Deleted',
            ],

            'driver_labels' => [
                1 => 'PushrCDN',
                2 => 'LiveKit',
            ],
        ],

        'stream_message' => [
            'label' => 'Stream Message',
            'plural' => 'Stream Messages',

            'sections' => [
                'message_details' => 'Message Details',
            ],

            'fields' => [
                'user_id' => 'User',
                'stream_id' => 'Stream',
                'message' => 'Message Content',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],

            'help' => [
                'user_id' => 'Select the user who sent the message.',
                'stream_id' => 'Choose the stream to associate this message with.',
                'message' => 'The content of the chat message.',
            ],
        ],

        'public_page' => [
            'label' => 'Public Page',
            'plural' => 'Public Pages',

            'sections' => [
                'page_details' => 'Page Details',
                'page_details_descr' => 'Configure the content and structure of this public page.',
                'display_settings' => 'Display Settings',
                'display_settings_descr' => 'Control how and where this page appears.',
            ],

            'fields' => [
                'title' => 'Title',
                'title_helper' => 'Page title shown in header and list.',
                'short_title' => 'Short Title',
                'short_title_helper' => 'Alternative shorter title used for navigation or menus.',
                'slug' => 'Slug',
                'slug_helper' => 'Unique identifier used in the URL (no spaces or special characters).',
                'shown_in_footer' => 'Shown in Footer',
                'shown_in_footer_helper' => 'Enable to show this page in the site footer.',
                'is_tos' => 'Terms of Service',
                'is_tos_helper' => 'Enable if this page represents the Terms of Service.',
                'is_privacy' => 'Privacy Policy',
                'is_privacy_helper' => 'Enable if this page represents the Privacy Policy.',
                'show_last_update_date' => 'Show Last Update Date',
                'show_last_update_date_helper' => 'If enabled, shows the last modification date on the page.',
                'page_order' => 'Page Order',
                'page_order_helper' => 'Defines the order in which this page appears in listings.',
            ],

        ],

        'contact_message' => [
            'label' => 'Contact Message',
            'plural' => 'Contact Messages',

            'fields' => [
                'email' => 'Email',
                'subject' => 'Subject',
                'message' => 'Message',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
        ],

        'global_announcement' => [
            'label' => 'Announcement',
            'plural' => 'Announcements',

            'fields' => [
                'content' => 'Content',
                'size' => 'Size',
                'expiring_at' => 'Expiring At',
                'is_published' => 'Published',
                'is_dismissible' => 'Dismissible',
                'is_sticky' => 'Sticky',
                'is_global' => 'Global',
            ],

            'sections' => [
                'content' => 'Content',
                'content_descr' => 'Announcement details.',
                'visibility' => 'Visibility',
                'visibility_descr' => 'Enable/disable display behaviors.',
            ],

            'size_labels' => [
                'regular' => 'Regular',
                'small' => 'Small',
            ],
        ],

        'reward' => [
            'label'  => 'Referral',
            'plural' => 'Referrals',

            'sections' => [
                'referral_info'       => 'Referral Reward Info',
                'referral_info_descr' => 'Assign rewards generated from referral activity.',
            ],

            'fields' => [
                'id'                     => 'ID',
                'from_user_id'           => 'Referrer',
                'to_user_id'             => 'Referred User',
                'referral_code_usage_id' => 'Referral Code Usage',
                'amount'                 => 'Reward Amount',
                'transaction_id'         => 'Transaction ID',
                'reward_type'            => 'Reward Type',
            ],

            'help' => [
                'reward_type' => 'Type code for the reward.',
            ],
        ],


    ],

    'settings' => [
        'general' => 'General',
        'profiles' => 'Profiles',
        'feed' => 'Feed',
        'media' => 'Media',
        'storage' => 'Storage',
        'payments' => 'Payments',
        'websockets' => 'Websockets',
        'emails' => 'Emails',
        'social' => 'Social',
        'code_and_ads' => 'Code & ads',
        'streams' => 'Streams',
        'compliance' => 'Compliance',
        'security' => 'Security',
        'referrals' => 'Referrals',
        'ai' => 'AI',
        'admin' => 'Admin',
        'theme' => 'Theme',
        'license' => 'License',
    ],

];

