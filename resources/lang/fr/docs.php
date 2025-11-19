<?php

return [
    'api' => [
        'API v1' => [
            'Global Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v1/stats/global',
                    'description' => 'Obtenir les statistiques globales de la plateforme. Accessible publiquement.',
                    'request' => 'Aucune authentification requise.',
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
                    'description' => 'Tous les points de terminaison authentifiés de l\'API v2 nécessitent un jeton `Bearer` (Sanctum) avec les capacités appropriées.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => 'Réponse JSON standard de succès/erreur.',
                ],
            ],
            'Global Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats',
                    'description' => 'Obtenir les statistiques générales de la plateforme.',
                    'request' => 'Aucune authentification requise.',
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
    "message": "Statistiques récupérées avec succès."
}
JSON,
                ],
            ],
            'User Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/users',
                    'description' => 'Obtenir les statistiques de création d\'utilisateurs regroupées par jour.',
                    'request' => 'Aucune authentification requise.',
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
    "message": "Statistiques utilisateur récupérées avec succès."
}
JSON,
                ],
            ],
            'Media Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/media',
                    'description' => 'Obtenir les statistiques des médias, y compris les téléchargements quotidiens, les types et la visibilité.',
                    'request' => 'Aucune authentification requise.',
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
    "message": "Statistiques média récupérées avec succès."
}
JSON,
                ],
            ],
            'Link Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/stats/links',
                    'description' => 'Obtenir les statistiques de création et de consultation de liens regroupées par jour.',
                    'request' => 'Aucune authentification requise.',
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
    "message": "Statistiques de liens récupérées avec succès."
}
JSON,
                ],
            ],
            'User-Specific Statistics' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/user/stats',
                    'description' => 'Obtenir les statistiques de l\'utilisateur authentifié.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `user:stats`.',
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
    "message": "Statistiques utilisateur récupérées avec succès."
}
JSON,
                ],
            ],
            'Media Endpoints' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/media',
                    'description' => 'Obtenir une liste paginée des médias appartenant à l\'utilisateur authentifié.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `media:read`.',
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
    "message": "Médias récupérés avec succès."
}
JSON,
                ],
                [
                    'method' => 'POST',
                    'route' => '/api/v2/media',
                    'description' => 'Télécharger un nouveau fichier média.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `media:create`.',
                    'request' => <<<TEXT
Content-Type: multipart/form-data
Authorization: Bearer <token>

file: (données de fichier binaire)
is_public: (booléen, optionnel)
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
    "message": "Média téléchargé avec succès."
}
JSON,
                ],
                [
                    'method' => 'GET',
                    'route' => '/api/v2/media/{media}',
                    'description' => 'Obtenir les détails d\'un élément média spécifique appartenant à l\'utilisateur authentifié.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `media:read`.',
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
    "message": "Média récupéré avec succès."
}
JSON,
                ],
                [
                    'method' => 'DELETE',
                    'route' => '/api/v2/media/{media}',
                    'description' => 'Supprimer un élément média spécifique appartenant à l\'utilisateur authentifié.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `media:delete`.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": [],
    "message": "Média supprimé avec succès."
}
JSON,
                ],
            ],
            'Link Endpoints' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/links',
                    'description' => 'Obtenir une liste paginée des liens appartenant à l\'utilisateur authentifié. Inclut le nombre de vues.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `links:read`.',
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
    "message": "Liens récupérés avec succès."
}
JSON,
                ],
                [
                    'method' => 'POST',
                    'route' => '/api/v2/links',
                    'description' => 'Créer un nouveau lien court pour l\'utilisateur authentifié.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `links:create`.',
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
    "message": "Lien créé avec succès."
}
JSON,
                ],
                [
                    'method' => 'GET',
                    'route' => '/api/v2/links/{link}',
                    'description' => 'Obtenir les détails d\'un lien spécifique appartenant à l\'utilisateur authentifié. Inclut le nombre de vues.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `links:read`.',
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
    "message": "Lien récupéré avec succès."
}
JSON,
                ],
                [
                    'method' => 'DELETE',
                    'route' => '/api/v2/links/{link}',
                    'description' => 'Supprimer un lien spécifique appartenant à l\'utilisateur authentifié.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `links:delete`.',
                    'request' => 'Authorization: Bearer <token>',
                    'response' => <<<JSON
{
    "success": true,
    "data": [],
    "message": "Lien supprimé avec succès."
}
JSON,
                ],
            ],
            'Activity Log' => [
                [
                    'method' => 'GET',
                    'route' => '/api/v2/activity',
                    'description' => 'Obtenir une liste paginée des journaux d\'activités pour l\'utilisateur authentifié.',
                    'authentication' => 'Nécessite le middleware `auth:sanctum` avec la capacité `activity:read`.',
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
    "message": "Journaux d\'activités récupérés avec succès."
}
JSON,
                ],
            ],
        ],
    ],
];