# Wildtours Base Theme

## Installable Package

Do not upload the repository source archive from GitHub, for example `wildtours-base-theme-main.zip`.
That archive contains the theme inside a nested folder, so WordPress cannot find the required root files and reports `Template is missing`.

Build and upload the dedicated theme package instead:

```powershell
./package-theme.cmd
```

This creates `wildtours-base-theme.zip` at the workspace root. Upload that file in WordPress under Appearance > Themes > Add Theme > Upload Theme.

## Why The GitHub Zip Fails

WordPress expects the uploaded zip to contain the theme files directly under a single theme folder such as:

```text
wildtours-base-theme/
	style.css
	index.php
	functions.php
```

The GitHub source download wraps the entire repository first, so the theme ends up nested too deeply inside the archive.
