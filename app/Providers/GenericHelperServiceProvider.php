<?php

namespace App\Providers;

use App\Filament\Resources\StreamResource;
use App\Filament\Resources\UserMessageResource;
use App\Filament\Resources\UserReportResource;
use App\Filament\Resources\UserResource;
use App\Model\GlobalAnnouncement;
use App\Model\PublicPage;
use App\Model\UserReport;
use App\Model\Wallet;
use App\Model\User;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;
use Mews\Purifier\Facades\Purifier;
use Pusher\Pusher;
use Ramsey\Uuid\Uuid;
use Cookie;

class GenericHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Check if user meets all ID verification steps.
     *
     * @return bool
     */
    public static function isUserVerified()
    {
        if (
            (Auth::user()->verification && Auth::user()->verification->status == 'verified') &&
            Auth::user()->birthdate &&
            Auth::user()->email_verified_at
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $contactUserID - Contacted users
     * @param $userID - User sending the message
     * @return bool
     */
    public static function hasUserBlocked($contactUserID, $userID) {
        $contactUser = User::where('id', $contactUserID)->first();
        $blockedUsers = ListsHelperServiceProvider::getListMembers($contactUser->lists->firstWhere('type', 'blocked')->id);
        if(in_array($userID, $blockedUsers)){
            return true;
        }
        return false;
    }

    /**
     * Creates a default wallet for a user.
     * @param $user
     */
    public static function createUserWallet($user)
    {
        try {
            $userWallet = Wallet::query()->where('user_id', $user->id)->first();
            if ($userWallet == null) {
                // generate unique id for wallet
                do {
                    $id = Uuid::uuid4()->getHex();
                } while (Wallet::query()->where('id', $id)->first() != null);

                $balance = 0.0;
                if(getSetting('profiles.default_wallet_balance_on_register') && getSetting('profiles.default_wallet_balance_on_register') != 0){
                    $balance = getSetting('profiles.default_wallet_balance_on_register');
                }
                Wallet::create([
                    'id' => $id,
                    'user_id' => $user->id,
                    'total' => $balance,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error('User wallet creation error: '.$exception->getMessage());
        }
    }

    /**
     * Static function that handles remote storage drivers.
     *
     * @param $value
     * @return string
     */
    public static function getStorageAvatarPath($value) {

        if($value && $value !== '/img/default-avatar.jpg'){
            return self::getFilePathByActiveStorageDriver($value);
        }else{
            return str_replace('storage/', '', asset('/img/default-avatar.jpg'));
        }
    }

    public static function getFilePathByActiveStorageDriver($value): string {
        if (getSetting('storage.driver') == 's3') {
            if (getSetting('storage.aws_cdn_enabled') && getSetting('storage.aws_cdn_presigned_urls_enabled')) {
                $fileUrl = AttachmentServiceProvider::signAPrivateDistributionPolicy(
                    'https://'.getSetting('storage.cdn_domain_name').'/'.$value
                );
            } elseif (getSetting('storage.aws_cdn_enabled')) {
                $fileUrl = 'https://'.getSetting('storage.cdn_domain_name').'/'.$value;
            } else {
                $fileUrl = 'https://'.getSetting('storage.aws_bucket_name').'.s3.'.getSetting('storage.aws_region').'.amazonaws.com/'.$value;
            }
            return $fileUrl;
        }
        elseif(getSetting('storage.driver') == 'wasabi' || getSetting('storage.driver') == 'do_spaces'){
            return Storage::url($value);
        }
        elseif(getSetting('storage.driver') == 'minio'){
            return rtrim(getSetting('storage.minio_endpoint'), '/').'/'.getSetting('storage.minio_bucket_name').'/'.$value;
        }
        elseif(getSetting('storage.driver') == 'pushr'){
            return rtrim(getSetting('storage.pushr_cdn_hostname'), '/').'/'.$value;
        }
        else{
            return Storage::disk('public')->url($value);
        }
    }

    /**
     * Static function that handles remote storage drivers.
     *
     * @param $value
     * @return string
     */
    public static function getStorageCoverPath($value) {
        if($value){
            return self::getFilePathByActiveStorageDriver($value);
        }else{
            return asset('/img/default-cover.png');
        }
    }

    /**
     * Helper to detect mobile usage.
     * @return bool
     */
    public static function isMobileDevice() {
        $agent = new Agent();
        return $agent->isMobile();
    }

    /**
     * Returns true if email enforce is not enabled or if is set to true and user is verified.
     * @return bool
     */
    public static function isEmailEnforcedAndValidated() {
        return (Auth::check() && Auth::user()->email_verified_at) || (Auth::check() && !getSetting('site.enforce_email_validation'));
    }

    public static function parseProfileMarkdownBio($bio) {
        if(getSetting('profiles.allow_profile_bio_markdown')){
            $parsedOutput = Purifier::clean(Markdown::convert($bio)->getContent());
            return $parsedOutput;
        }
        return $bio;
    }

    public static function parseSafeHTML($text) {
        return  Purifier::clean((str_replace("\n", "<br>", strip_tags($text))));
    }

    /**
     * Fetches list of all public pages to be show in footer.
     * @return mixed
     */
    public static function getFooterPublicPages() {
        $pages = [];
        if (InstallerServiceProvider::checkIfInstalled()) {
            $pages = PublicPage::where('shown_in_footer', 1)->orderBy('page_order')->get();
        }
        return $pages;
    }

    /**
     * Get Privacy page.
     * @return mixed
     */
    public static function getPrivacyPage() {
        try{
            return PublicPage::where('is_privacy', 1)->first();
        }
        catch (\Exception $e){
            return PublicPage::first();
        }
    }

    /**
     * Get TOS page.
     * @return mixed
     */
    public static function getTOSPage() {
        try{
            return PublicPage::where('is_tos', 1)->first();
        }
        catch (\Exception $e){
            return PublicPage::first();
        }
    }

    /*
    * Get Privacy page.
    * @return mixed
    */
    public static function getModelAgreementPage() {
        try{
            return PublicPage::where('slug', 'creator-agreement')->first();
        }
        catch (\Exception $e){
            return null;
        }
    }

    /**
     * Verifies if admin added a minimum posts limit for creators to earn money.
     * @param $user
     * @return bool
     */
    public static function creatorCanEarnMoney($user) {
        if(intval(getSetting("compliance.minimum_posts_until_creator")) > 0 && count($user->posts) < intval(getSetting('compliance.minimum_posts_until_creator'))){
            return false;
        }
        if(getSetting('compliance.monthly_posts_before_inactive') && !$user->is_active_creator){
            return false;
        }
        return true;
    }

    /**
     * Returns the preferred user local
     * TODO: This is only used in the payments module | Maybe delete it and use LocaleProvider based alternative.
     * @return \Illuminate\Config\Repository|mixed|null
     */
    public static function getPreferredLanguage() {
        // Defaults
        if (!Session::has('locale')) {
            if (InstallerServiceProvider::checkIfInstalled()) {
                return getSetting('site.default_site_language');
            } else {
                return Config::get('app.locale');
            }
        }
        // If user has locale setting, use that one
        if (isset(Auth::user()->settings['locale'])) {
            return Auth::user()->settings['locale'];
        }
        return getSetting('site.default_site_language');
    }

    /**
     * Fetches the default OGMeta image to be used (except for profile).
     * @return \Illuminate\Config\Repository|mixed|string|null
     */
    public static function getOGMetaImage() {
        if(getSetting('site.default_og_image')){
            return getSetting('site.default_og_image');
        }
        return asset('img/logo-black.png');
    }

    /**
     * Gets site direction. If rtl cookie not set, defaults to site setting.
     * @return \Illuminate\Config\Repository|mixed|null
     */
    public static function getSiteDirection() {
        if(is_null(Cookie::get('app_rtl'))){
            return getSetting('site.default_site_direction');
        }
        return Cookie::get('app_rtl');
    }

    public static function getSiteTheme() {
        $mode = Cookie::get('app_theme');
        if(!$mode){
            $mode = getSetting('site.default_user_theme');
        }
        return $mode;
    }

    public static function getLatestGlobalMessage() {
        if (!Schema::hasTable('global_announcements')) {
            // Return an empty collection or array if the table doesn't exist
            return null;
        }

        $messages = GlobalAnnouncement::all();
        $skippedIDs = [];

        foreach($messages as $message){
            if(request()->cookie('dismissed_banner_'.$message->id)){
                $skippedIDs[] = $message->id;
            }
        }

        $message = GlobalAnnouncement::orderBy('created_at', 'desc')
            ->where('is_published', 1)
            ->whereNotIn('id', $skippedIDs)
            ->first();

        return $message;
    }

    //TODO : Add soketi support?
    public static function isUserOnline($userId)
    {
        $pusherKey = config('broadcasting.connections.pusher.key');
        $pusherSecret = config('broadcasting.connections.pusher.secret');
        $pusherAppId = config('broadcasting.connections.pusher.app_id');
        $pusherCluster = config('broadcasting.connections.pusher.options.cluster');

        // If any critical Pusher config is missing, assume user is offline
        if (!$pusherKey || !$pusherSecret || !$pusherAppId || !$pusherCluster) {
            return false;
        }

        $pusher = new Pusher(
            $pusherKey,
            $pusherSecret,
            $pusherAppId,
            [
                'cluster' => $pusherCluster,
                'encrypted' => true,
            ]
        );

        try {
            $channelName = 'presence-global'; // Fixed shared channel
            $response = $pusher->get('/channels/'.$channelName.'/users');

            if (!empty($response->users)) {
                foreach ($response->users as $member) {
                    if ($member->id == $userId) {
                        return true; // User is online
                    }
                }
            }

            return false; // User not found = offline
        } catch (\Exception $exception) {
            return false; // Any errors = offline
        }
    }

    public static function getReportLinks(UserReport $report): array
    {
        try {
            if ($report->stream_id && $report->reportedStream) {
                return [
                    'admin' => StreamResource::getUrl('edit', ['record' => $report->stream_id]),
                    'public' => route('public.stream.get', [
                        'streamID' => $report->reportedStream->id,
                        'slug' => $report->reportedStream->slug,
                    ]),
                ];
            }

            if ($report->message_id) {
                return [
                    'admin' => UserMessageResource::getUrl('edit', ['record' => $report->message_id]),
                    'public' => null,
                ];
            }

            if ($report->post_id && $report->reportedUser) {
                return [
                    'admin' => UserReportResource::getUrl('edit', ['record' => $report->post_id]),
                    'public' => route('posts.get', [
                        'post_id' => $report->post_id,
                        'username' => $report->reportedUser->username,
                    ]),
                ];
            }

            if ($report->reporterUser && $report->reportedUser) {
                return [
                    'admin' => UserResource::getUrl('edit', ['record' => $report->user_id]),
                    'public' => route('profile', ['username' => $report->reportedUser->username]),
                ];
            }
        } catch (\Throwable $e) {
            // Optionally log the error
        }

        return [
            'admin' => null,
            'public' => null,
        ];
    }

    public static function resolveReportType(UserReport $report): string
    {
        if ($report->stream_id) {
            return 'Stream';
        }

        if ($report->message_id) {
            return 'Message';
        }

        if ($report->post_id) {
            return 'Post';
        }

        return 'User';
    }
}
