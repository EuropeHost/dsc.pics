# Roadmap: dsc.pics Feature Enhancements

This document outlines the planned features and refactoring work for the dsc.pics application.

---

### **Part 1: UI & Theming - Dark Mode Support**

-   **Goal:** Implement a user-toggleable dark and light mode for a better user experience.
-   **Status:** In Progress
-   **Steps:**
    - [x] 1. **Configure Tailwind:** Update `tailwind.config.js` to enable the `class` strategy for dark mode.
    - [x] 2. **Create Theme Toggle:** Develop a Blade component for the UI switch (e.g., a button with a sun/moon icon).
    - [x] 3. **Implement JavaScript:** Add logic to `resources/js/app.js` to toggle the 'dark' class on the `<html>` element and save the user's preference in `localStorage`.
    - [ ] 4. **Integrate & Style:** Add the toggle component to the main layout and update views with `dark:` prefixed utility classes to ensure the UI is polished in both modes.

---

### **Part 2: Core Refactor - `Image` to `Media` Model**

-   **Goal:** Generalize the "Image" concept to "Media" to support a wider range of file types and future-proof the application.
-   **Status:** Completed
-   **Steps:**
    - [x] 1. **Database Migration:** Create and run a new migration to rename the `images` table to `media`.
    - [x] 2. **Model & Factory:**
        - [x] Rename `app/Models/Image.php` to `app/Models/Media.php` and update the class name.
        - [x] Rename `database/factories/ImageFactory.php` to `MediaFactory.php`.
    - [x] 3. **Controller Refactor:**
        - [x] Rename `app/Http/Controllers/ImageController.php` to `MediaController.php`.
        - [x] Update all internal logic to use the `Media` model.
    - [x] 4. **Update Codebase:** Systematically search and replace all occurrences of the `Image` model, its relationships (`Image::class`), and related variables (e.g., `$image` -> `$media`) across all controllers, views, and routes.
    - [x] 5. **Routes:** Update `routes/web.php` to use the new `MediaController` and correct route model bindings.

---

### **Part 3: New Features - Media Overview & Raw URLs**

-   **Goal:** Create dedicated pages for viewing media details and accessing the raw file content directly.
-   **Status:** Not Started
-   **Steps:**
    - [ ] 1. **Define Routes:** Add new routes to `routes/web.php`:
        - [ ] `GET /media/{media}/overview` -> `MediaController@overview`
        - [ ] `GET /media/{media}/raw` -> `MediaController@raw`
    - [ ] 2. **Implement Controller Logic:**
        - [ ] `overview()`: Return a view with detailed information about the media item.
        - [ ] `raw()`: Return a direct file response for the media.
    - [ ] 3. **Create View:**
        - [ ] `resources/views/media/overview.blade.php`

---

### **Part 4: API - Full Support & Token Management**

-   **Goal:** Implement a complete REST API for media management, secured by API tokens.
-   **Status:** Not Started
-   **Steps:**
    - [ ] 1. **Install & Configure Laravel Sanctum:** Set up Sanctum for robust and secure API token authentication.
    - [ ] 2. **API Routes:** Define resource-oriented API routes in `routes/api.php` for media (upload, list, delete) and token management (create, list, revoke). All routes will be protected by the `auth:sanctum` middleware.
    - [ ] 3. **API Controllers:** Create dedicated controllers under the `App\Http\Controllers\Api` namespace to handle all API logic.
    - [ ] 4. **Token Management UI:**
        - [ ] Build a new section in the user's profile page to manage their API tokens.
        - [ ] Implement the backend logic for creating, listing, and revoking tokens. The newly generated token will only be shown to the user once.
    - [ ] 5. **Documentation:** Create basic API documentation outlining the available endpoints, required parameters, and authentication method.

---

### **Part 5: New Features - Media Statistics**

-   **Goal:** Provide users with analytics for their media, including a visual graph of views over time.
-   **Status:** Not Started
-   **Steps:**
    - [ ] 1. **Install Chart.js:** Add Chart.js to the project via `npm install chart.js`.
    - [ ] 2. **Define Routes:** Add the following routes:
        - [ ] `GET /media/{media}/stats` -> `MediaController@stats` (for the view)
        - [ ] `GET /api/media/{media}/stats` -> `Api\MediaController@stats` (for fetching chart data)
    - [ ] 3. **Implement Controller Logic:**
        - [ ] `MediaController@stats()`: Return the Blade view for the statistics page.
        - [ ] `Api\MediaController@stats()`: Return aggregated view data (e.g., daily views from the `link_views` table) as JSON.
    - [ ] 4. **Create Stats View:**
        - [ ] `resources/views/media/stats.blade.php`
    - [ ] 5. **Build Stats Chart:** In the `stats.blade.php` view, add a `<canvas>` element and the necessary JavaScript to fetch data from the new API endpoint and render a line graph using Chart.js.

---

### **Part 6: Streamer Mode and User Settings**

-   **Goal:** Enhance user privacy and notification preferences.
-   **Status:** Not Started
-   **Steps:**
    - [ ] 1. **Streamer Mode Logic:** Implement a global toggle in user settings to:
        - [ ] Blur username, profile picture, and email address across the application.
        - [ ] Potentially hide sensitive information in notifications or public views.
    - [ ] 2. **Toast Notification Settings:**
        - [ ] Create a dedicated section in user settings for managing toast notification preferences.
        - [ ] Allow users to enable/disable specific types of toast notifications (e.g., upload success, deletion warnings).
    - [ ] 3. **Backend Integration:** Implement the necessary backend logic to store and retrieve user preferences for both streamer mode and toast notifications.
    - [ ] 4. **Frontend Implementation:** Update relevant Blade components and JavaScript to react to user settings, applying blurring effects or controlling notification display.

---

### **Part 7: UI Enhancements - Command Palette (CMD+K)**

-   **Goal:** Introduce a keyboard-navigable command palette for quick access to core application features.
-   **Status:** Not Started
-   **Steps:**
    - [ ] 1. **Keyboard Shortcut Implementation:**
        - [ ] Add a global JavaScript event listener to detect `CMD+K` (or `CTRL+K` on Windows/Linux).
        - [ ] Trigger the display of a modal component upon activation.
    - [ ] 2. **Command Palette Modal Component:**
        - [ ] Create a new Blade component (e.g., `command-palette.blade.php`) for the modal.
        - [ ] The modal should include an input field for search and a list of navigable links/actions.
        - [ ] Use a client-side library (e.g., Fuse.js for fuzzy searching) if complex search is needed.
    - [ ] 3. **Link Listing & Filtering:**
        - [ ] Populate the command palette with a curated list of application links:
            - [ ] `Dashboard`
            - [ ] `My Media`
            - [ ] `User Settings`
            - [ ] `API Tokens`
            - [ ] `Upload Media` (sub-modal trigger)
            - [ ] `Shorten Link` (sub-modal trigger)
        - [ ] Dynamically show/hide links based on user authentication status (`@auth`) and permissions (`@can('admin')`):
            - [ ] `Users` (for admins only)
        - [ ] Ensure all links are localized
    - [ ] 4. **Sub-Modal Integration:**
        - [ ] Implement logic within the command palette to trigger other modals, such as the `Upload Media` modal or `Shorten Link` modal, instead of navigating away.
        - [ ] Ensure proper focus management and modal stacking.
    - [ ] 5. **Styling & Accessibility:**
        - [ ] Style the command palette for a clean, intuitive user experience in both light and dark modes.
        - [ ] Ensure it's keyboard-navigable and accessible.