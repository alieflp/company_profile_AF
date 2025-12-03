<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Company Information
            [
                'key' => 'company_name',
                'value' => 'AF Web Design & Technology Needs',
                'type' => 'string',
                'group' => 'company'
            ],
            [
                'key' => 'company_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'company'
            ],
            [
                'key' => 'company_tagline',
                'value' => 'Transforming Ideas Into Digital Reality',
                'type' => 'string',
                'group' => 'company'
            ],
            [
                'key' => 'company_description',
                'value' => 'We are a team of passionate technologists dedicated to delivering exceptional IT solutions that drive business growth.',
                'type' => 'text',
                'group' => 'company'
            ],
            
            // Hero Section
            [
                'key' => 'hero_title',
                'value' => 'Transformasi Digital Dimulai dari Sini',
                'type' => 'string',
                'group' => 'hero'
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Solusi IT terintegrasi untuk mengakselerasi bisnis Anda. Dari web development, cloud infrastructure, hingga digital transformation consulting.',
                'type' => 'text',
                'group' => 'hero'
            ],
            
            // Statistics
            [
                'key' => 'stat_projects',
                'value' => '50+',
                'type' => 'string',
                'group' => 'stats'
            ],
            [
                'key' => 'stat_satisfaction',
                'value' => '98%',
                'type' => 'string',
                'group' => 'stats'
            ],
            [
                'key' => 'stat_support',
                'value' => '24/7',
                'type' => 'string',
                'group' => 'stats'
            ],
            [
                'key' => 'stat_experience',
                'value' => '15+',
                'type' => 'string',
                'group' => 'stats'
            ],
            [
                'key' => 'stat_clients',
                'value' => '200+',
                'type' => 'string',
                'group' => 'stats'
            ],
            [
                'key' => 'stat_total_projects',
                'value' => '500+',
                'type' => 'string',
                'group' => 'stats'
            ],
            
            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'info@afwebdesign.com',
                'type' => 'string',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_phone',
                'value' => '+62 812-3456-7890',
                'type' => 'string',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '+6281234567890',
                'type' => 'string',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_address',
                'value' => 'Jakarta, Indonesia',
                'type' => 'text',
                'group' => 'contact'
            ],
            
            // Social Media
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/afwebdesign',
                'type' => 'string',
                'group' => 'social'
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/afwebdesign',
                'type' => 'string',
                'group' => 'social'
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/afwebdesign',
                'type' => 'string',
                'group' => 'social'
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/afwebdesign',
                'type' => 'string',
                'group' => 'social'
            ],
            [
                'key' => 'social_github',
                'value' => 'https://github.com/afwebdesign',
                'type' => 'string',
                'group' => 'social'
            ],
            [
                'key' => 'social_youtube',
                'value' => '',
                'type' => 'string',
                'group' => 'social'
            ],
            
            // Footer Information
            [
                'key' => 'footer_about',
                'value' => 'AF Web Design is a leading IT solutions provider specializing in web development, cloud infrastructure, and digital transformation consulting.',
                'type' => 'text',
                'group' => 'footer'
            ],
            [
                'key' => 'footer_copyright',
                'value' => '© 2025 AF Web Design & Technology Needs. All rights reserved.',
                'type' => 'string',
                'group' => 'footer'
            ],
            
            // SEO & Meta
            [
                'key' => 'meta_keywords',
                'value' => 'web development, IT solutions, digital transformation, cloud computing, software development',
                'type' => 'text',
                'group' => 'seo'
            ],
            [
                'key' => 'meta_description',
                'value' => 'Professional IT solutions and web development services. Transform your business with our cutting-edge technology solutions.',
                'type' => 'text',
                'group' => 'seo'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
