<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class StorageSettings extends Settings
{
    public string $driver;

    public ?string $aws_access_key;

    public ?string $aws_secret_key;

    public ?string $aws_region;

    public ?string $aws_bucket_name;

    public ?string $aws_cdn_enabled;

    public ?string $aws_cdn_presigned_urls_enabled;

    public ?string $aws_cdn_key_pair_id;

    public ?string $aws_cdn_private_key_path;

    public ?string $cdn_domain_name;

    public ?string $was_access_key;

    public ?string $was_secret_key;

    public ?string $was_region;

    public ?string $was_bucket_name;

    public ?string $do_access_key;

    public ?string $do_secret_key;

    public ?string $do_region;

    public ?string $do_bucket_name;

    public ?string $minio_access_key;

    public ?string $minio_secret_key;

    public ?string $minio_region;

    public ?string $minio_bucket_name;

    public ?string $minio_endpoint;

    public ?string $pushr_access_key;

    public ?string $pushr_secret_key;

    public ?string $pushr_cdn_hostname;

    public ?string $pushr_bucket_name;

    public ?string $pushr_endpoint;

    public static function group(): string
    {
        return 'storage';
    }
}
