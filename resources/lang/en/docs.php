<?php

return [
    'api' => [
        'API v1' => [
            'Global Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v1/stats/global',
                    'description' => 'Get global platform statistics. Accessible publicly.',
                    'request' => 'No authentication required.',
                    'response' => <<<JSON
{
    "global": {
        "total_users": 10,
        "total_media": 500,
        "total_links": 200,
        "total_storage_used_mb": 1024.56,
        "total_storage_limit_gib": 100.00,
        "storage_percentage": 1.0,
        "average_storage_per_user_mb": 102.46,
        "last_30_days": {
            "media": 50,
            "link_views": 150
        },
        "last_24_hours": {
            "media": 5,
            "link_views": 15
        }
    }
}
JSON,
                ],
            ],
        ],

        'API v2' => [
            'Authentication' => [
                [
                    'method' => 'INFO',
                    'route' => '',
                    'description' => 'All authenticated API v2 endpoints require a `Bearer` token (Sanctum) with appropriate abilities.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => 'Standard success/error JSON response.',
                ],
            ],
            'Global Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats',
                    'description' => 'Get general platform statistics.',
                    'request' => 'No authentication required.',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "users": {
            "total": 10
        },
        "media": {
            "total": 500,
            "total_views": 1200,
            "storage_used_bytes": 1073741824
        },
        "links": {
            "total": 200,
            "total_views": 5000
        }
    },
    "message": "Statistics retrieved successfully."
}
JSON,
                ],
            ],
            'User Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/users',
                    'description' => 'Get user creation statistics grouped by day.',
                    'request' => 'No authentication required.',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "by_day": [
            {
                "date": "2023-01-01",
                "count": 2
            },
            {
                "date": "2023-01-02",
                "count": 3
            }
        ]
    },
    "message": "User statistics retrieved successfully."
}
JSON,
                ],
            ],
            'Media Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/media',
                    'description' => 'Get media statistics including daily uploads, types, and visibility.',
                    'request' => 'No authentication required.',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "by_day": [
            {
                "date": "2023-01-01",
                "count": 10
            },
            {
                "date": "2023-01-02",
                "count": 15
            }
        ],
        "by_type": [
            {
                "type": "image",
                "count": 400
            },
            {
                "type": "video",
                "count": 100
            }
        ],
        "by_visibility": {
            "public": 300,
            "private": 200
        }
    },
    "message": "Media statistics retrieved successfully."
}
JSON,
                ],
            ],
            'Link Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/links',
                    'description' => 'Get link creation and view statistics grouped by day.',
                    'request' => 'No authentication required.',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "creation_by_day": [
            {
                "date": "2023-01-01",
                "count": 5
            },
            {
                "date": "2023-01-02",
                "count": 8
            }
        ],
        "views_by_day": [
            {
                "date": "2023-01-01",
                "count": 20
            },
            {
                "date": "2023-01-02",
                "count": 35
            }
        ]
    },
    "message": "Link statistics retrieved successfully."
}
JSON,
                ],
            ],
            'User-Specific Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/user/stats',
                    'description' => 'Get statistics for the authenticated user.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `user:stats` ability.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "media_count": 50,
        "storage_used_bytes": 536870912,
        "links_count": 10,
        "link_views_count": 150
    },
    "message": "User statistics retrieved successfully."
}
JSON,
                ],
            ],
            'Media Endpoints' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/media',
                    'description' => 'Get a paginated list of media belonging to the authenticated user.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `media:read` ability.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": "c1f7a1f0-1a2b-4c3d-5e6f-7a8b9c0d1e2f",
                "user_id": 1,
                "filename": "some-image.png",
                "original_name": "MyImage.png",
                "mime": "image/png",
                "size": 123456,
                "is_public": true,
                "type": "image",
                "created_at": "2023-10-26T10:00:00.000000Z",
                "updated_at": "2023-10-26T10:00:00.000000Z"
            }
        ],
        "first_page_url": "...",
        "from": 1,
        "last_page": 1,
        "last_page_url": "...",
        "links": [],
        "next_page_url": null,
        "path": "...",
        "per_page": 15,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    },
    "message": "Media retrieved successfully."
}
JSON,
                ],
                [
                    'method' => 'POST',
                    'route' => '/api/v2/media',
                    'description' => 'Upload a new media file.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `media:create` ability.',
                    'request' => <<<TEXT
Content-Type: multipart/form-data
Authorization: Bearer <token>

file: (binary file data)
is_public: (boolean, optional)
TEXT,
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "id": "c1f7a1f0-1a2b-4c3d-5e6f-7a8b9c0d1e2f",
        "user_id": 1,
        "filename": "another-image.jpeg",
        "original_name": "NewPhoto.jpeg",
        "mime": "image/jpeg",
        "size": 789012,
        "is_public": false,
        "type": "image",
        "created_at": "2023-10-26T10:30:00.000000Z",
        "updated_at": "2023-10-26T10:30:00.000000Z"
    },
    "message": "Media uploaded successfully."
}
JSON,
                ],
                [
                    'method' => 'GET',
                    'route' => '/api/v2/media/{media}',
                    'description' => 'Get details for a specific media item belonging to the authenticated user.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `media:read` ability.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "id": "c1f7a1f0-1a2b-4c3d-5e6f-7a8b9c0d1e2f",
        "user_id": 1,
        "filename": "some-image.png",
        "original_name": "MyImage.png",
        "mime": "image/png",
        "size": 123456,
        "is_public": true,
        "type": "image",
        "created_at": "2023-10-26T10:00:00.000000Z",
        "updated_at": "2023-10-26T10:00:00.000000Z"
    },
    "message": "Media retrieved successfully."
}
JSON,
                ],
                [
                    'method' => 'DELETE',
                    'route' => '/api/v2/media/{media}',
                    'description' => 'Delete a specific media item belonging to the authenticated user.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `media:delete` ability.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": [],
    "message": "Media deleted successfully."
}
JSON,
                ],
            ],
            'Link Endpoints' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/links',
                    'description' => 'Get a paginated list of links belonging to the authenticated user. Includes view count.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `links:read` ability.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": "a1b2c3d4-e5f6-7a8b-9c0d-1e2f3a4b5c6d",
                "user_id": 1,
                "original_url": "https://example.com",
                "slug": "my-short-link",
                "created_at": "2023-10-26T11:00:00.000000Z",
                "updated_at": "2023-10-26T11:00:00.000000Z",
                "views_count": 50
            }
        ],
        "first_page_url": "...",
        "from": 1,
        "last_page": 1,
        "last_page_url": "...",
        "links": [],
        "next_page_url": null,
        "path": "...",
        "per_page": 15,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    },
    "message": "Links retrieved successfully."
}
JSON,
                ],
                [
                    'method' => 'POST',
                    'route' => '/api/v2/links',
                    'description' => 'Create a new short link for the authenticated user.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `links:create` ability.',
                    'request' => <<<JSON
{
    "original_url": "https://www.google.com",
    "slug": "custom-google-link"
}
JSON,
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "user_id": 1,
        "original_url": "https://www.google.com",
        "slug": "custom-google-link",
        "updated_at": "2023-10-26T11:15:00.000000Z",
        "created_at": "2023-10-26T11:15:00.000000Z",
        "id": "d1e2f3a4-b5c6-7d8e-9f0a-1b2c3d4e5f6a"
    },
    "message": "Link created successfully."
}
JSON,
                ],
                [
                    'method' => 'GET',
                    'route' => '/api/v2/links/{link}',
                    'description' => 'Get details for a specific link belonging to the authenticated user. Includes view count.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `links:read` ability.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "id": "a1b2c3d4-e5f6-7a8b-9c0d-1e2f3a4b5c6d",
        "user_id": 1,
        "original_url": "https://example.com",
        "slug": "my-short-link",
        "created_at": "2023-10-26T11:00:00.000000Z",
        "updated_at": "2023-10-26T11:00:00.000000Z",
        "views_count": 50
    },
    "message": "Link retrieved successfully."
}
JSON,
                ],
                [
                    'method' => 'DELETE',
                    'route' => '/api/v2/links/{link}',
                    'description' => 'Delete a specific link belonging to the authenticated user.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `links:delete` ability.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": [],
    "message": "Link deleted successfully."
}
JSON,
                ],
            ],
            'Activity Log' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/activity',
                    'description' => 'Get a paginated list of activity logs for the authenticated user.',
                    'authentication' => 'Requires `auth:sanctum` middleware with `activity:read` ability.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": "e1f2a3b4-c5d6-7e8f-9a0b-1c2d3e4f5a6b",
                "user_id": 1,
                "description": "Logged in",
                "ip_address": "192.168.1.1",
                "user_agent": "Mozilla/5.0 ...",
                "created_at": "2023-10-26T09:00:00.000000Z",
                "updated_at": "2023-10-26T09:00:00.000000Z"
            }
        ],
        "first_page_url": "...",
        "from": 1,
        "last_page": 1,
        "last_page_url": "...",
        "links": [],
        "next_page_url": null,
        "path": "...",
        "per_page": 15,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    },
    "message": "Activity logs retrieved successfully."
}
JSON,
                ],
            ],
        ],
    ],
];