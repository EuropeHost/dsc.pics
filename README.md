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