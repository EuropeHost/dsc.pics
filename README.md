# dsc.pics
https://dsc.pics
## FREE Laravel Discord Media-Host and Link-Shortener

with Open API

---
create your discord application at https://discord.com/developers/applications
---
requires php `8.2` or newer

You will have to change `upload_max_filesize` and `post_max_size` in your `php.ini` file.
You must run `php artisan storage:link` to enable the internal storage.

### Toast Notification Examples

These examples demonstrate how to use the `window.showToast` function to display various types of notifications,
with and without custom durations.

```javascript
// Display a success toast with default duration (5000ms)
window.showToast('success', 'Operation completed successfully!');

// Display an error toast with a custom duration of 3 seconds (3000ms)
window.showToast('error', 'An unexpected error occurred.', 3000);

// Display a warning toast with default duration (5000ms)
window.showToast('warning', 'Please review your input before proceeding.');

// Display an info toast with a custom duration of 10 seconds (10000ms)
window.showToast('info', 'New update available. Click here for details.', 10000);

// Another success toast with a very short duration of 1.5 seconds (1500ms)
window.showToast('success', 'Item saved!', 1500);
```

### API-Docs

### /api/v1

#### Global Statistics

`GET /api/v1/stats/global`

**Description:** Get global platform statistics. Accessible publicly.

**Request:**

```text
No authentication required.
```

**Response:**

```json
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
```

### /api/v2

#### Authentication

All authenticated API v2 endpoints require a `Bearer` token (Sanctum) with appropriate abilities.

#### Global Statistics

`GET /api/v2/stats`

**Description:** Get general platform statistics.

**Request:**

```text
No authentication required.
```

**Response:**

```json
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
```

#### User Statistics

`GET /api/v2/stats/users`

**Description:** Get user creation statistics grouped by day.

**Request:**

```text
No authentication required.
```

**Response:**

```json
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
```

#### Media Statistics

`GET /api/v2/stats/media`

**Description:** Get media statistics including daily uploads, types, and visibility.

**Request:**

```text
No authentication required.
```

**Response:**

```json
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
```

#### Link Statistics

`GET /api/v2/stats/links`

**Description:** Get link creation and view statistics grouped by day.

**Request:**

```text
No authentication required.
```

**Response:**

```json
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
```

#### User-Specific Statistics

`GET /api/v2/user/stats`

**Description:** Get statistics for the authenticated user.

**Authentication:** Requires `auth:sanctum` middleware with `user:stats` ability.

**Request:**

```text
Authorization: Bearer <token>
```

**Response:**

```json
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
```

#### Media Endpoints

##### List User Media

`GET /api/v2/media`

**Description:** Get a paginated list of media belonging to the authenticated user.

**Authentication:** Requires `auth:sanctum` middleware with `media:read` ability.

**Request:**

```text
Authorization: Bearer <token>
```

**Response:**

```json
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
```

##### Upload Media

`POST /api/v2/media`

**Description:** Upload a new media file.

**Authentication:** Requires `auth:sanctum` middleware with `media:create` ability.

**Request:**

```http
Content-Type: multipart/form-data
Authorization: Bearer <token>

file: (binary file data)
is_public: (boolean, optional)
```

**Response:**

```json
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
```

##### Get Single Media

`GET /api/v2/media/{media}`

**Description:** Get details for a specific media item belonging to the authenticated user.

**Authentication:** Requires `auth:sanctum` middleware with `media:read` ability.

**Request:**

```text
Authorization: Bearer <token>
```

**Response:**

```json
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
```

##### Delete Media

`DELETE /api/v2/media/{media}`

**Description:** Delete a specific media item belonging to the authenticated user.

**Authentication:** Requires `auth:sanctum` middleware with `media:delete` ability.

**Request:**

```text
Authorization: Bearer <token>
```

**Response:**

```json
{
    "success": true,
    "data": [],
    "message": "Media deleted successfully."
}
```

#### Link Endpoints

##### List User Links

`GET /api/v2/links`

**Description:** Get a paginated list of links belonging to the authenticated user. Includes view count.

**Authentication:** Requires `auth:sanctum` middleware with `links:read` ability.

**Request:**

```text
Authorization: Bearer <token>
```

**Response:**

```json
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
```

##### Create Link

`POST /api/v2/links`

**Description:** Create a new short link for the authenticated user.

**Authentication:** Requires `auth:sanctum` middleware with `links:create` ability.

**Request:**

```json
{
    "original_url": "https://www.google.com",
    "slug": "custom-google-link"
}
```

**Response:**

```json
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
```

##### Get Single Link

`GET /api/v2/links/{link}`

**Description:** Get details for a specific link belonging to the authenticated user. Includes view count.

**Authentication:** Requires `auth:sanctum` middleware with `links:read` ability.

**Request:**

```text
Authorization: Bearer <token>
```

**Response:**

```json
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
```

##### Delete Link

`DELETE /api/v2/links/{link}`

**Description:** Delete a specific link belonging to the authenticated user.

**Authentication:** Requires `auth:sanctum` middleware with `links:delete` ability.

**Request:**

```text
Authorization: Bearer <token>
```

**Response:**

```json
{
    "success": true,
    "data": [],
    "message": "Link deleted successfully."
}
```

#### Activity Log

##### Get User Activity Logs

`GET /api/v2/activity`

**Description:** Get a paginated list of activity logs for the authenticated user.

**Authentication:** Requires `auth:sanctum` middleware with `activity:read` ability.

**Request:**

```text
Authorization: Bearer <token>
```

**Response:**

```json
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
```