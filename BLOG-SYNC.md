# Blog Content Sync Workflow

This document explains how to sync blog posts, categories, and tags between your local development environment and the production server.

## Overview

The blog sync system uses two Artisan commands:
- `blog:export` - Exports blog content from your local database to a JSON file
- `blog:sync` - Imports blog content from the JSON file to the server database

## Workflow

### 1. Create/Edit Blog Posts Locally

Use Filament Admin panel to create or edit blog posts on your local environment:

```
http://localhost/admin/blog/posts
```

### 2. Export Blog Content

After creating or updating blog posts, export them to a JSON file:

```bash
php artisan blog:export
```

This will:
- Export all posts, categories, and tags
- Save to `storage/app/blog-sync/blog-content.json`
- Show statistics about exported content

### 3. Commit and Push

Commit the exported JSON file to your repository:

```bash
git add storage/app/blog-sync/blog-content.json
git commit -m "Add new blog posts: [Title 1], [Title 2]"
git push origin laravel-migration
```

### 4. Deploy to Server

Pull the latest changes on the server:

```bash
cd /path/to/website
git pull origin laravel-migration
```

### 5. Sync Blog Content (Automatic)

The sync happens automatically when you run the deployment script:

```bash
./post-sync.sh
```

Or manually run:

```bash
php artisan blog:sync
```

Use `--force` flag to skip confirmation:

```bash
php artisan blog:sync --force
```

## Features

### Update or Create Behavior

The `blog:sync` command uses `updateOrCreate`, which means:
- **Existing posts** (matched by slug) will be **updated** with new content
- **New posts** will be **created**
- No data loss - existing posts are never deleted

### Category and Tag Handling

- Categories are synced first
- Category IDs are automatically mapped between environments
- Tags are created if they don't exist
- Post-tag relationships are preserved

### Database Transactions

All sync operations use database transactions:
- If any error occurs, the entire sync is rolled back
- Database stays consistent even if sync fails

### Statistics

Both commands show helpful statistics:
- Number of categories exported/synced
- Number of posts exported/synced
- Number of items created vs. updated

## File Structure

```
storage/
  app/
    blog-sync/
      blog-content.json    # Exported blog data (committed to git)
```

## Example Output

### Export Command

```
$ php artisan blog:export

Exporting blog content...
✅ Blog content exported successfully!
📁 File: /path/to/storage/app/blog-sync/blog-content.json
📊 Categories: 5
📝 Posts: 12

Next steps:
1. Commit the file: git add storage/app/blog-sync/blog-content.json
2. Push to repository: git push
3. On server, run: php artisan blog:sync
```

### Sync Command

```
$ php artisan blog:sync

📦 Blog content file found!
📅 Exported at: 2025-01-15 10:30:45
📊 Categories: 5
📝 Posts: 12

Do you want to proceed with syncing? (yes/no) [yes]:
> yes

Syncing categories...
✅ Categories: 2 created, 3 updated
Syncing posts...
✅ Posts: 5 created, 7 updated

🎉 Blog content synced successfully!
Run "php artisan sitemap:generate" to update the sitemap.
```

## Automated Deployment

The `post-sync.sh` script automatically:
1. Pulls latest code from git
2. Runs migrations
3. **Syncs blog content** (if file exists)
4. Regenerates sitemap
5. Clears caches

## Troubleshooting

### "Blog content file not found"

**Problem:** The sync command can't find the JSON file.

**Solution:**
- Make sure you ran `php artisan blog:export` on local
- Commit and push the file: `git add storage/app/blog-sync/blog-content.json`
- Pull on server: `git pull`

### "Invalid JSON file format"

**Problem:** The JSON file is corrupted.

**Solution:**
- Delete the file and run `php artisan blog:export` again
- Check if the file was committed properly

### Featured images not showing

**Problem:** Featured images stored locally aren't on the server.

**Solution:**
- Upload images to the server storage directory
- Or use a shared storage (S3, DigitalOcean Spaces, etc.)
- Update image paths in the admin panel

## Best Practices

1. **Always export after making blog changes** on local
2. **Review the exported file** before committing (check the JSON is valid)
3. **Use descriptive commit messages** mentioning which posts were added/updated
4. **Test on staging first** before syncing to production
5. **Backup database** before large syncs

## Author Mapping

**Important:** Author IDs from local may not match server IDs.

If you have different admin users on local vs. server:
1. Ensure the same admin users exist on both environments
2. Or manually update `blog_author_id` in the JSON file before syncing

## Future Enhancements

Possible improvements:
- Image sync functionality
- Selective sync (only specific posts)
- Bi-directional sync (server → local)
- Conflict detection and resolution
- Automated sync via webhook

## Support

For issues or questions, contact the development team.
