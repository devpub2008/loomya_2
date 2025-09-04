<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Settings\ManageAdminSettings;
use App\Filament\Pages\Settings\ManageAISettings;
use App\Filament\Pages\Settings\ManageCodeAndAdsSettings;
use App\Filament\Pages\Settings\ManageColorsSettings;
use App\Filament\Pages\Settings\ManageComplianceSettings;
use App\Filament\Pages\Settings\ManageEmailsSettings;
use App\Filament\Pages\Settings\ManageFeedSettings;
use App\Filament\Pages\Settings\ManageGeneralSettings;
use App\Filament\Pages\Settings\ManageLicenseSettings;
use App\Filament\Pages\Settings\ManageMediaSettings;
use App\Filament\Pages\Settings\ManagePaymentsSettings;
use App\Filament\Pages\Settings\ManageProfilesSettings;
use App\Filament\Pages\Settings\ManageReferralSettings;
use App\Filament\Pages\Settings\ManageSecuritySettings;
use App\Filament\Pages\Settings\ManageSocialSettings;
use App\Filament\Pages\Settings\ManageStorageSettings;
use App\Filament\Pages\Settings\ManageStreamsSettings;
use App\Filament\Pages\Settings\ManageWebsocketsSettings;
use App\Filament\Plugins\CustomHeaderLabelPlugin;
use App\Filament\Resources\AttachmentResource;
use App\Filament\Resources\ContactMessageResource;
use App\Filament\Resources\CountryResource;
use App\Filament\Resources\FeaturedUserResource;
use App\Filament\Resources\GlobalAnnouncementResource;
use App\Filament\Resources\InvoiceResource;
use App\Filament\Resources\NotificationResource;
use App\Filament\Resources\PaymentRequestResource;
use App\Filament\Resources\PollAnswerResource;
use App\Filament\Resources\PollResource;
use App\Filament\Resources\PollUserAnswerResource;
use App\Filament\Resources\PostCommentResource;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\PublicPageResource;
use App\Filament\Resources\ReactionResource;
use App\Filament\Resources\RewardResource;
use App\Filament\Resources\RoleResource;
use App\Filament\Resources\StreamMessageResource;
use App\Filament\Resources\StreamResource;
use App\Filament\Resources\SubscriptionResource;
use App\Filament\Resources\TaxResource;
use App\Filament\Resources\TransactionResource;
use App\Filament\Resources\UserBookmarkResource;
use App\Filament\Resources\UserListMemberResource;
use App\Filament\Resources\UserListResource;
use App\Filament\Resources\UserMessageResource;
use App\Filament\Resources\UserReportResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserTaxResource;
use App\Filament\Resources\UserVerifyResource;
use App\Filament\Resources\WalletResource;
use App\Filament\Resources\WithdrawalResource;
use App\Model\PollUserAnswer;
use App\Providers\AdminHelperProvider;
use App\Providers\InstallerServiceProvider;
use App\Providers\SettingsServiceProvider;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentLaravelLog\FilamentLaravelLogPlugin;
use App\Http\Middleware\LocaleSetter;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        // If the site is not installed, provision a fake admin
        // TODO: Review if really necessary
        if (!InstallerServiceProvider::checkIfInstalled()) {
            return Panel::make('admin')->id('admin');
        }

        // Local storage public url re-init, panel registration is done too early
        SettingsServiceProvider::setupLocalStorage();

        $panel = $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::Pink,
            ])
            ->brandName(getSetting('admin.title') ? getSetting('admin.title') : '')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->favicon(getSetting('site.favicon'))
            ->brandLogo(fn () => view('filament.partials.logo'))
            ->darkModeBrandLogo(fn () => view('filament.partials.logo-dark'))
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                LocaleSetter::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                FilamentLaravelLogPlugin::make()
                    ->authorize(fn () => auth()->user()->can('page_ViewLog')),
                new CustomHeaderLabelPlugin(),
            ])
            ->spa();
