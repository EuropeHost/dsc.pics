<?php

return [
    'lander' => [
        'hero' => [
            'title' => 'Fast & Secure<br>Discord Image Hosting',
            'subtitle' => 'Share your images and links instantly with your Discord community',
            'login_button' => 'Login with Discord',
            'dashboard_button' => 'Go to Dashboard',
            'feature_fast_title' => 'Lightning Fast',
            'feature_fast_desc' => 'Upload and share in seconds with our optimized infrastructure',
            'feature_secure_title' => 'Secure & Private',
            'feature_secure_desc' => 'Your content is protected with enterprise-grade security',
        ],
        'stats' => [
            'title' => 'Platform Statistics',
            'subtitle' => 'Real-time insights into our growing community',
            'users' => 'Users',
            'media' => 'Media Files',
            'links' => 'Short Links',
            'media_views' => 'Media Views',
            'link_views' => 'Link Views',
            'storage' => 'Storage Used',
            'total' => 'Total',
            'this_month' => 'This Month',
            'this_week' => 'This Week',
        ],
        'features' => [
            'title' => 'Powerful Features',
            'subtitle' => 'Everything you need to share and manage your content',
            'storage_limit' => [
                'title' => 'Generous Storage',
                'description' => 'Get :amount MB of free storage per user to host your media files',
            ],
            'instant_upload' => [
                'title' => 'Instant Uploads',
                'description' => 'Lightning-fast upload speeds ensure your content is shared immediately',
            ],
            'discord_integration' => [
                'title' => 'Discord Integration',
                'description' => 'Seamlessly integrated with Discord for effortless authentication',
            ],
            'short_links' => [
                'title' => 'Link Shortener',
                'description' => 'Create short, memorable links to share anywhere',
            ],
            'free' => [
                'title' => 'Free Forever',
                'description' => 'No hidden fees, no subscriptions. Completely free to use',
            ],
            'analytics' => [
                'title' => 'View Analytics',
                'description' => 'Track views and engagement on your shared content',
            ],
        ],
        'faq' => [
            'title' => 'Frequently Asked Questions',
            'subtitle' => 'Everything you need to know about our platform',
            'questions' => [
                [
                    'question' => 'How much storage do I get?',
                    'answer' => 'Each user gets ' . env('USER_STORAGE_LIMIT', 100) . ' MB of free storage to host their media files. This is perfect for sharing screenshots, images, and other content with your Discord community.',
                ],
                [
                    'question' => 'Is it really free?',
                    'answer' => 'Yes! Our platform is completely free to use with no hidden fees or subscriptions. We believe in providing quality service without any cost barriers.',
                ],
                [
                    'question' => 'What file types are supported?',
                    'answer' => 'We support all common image formats including PNG, JPG, GIF, and WebP. Video files and other media types are also supported up to your storage limit.',
                ],
                [
                    'question' => 'How do I get started?',
                    'answer' => 'Simply click the "Login with Discord" button and authorize our application. Once logged in, you can immediately start uploading and sharing your content.',
                ],
                [
                    'question' => 'Are my files private?',
                    'answer' => 'By default, your Media are set to Private, but you can choose to show it in "recent Uploads". Your files are only accessible via the unique links you share. We take privacy seriously and implement industry-standard security measures to protect your content.',
                ],
                [
                    'question' => 'Can I delete my files?',
                    'answer' => 'Yes! You have full control over your content. You can delete any file at any time from your dashboard, and it will be permanently removed from our servers.',
                ],
            ],
        ],
    ],

    'legal' => [
        'cookies-notice' => [
            'content' => 'This website uses cookies to ensure you get the best experience on our website.'
        ]
    ],

    'errors' => [
        'go_home' => 'Go Home',
        '401' => [
            'title' => 'Unauthorized',
            'subtitle' => 'You need to log in to access this page.',
        ],
        '403' => [
            'title' => 'Access Denied',
            'subtitle' => 'You do not have permission to access this resource.',
        ],
        '404' => [
            'title' => 'Page Not Found',
            'subtitle' => 'The page you are looking for does not exist.',
        ],
        '405' => [
            'title' => 'Method Not Allowed',
            'subtitle' => 'The method is not allowed for the requested URL.',
        ],
        '419' => [
            'title' => 'Page Expired',
            'subtitle' => 'The page has expired due to inactivity. Please refresh and try again.',
        ],
        '429' => [
            'title' => 'Too Many Requests',
            'subtitle' => 'You have sent too many requests in a given amount of time. Please try again later.',
        ],
        '500' => [
            'title' => 'Server Error',
            'subtitle' => 'Something went wrong on our end. Please try again later.',
        ],
        '503' => [
            'title' => 'Service Unavailable',
            'subtitle' => 'Our services are temporarily unavailable. Please try again shortly.',
        ],
    ],
];