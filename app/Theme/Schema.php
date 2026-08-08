<?php

declare(strict_types=1);

namespace WildTours\Base\Theme;

defined('ABSPATH') || exit;

/**
 * Outputs JSON-LD structured data.
 *
 * Organization / WebSite markup is rendered globally; BreadcrumbList on
 * singular and archive views; FAQPage when the FAQ component data is
 * available. The companion plugin owns TouristTrip markup on pwt_* posts,
 * so it is not duplicated here.
 *
 * @package WildTours\Base
 */
final class Schema
{
    /**
     * Boot schema output.
     */
    public function boot(): void
    {
        add_action(
            'wp_head',
            [$this, 'render'],
            20
        );
    }

    /**
     * Render the JSON-LD graph.
     */
    public function render(): void
    {
        $graph = $this->graph();

        /**
         * Allow child themes and plugins to reshape the schema graph.
         */
        $graph = (array) apply_filters(
            'wildtours/base/schema',
            $graph
        );

        if ($graph === []) {
            return;
        }

        $data = [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];

        printf(
            "<script type=\"application/ld+json\">%s</script>\n",
            wp_json_encode(
                $data,
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            )
        );
    }

    /**
     * Build the graph.
     *
     * @return array<int,array<string,mixed>>
     */
    private function graph(): array
    {
        $graph = [];

        $graph[] = $this->organization();

        $graph[] = $this->webSite();

        if (is_singular()) {
            $graph[] = $this->breadcrumbs();
        } elseif (is_archive() || is_search()) {
            $graph[] = $this->breadcrumbs();
        }

        if (is_singular(['pwt_safari', 'pwt_package'])) {
            $faq = $this->faq((int) get_queried_object_id());

            if ($faq !== null) {
                $graph[] = $faq;
            }
        }

        return $graph;
    }

    /**
     * Travel agency organization node.
     *
     * @return array<string,mixed>
     */
    private function organization(): array
    {
        $settings = [];

        if (function_exists('get_option')) {
            $settings = (array) get_option('pwt_settings', []);
        }

        $name = $settings['company_name'] ?? get_bloginfo('name');
        $phone = (string) get_theme_mod('contact_phone', '');
        $email = (string) get_theme_mod('contact_email', '');

        $sameAs = [];

        foreach (['facebook', 'instagram', 'youtube', 'twitter', 'linkedin'] as $network) {
            $url = (string) get_theme_mod("social_{$network}", '');

            if ($url !== '') {
                $sameAs[] = $url;
            }
        }

        $node = [
            '@type' => 'TravelAgency',
            '@id' => home_url('/#organization'),
            'name' => (string) $name,
            'url' => home_url('/'),
            'description' => (string) get_bloginfo('description'),
            'image' => (string) get_site_icon_url(),
        ];

        if ($phone !== '' || $email !== '') {
            $node['contactPoint'] = [
                '@type' => 'ContactPoint',
                'contactType' => 'customer support',
                'telephone' => $phone,
                'email' => $email,
                'availableLanguage' => ['en', 'hi'],
            ];
        }

        if ($sameAs !== []) {
            $node['sameAs'] = $sameAs;
        }

        return $node;
    }

    /**
     * WebSite node with search action.
     *
     * @return array<string,mixed>
     */
    private function webSite(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => home_url('/#website'),
            'name' => get_bloginfo('name'),
            'url' => home_url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => home_url('/?s={search_term_string}'),
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * BreadcrumbList node.
     *
     * @return array<string,mixed>
     */
    private function breadcrumbs(): array
    {
        $items = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => __('Home', 'wildtours-base'),
                'item' => home_url('/'),
            ],
        ];

        if (is_singular()) {
            $post = get_queried_object();

            if ($post instanceof \WP_Post) {
                $postType = get_post_type_object($post->post_type);

                if ($postType instanceof \WP_Post_Type) {
                    $archive = get_post_type_archive_link($post->post_type);

                    if ($archive) {
                        $items[] = [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => $postType->labels->name,
                            'item' => $archive,
                        ];
                    }
                }

                $items[] = [
                    '@type' => 'ListItem',
                    'position' => count($items) + 1,
                    'name' => get_the_title($post),
                ];
            }
        } elseif (is_post_type_archive()) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => post_type_archive_title('', false),
            ];
        }

        return [
            '@type' => 'BreadcrumbList',
            '@id' => get_permalink() . '#breadcrumb',
            'itemListElement' => $items,
        ];
    }

    /**
     * FAQPage node built from the FAQ component data.
     *
     * @return array<string,mixed>|null
     */
    private function faq(int $postId): ?array
    {
        $items = (array) apply_filters(
            'wildtours/base/faq/items',
            []
        );

        if ($items === []) {
            return null;
        }

        $mainEntity = [];

        foreach ($items as $item) {
            $question = (string) ($item['question'] ?? '');
            $answer = (string) ($item['answer'] ?? '');

            if ($question === '' || $answer === '') {
                continue;
            }

            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => wp_strip_all_tags($answer),
                ],
            ];
        }

        if ($mainEntity === []) {
            return null;
        }

        return [
            '@type' => 'FAQPage',
            '@id' => get_permalink($postId) . '#faq',
            'mainEntity' => $mainEntity,
        ];
    }
}
