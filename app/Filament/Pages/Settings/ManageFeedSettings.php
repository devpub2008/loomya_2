<?php

namespace App\Filament\Pages\Settings;

use App\Filament\Traits\HasShieldPageAccess;
use App\Settings\FeedSettings;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Pages\SettingsPage;
use Filament\Forms\Form;

class ManageFeedSettings extends SettingsPage
{
    use HasShieldPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-rss';

    protected static ?string $slug = 'settings/feed';

    protected static string $settings = FeedSettings::class;

    protected static ?string $title = 'Feed Settings';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Tabs::make('Feed Settings')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->columns(2)
                            ->schema([
                                TextInput::make('min_post_description')->label('Min Post Description Length')->helperText('If set to 0 or left empty, at least one attachment is required per post. Any other value makes attachments optional.'),
                                TextInput::make('post_box_max_height')->label('Post Box Max Media Height')->helperText('Maximum height (in pixels) for media in post boxes. For example: 450. If set, images and videos will be cropped or scaled to this height when not viewed fullscreen.'),
                                TextInput::make('feed_posts_per_page')->label('Posts Per Page')->helperText('Number of posts shown per page in the feed.')->columnSpanFull(),

                                Toggle::make('allow_post_polls')
                                    ->helperText('When enabled, users can add polls to their posts.'),

                                Toggle::make('enable_post_description_excerpts')
                                    ->helperText('If enabled, long post descriptions will be truncated with a \'Show more\' link.'),

                                Toggle::make('allow_post_scheduling')
                                    ->helperText('When enabled, users can schedule posts with release and expiry dates'),

                                Toggle::make('disable_posts_text_preview')
                                    ->helperText('If enabled, text content in posts and messages will also be hidden behind the paywall.'),

                                Toggle::make('allow_gallery_zoom')
                                    ->helperText('If enabled, high-resolution photos in post galleries can be zoomed in and out during preview.'),
                            ]),

                        Tabs\Tab::make('Widgets')
                            ->columns(2)
                            ->schema([
                                Select::make('selected_widget')
                                    ->label('Widget')
                                    ->options([
                                        'suggestions' => 'Suggestions Slider',
                                        'expired' => 'Expired Subscriptions',
                                        'search' => 'Search Box',
                                    ])
                                    ->helperText('Select which widget you want to edit.')
                                    ->default('suggestions')
                                    ->columnSpanFull()
                                    ->reactive(),

                                // === Suggestions Slider ===

                                TextInput::make('feed_suggestions_card_per_page')
                                    ->label('Cards per Page')
                                    ->helperText('Number of suggested profiles shown at once in the slider.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'suggestions'),

                                TextInput::make('feed_suggestions_total_cards')
                                    ->label('Total Cards')
                                    ->helperText('Total number of suggestions fetched for the slider.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'suggestions'),

                                Toggle::make('hide_suggestions_slider')
                                    ->label('Hide Suggestions Slider')
                                    ->helperText('Hides the suggestions slider from the feed page when enabled.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'suggestions'),

                                Toggle::make('suggestions_skip_empty_profiles')
                                    ->helperText('Only shows profiles with both avatar and cover images.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'suggestions'),

                                Toggle::make('suggestions_skip_unverified_profiles')
                                    ->helperText('Show only verified profiles in suggestions.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'suggestions'),

                                Toggle::make('suggestions_use_featured_users_list')
                                    ->helperText('Limit suggestions to users marked as featured.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'suggestions'),

                                Toggle::make('feed_suggestions_autoplay')
                                    ->label('Autoplay Suggestions')
                                    ->helperText('Automatically scrolls through suggested profiles in the slider.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'suggestions'),

                                // === Expired Subs Widget ===

                                TextInput::make('expired_subs_widget_card_per_page')
                                    ->label('Cards per Page')
                                    ->helperText('Number of expired subscriptions shown at once.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'expired'),

                                TextInput::make('expired_subs_widget_total_cards')
                                    ->label('Total Cards')
                                    ->helperText('Total number of expired subscriptions loaded into the widget.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'expired'),

                                Toggle::make('expired_subs_widget_hide')
                                    ->label('Hide Expired Subs Box')
                                    ->helperText('Hides the expired subscriptions widget from view.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'expired'),

                                Toggle::make('expired_subs_widget_autoplay')
                                    ->helperText('Automatically scrolls through expired subscription cards.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'expired'),

                                // === Search Widget ===
                                Toggle::make('search_widget_hide')
                                    ->label('Hide Search Widget')
                                    ->helperText('Removes the search widget from the feed when enabled.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'search'),

                                Toggle::make('hide_non_verified_users_from_search')
                                    ->label('Hide Unverified Users in Search')
                                    ->helperText('Prevents unverified profiles from appearing in search results.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'search'),

                                Select::make('default_search_widget_filter')
                                    ->label('Search Filter Default')
                                    ->options([
                                        'live' => 'Live',
                                        'top' => 'Top',
                                        'people' => 'People',
                                        'videos' => 'Videos',
                                        'photos' => 'Photos',
                                    ])
                                    ->helperText('Sets the default filter applied to search results.')
                                    ->visible(fn ($get) => $get('selected_widget') === 'search'),
                            ]),

                    ]),
            ]);
    }
}
