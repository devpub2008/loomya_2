<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ProfilesSettings extends Settings
{
    public bool $allow_profile_qr_code;

    public bool $allow_gender_pronouns;

    public string $default_profile_type_on_register;

    public ?string $default_users_to_follow;

    public string $default_user_privacy_setting_on_register;

    public bool $allow_users_enabling_open_profiles;

    public ?int $default_wallet_balance_on_register;

    public bool $allow_profile_bio_markdown;

    public bool $disable_profile_bio_excerpt;

    public ?int $max_profile_bio_length;

    public bool $enable_new_post_notification_setting;

    public bool $default_new_post_notification_setting;

    public bool $disable_website_link_on_profile;

    public bool $disable_profile_offers;

    public bool $allow_hyperlinks;

    public bool $show_online_users_indicator;

    public bool $record_users_last_activity_time;

    public bool $record_users_last_ip_address;

    public static function group(): string
    {
        return 'profiles';
    }
}
