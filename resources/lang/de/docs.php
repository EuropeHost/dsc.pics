<?php

return [
    'api' => [
        'API v1' => [
            'Global Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v1/stats/global',
                    'description' => 'Globale Plattformstatistiken abrufen. Öffentlich zugänglich.',
                    'request' => 'Keine Authentifizierung erforderlich.',
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
                    'description' => 'Alle authentifizierten API v2 Endpunkte erfordern einen `Bearer`-Token (Sanctum) mit entsprechenden Berechtigungen.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => 'Standardmäßige Erfolgs-/Fehler-JSON-Antwort.',
                ],
            ],
            'Global Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats',
                    'description' => 'Allgemeine Plattformstatistiken abrufen.',
                    'request' => 'Keine Authentifizierung erforderlich.',
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
    "message": "Statistiken erfolgreich abgerufen."
}
JSON,
                ],
            ],
            'User Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/users',
                    'description' => 'Benutzererstellungsstatistiken nach Tag gruppiert abrufen.',
                    'request' => 'Keine Authentifizierung erforderlich.',
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
    "message": "Benutzerstatistiken erfolgreich abgerufen."
}
JSON,
                ],
            ],
            'Media Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/media',
                    'description' => 'Medienstatistiken einschließlich täglicher Uploads, Typen und Sichtbarkeit abrufen.',
                    'request' => 'Keine Authentifizierung erforderlich.',
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
    "message": "Medienstatistiken erfolgreich abgerufen."
}
JSON,
                ],
            ],
            'Link Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/links',
                    'description' => 'Link-Erstellungs- und Aufrufstatistiken nach Tag gruppiert abrufen.',
                    'request' => 'Keine Authentifizierung erforderlich.',
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
    "message": "Link-Statistiken erfolgreich abgerufen."
}
JSON,
                ],
            ],
            'User-Specific Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/user/stats',
                    'description' => 'Statistiken für den authentifizierten Benutzer abrufen.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `user:stats` Berechtigung.',
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
    "message": "Benutzerstatistiken erfolgreich abgerufen."
}
JSON,
                ],
            ],
            'Media Endpoints' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/media',
                    'description' => 'Eine paginierte Liste der Medien des authentifizierten Benutzers abrufen.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `media:read` Berechtigung.',
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
    "message": "Medien erfolgreich abgerufen."
}
JSON,
                ],
                [
                    'method' => 'POST',
                    'route' => '/api/v2/media',
                    'description' => 'Eine neue Mediendatei hochladen.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `media:create` Berechtigung.',
                    'request' => <<<TEXT
Content-Type: multipart/form-data
Authorization: Bearer <token>

file: (binäre Dateidaten)
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
    "message": "Medien erfolgreich hochgeladen."
}
JSON,
                ],
                [
                    'method' => 'GET',
                    'route' => '/api/v2/media/{media}',
                    'description' => 'Details zu einem bestimmten Medienelement des authentifizierten Benutzers abrufen.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `media:read` Berechtigung.',
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
    "message": "Medien erfolgreich abgerufen."
}
JSON,
                ],
                [
                    'method' => 'DELETE',
                    'route' => '/api/v2/media/{media}',
                    'description' => 'Ein bestimmtes Medienelement des authentifizierten Benutzers löschen.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `media:delete` Berechtigung.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": [],
    "message": "Medien erfolgreich gelöscht."
}
JSON,
                ],
            ],
            'Link Endpoints' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/links',
                    'description' => 'Eine paginierte Liste der Links des authentifizierten Benutzers abrufen. Inklusive Aufrufe.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `links:read` Berechtigung.',
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
    "message": "Links erfolgreich abgerufen."
}
JSON,
                ],
                [
                    'method' => 'POST',
                    'route' => '/api/v2/links',
                    'description' => 'Einen neuen Kurzlink für den authentifizierten Benutzer erstellen.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `links:create` Berechtigung.',
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
    "message": "Link erfolgreich erstellt."
}
JSON,
                ],
                [
                    'method' => 'GET',
                    'route' => '/api/v2/links/{link}',
                    'description' => 'Details zu einem bestimmten Link des authentifizierten Benutzers abrufen. Inklusive Aufrufe.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `links:read` Berechtigung.',
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
    "message": "Link erfolgreich abgerufen."
}
JSON,
                ],
                [
                    'method' => 'DELETE',
                    'route' => '/api/v2/links/{link}',
                    'description' => 'Einen bestimmten Link des authentifizierten Benutzers löschen.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `links:delete` Berechtigung.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": [],
    "message": "Link erfolgreich gelöscht."
}
JSON,
                ],
            ],
            'Activity Log' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/activity',
                    'description' => 'Eine paginierte Liste der Aktivitätsprotokolle für den authentifizierten Benutzer abrufen.',
                    'authentication' => 'Erfordert `auth:sanctum` Middleware mit `activity:read` Berechtigung.',
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
    "message": "Aktivitätsprotokolle erfolgreich abgerufen."
}
JSON,
                ],
            ],
        ],
    ],
];