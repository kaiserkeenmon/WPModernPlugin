# Documentation Maintenance Guide

This document outlines the procedures for maintaining and updating the project's documentation.

## Building the Documentation

The documentation site is generated using Jekyll. To build the documentation for production, use the following command from the root of the project:

``` bash
JEKYLL_ENV=production bundle exec jekyll b
```

This command compiles the documentation and outputs the static files into the `/documentation/_site` directory.

## Updating the Documentation Website

After building the documentation, the next step is to update the live documentation website. To do this, follow these steps:

1. Navigate to the `/documentation/_site` directory, where the generated static files are located.
2. Copy the contents of the `_site` directory.
3. Paste the copied files into the `/docs` directory at the root of the project. This directory is used by GitHub Pages (or your hosting solution) to serve the documentation website.

## Committing Changes

After copying the updated documentation files into the `/docs` directory, you need to commit these changes to the repository. Follow these steps:

1. Open your terminal and navigate to the project's root directory.
2. Add the updated `/docs` directory to git:

``` bash
git add docs/
```

3. Commit the changes with a descriptive message:

``` bash
git commit -m "Update documentation for version X.X.X"
```

4. Push the commit to your remote repository:

``` bash
git push origin main
```

Replace `main` with the appropriate branch name if your default branch is named differently.

## Notes

- Make sure you are in the correct directory when running commands.
- Review the changes locally before pushing them to the repository to ensure there are no errors in the live documentation.

For more detailed instructions on working with Jekyll and the specific configurations used in this project, refer to the [Jekyll documentation](https://jekyllrb.com/).
