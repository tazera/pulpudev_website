# Installation Guide for static_website_framework

## Step 1: Install PHP 8.4.3

Download and install PHP version 8.4.3 from the official PHP website or your preferred source.

## Step 2: Verify SQLite Extension in PHP

After installing PHP, navigate to the PHP installation directory and check for the SQLite extension.

- Go to the PHP installation folder: `php-8.4.3\ext`
- Ensure that `php_sqlite3.dll` exists. This file is typically included by default in Windows PHP installations.

## Step 3: Enable SQLite Extension in php.ini

By default, the SQLite extension is commented out. You need to enable it:

1. Open `php.ini` in the `php-8.4.3` directory.
2. Locate the line containing `php_sqlite3.dll` or `php_sqlite3` (it may or may not have the `.dll` extension, depending on the PHP version).
3. If the line is prefixed with `;`, remove the semicolon (`;`) to uncomment it.
4. Save and close the file.

## Step 4: Install SQLITE3

1. Go on the official page of sqllite3 and download the sqlite-tools-win-x64-3490100.zip from https://www.sqlite.org/download.html (Windows)
2. Unzip the folder and place it on the disk
3. Add to env path variables

## Step 5: Install Dependencies

1. Open the command prompt (cmd) and navigate to the `static_website_framework` folder.
2. Run the command found in `install_dependencies`.
3. The script will prompt you to select a version of SQLite:
   - Choose **option 0** for the recommended version.
   - If option 0 does not work, you can try **option 1**, but stability is not guaranteed.

## Step 5: Refresh the Database

1. Navigate to the `db` subfolder.
2. Run the following command in the command prompt:
   ```sh
   php refresh_db.php
   ```

## Step 6: Setup Complete

Congratulations! 🎉 You have successfully set up the `static_website_framework`.