//            ->sidebarCollapsibleOnDesktop();

        $this->panelNavigation($panel);

        return $panel;

    }

    public function panelNavigation($panel) {

        $panel
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    // 1. Top-level items (outside any group)
                    ->items([
                        NavigationItem::make(__('admin.navigation.dashboard'))
                            ->icon('heroicon-o-home')
                            ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard'))
                            ->url(fn () => Dashboard::getUrl()),
                    ])

                    // 2. Grouped navigation
                    ->groups([
                        NavigationGroup::make()
                            ->icon('heroicon-o-users') // top-level category icon
                            ->label(__('admin.navigation.groups.users'))
                            ->items([
                                ...AdminHelperProvider::resourceNavIfCan(UserResource::class),
                                ...collect(AdminHelperProvider::resourceNavIfCan(RoleResource::class))
                                    ->map(fn ($item) => $item->badge(null))
                                    ->all(),
                                ...AdminHelperProvider::resourceNavIfCan(UserVerifyResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(WalletResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(NotificationResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(UserMessageResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(UserListResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(UserBookmarkResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(UserReportResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(FeaturedUserResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(UserTaxResource::class),
                            ]),

                        NavigationGroup::make()
                            ->label(__('admin.navigation.groups.posts'))
                            ->icon('heroicon-o-rectangle-stack')
                            ->items([
                                ...AdminHelperProvider::resourceNavIfCan(PostResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(PostCommentResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(AttachmentResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(PollResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(ReactionResource::class),
                            ])->collapsed(),

                        NavigationGroup::make()
                            ->label(__('admin.navigation.groups.finances'))
                            ->icon('heroicon-o-banknotes')
//                            heroicon-o-credit-card
                            ->items([
                                ...AdminHelperProvider::resourceNavIfCan(TransactionResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(SubscriptionResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(WithdrawalResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(PaymentRequestResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(RewardResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(InvoiceResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(TaxResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(CountryResource::class),
                            ])->collapsed(),

                        NavigationGroup::make()
                            ->label(__('admin.navigation.groups.streams'))
                            ->icon('heroicon-o-video-camera')
                            ->items([
                                ...AdminHelperProvider::resourceNavIfCan(StreamResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(StreamMessageResource::class),
                            ])->collapsed(),

                        NavigationGroup::make()
                            ->label(__('admin.navigation.groups.site'))
                            ->icon('heroicon-o-document')
                            ->items([
                                ...AdminHelperProvider::resourceNavIfCan(PublicPageResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(ContactMessageResource::class),
                                ...AdminHelperProvider::resourceNavIfCan(GlobalAnnouncementResource::class),
                            ])->collapsed(),

                        NavigationGroup::make()
                            ->label(__('admin.navigation.groups.settings'))
                            ->icon('heroicon-o-cog-6-tooth')
                            ->items(array_filter([
                                AdminHelperProvider::settingsNavItem(__('admin.settings.general'), '', 'page_ManageGeneralSettings', ManageGeneralSettings::getUrl(), ManageGeneralSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.profiles'), '', 'page_ManageProfilesSettings', ManageProfilesSettings::getUrl(), ManageProfilesSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.feed'), '', 'page_ManageFeedSettings', ManageFeedSettings::getUrl(), ManageFeedSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.media'), '', 'page_ManageMediaSettings', ManageMediaSettings::getUrl(), ManageMediaSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.storage'), '', 'page_ManageStorageSettings', ManageStorageSettings::getUrl(), ManageStorageSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.payments'), '', 'page_ManagePaymentsSettings', ManagePaymentsSettings::getUrl(), ManagePaymentsSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.websockets'), '', 'page_ManageWebsocketsSettings', ManageWebsocketsSettings::getUrl(), ManageWebsocketsSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.emails'), '', 'page_ManageEmailsSettings', ManageEmailsSettings::getUrl(), ManageEmailsSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.social'), '', 'page_ManageSocialSettings', ManageSocialSettings::getUrl(), ManageSocialSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.code_and_ads'), '', 'page_ManageCodeAndAdsSettings', ManageCodeAndAdsSettings::getUrl(), ManageCodeAndAdsSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.streams'), '', 'page_ManageStreamsSettings', ManageStreamsSettings::getUrl(), ManageStreamsSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.compliance'), '', 'page_ManageComplianceSettings', ManageComplianceSettings::getUrl(), ManageComplianceSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.security'), '', 'page_ManageSecuritySettings', ManageSecuritySettings::getUrl(), ManageSecuritySettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.referrals'), '', 'page_ManageReferralSettings', ManageReferralSettings::getUrl(), ManageReferralSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.ai'), '', 'page_ManageAISettings', ManageAISettings::getUrl(), ManageAISettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.admin'), '', 'page_ManageAdminSettings', ManageAdminSettings::getUrl(), ManageAdminSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.theme'), '', 'page_ManageColorsSettings', ManageColorsSettings::getUrl(), ManageColorsSettings::getRouteName()),

                                AdminHelperProvider::settingsNavItem(__('admin.settings.license'), '', 'page_ManageLicenseSettings', ManageLicenseSettings::getUrl(), ManageLicenseSettings::getRouteName()),
                            ]))
                            ->collapsed(),

                    ]);
            });

        return $panel;
    }
}
