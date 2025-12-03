<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Web Development',
                'slug' => 'web-development',
                'excerpt' => 'Build modern, responsive websites that drive business growth',
                'description' => 'We create stunning, high-performance websites using the latest technologies. From simple landing pages to complex web applications, our team delivers solutions that exceed expectations.',
                'icon_type' => 'code',
                'icon_color' => 'blue',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'excerpt' => 'Native and cross-platform mobile applications',
                'description' => 'Transform your ideas into powerful mobile applications for iOS and Android. We build user-friendly apps that engage your audience and drive results.',
                'icon_type' => 'mobile',
                'icon_color' => 'purple',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Cloud Computing Solutions',
                'slug' => 'cloud-computing',
                'excerpt' => 'Scalable cloud infrastructure and migration services',
                'description' => 'Migrate your business to the cloud with our expert guidance. We provide cloud architecture, deployment, and management services across AWS, Azure, and Google Cloud.',
                'icon_type' => 'cloud',
                'icon_color' => 'cyan',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'excerpt' => 'Create intuitive and beautiful user experiences',
                'description' => 'Design matters. Our UI/UX experts create interfaces that are not only beautiful but also intuitive and user-friendly, ensuring maximum engagement and satisfaction.',
                'icon_type' => 'ui-ux',
                'icon_color' => 'pink',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Cybersecurity Services',
                'slug' => 'cybersecurity',
                'excerpt' => 'Protect your business from digital threats',
                'description' => 'Stay secure with our comprehensive cybersecurity solutions. From vulnerability assessments to penetration testing and security monitoring, we keep your data safe.',
                'icon_type' => 'security',
                'icon_color' => 'red',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'AI & Machine Learning',
                'slug' => 'ai-machine-learning',
                'excerpt' => 'Harness the power of artificial intelligence',
                'description' => 'Leverage AI and machine learning to automate processes, gain insights, and make data-driven decisions. We build custom AI solutions tailored to your business needs.',
                'icon_type' => 'ai',
                'icon_color' => 'indigo',
                'is_active' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'IT Consulting',
                'slug' => 'it-consulting',
                'excerpt' => 'Strategic technology guidance for your business',
                'description' => 'Get expert advice on technology strategy, digital transformation, and IT infrastructure. Our consultants help you make informed decisions that drive growth.',
                'icon_type' => 'consulting',
                'icon_color' => 'orange',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'DevOps & CI/CD',
                'slug' => 'devops-cicd',
                'excerpt' => 'Streamline your development and deployment',
                'description' => 'Implement modern DevOps practices and CI/CD pipelines to accelerate delivery, improve quality, and reduce costs. Automate everything from testing to deployment.',
                'icon_type' => 'devops',
                'icon_color' => 'green',
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
