
# alasource.info

[![GitHub Super-Linter](https://github.com/Anisote/alasource.info/workflows/Lint%20Code%20Base/badge.svg)](https://github.com/marketplace/actions/super-linter)
[![CodeQL](https://github.com/Anisote/alasource.info/actions/workflows/codeql-analysis.yml/badge.svg)](https://github.com/Anisote/alasource.info/actions/workflows/codeql-analysis.yml)

This is the Git repository of [https://alasource.info](https://alasource.info/).

## TODO list

Features required for version 1 :

- Global
- Home Panel
  - Features
    - ~~Add a text about the update date at the bottom of the website~~ - 03/12/2021
    - Add explanation videos for all displayed (mobile & compact)
    - Sparkle help button some seconds when the website is displayed
    - Sort stars in the other way
    - Display the compact mode information message at the bottom of the website
- FAQ Panel
- Contact Panel
  - Contact page doesn't work anymore
- Mentions légales
  - Mentions légales doesn't work anymore
- Admin Panel
  - ~~Add a tag when a field is selected~~ - 04/12/2021
  - Forbid the addition of an existing author, media or category
  - Fix an issue when inserting of authors without tags in an information
  - Author should be required to add an information

  - Bugs
    - When the video is over, close the video
    - Compact mode information message has a padding

Features required for version 2 :

- Home Panel
  - Features
    - Create a rss link
    - Display domaine information when click on the icon (mobile)
    - ~~When click on a domain, it sould select it in the display and close it~~ - discarded
    - Give the possibility to see the langage of an article | choose the langague of informations you want to see
    - Switch the top bar to the bottom and reduce size
    - Change the logo
    - Display alternative links for sources
- FAQ Panel
- Contact Panel
- Mentions légales
- Admin Panel

One day maybe :
- Global
  - Resize the datable when the zoom changed

## Commit format

|Type|Description|Commit format|
|----|-----------|-------------|
|Fix|Fix a bug|Fix ...|
|Feature|Implementation of a new feature|Add/Replace ...|
|Improvement|Improve something|Improve ...|
|Database|Populate the database|Populate the database( with ...)|
|Bump|Bump a dependancy|Bump ...|

## Sitemap

It is generated from the sitemap.php file. Every new page should be added in this file.

## History

- Global
  - ~~Implement a footer with the Github link~~
  - ~~Add a robots.txt file with a sitemap.xml~~ - 04/07/2021
  - ~~Add a Mastodon Link~~ - 12/11/2021
- Home Panel
  - Features
    - ~~When a filter is enable, only displays options in other filters which have data~~
    - ~~Implement tags~~ - 04/07/2021
    - ~~Implement released dates about data~~ - 04/07/2021
    - ~~Displays the tags list when the search box is selected~~ - 04/07/2021
    - ~~Order the dates from the older to the most recent~~ - 04/07/2021
    - ~~Improve the search bar in ignoring accent https://datatables.net/forums/discussion/36473/datatables-search-filter-special-characters-with-html-data~~ - 04/07/2021
    - ~~Reduce margin for the small resolutions~~ - 05/07/2021
    - ~~Fix bug about column filter when a search is done~~ - 12/07/2021
    - ~~Add a function to create tags in the administration panel~~ - 27/07/2021
    - ~~Edit fields for an information entry~~ - 04/08/2021
    - ~~Reorder the search menu tooltip~~ - 22/08/2021
    - ~~Allow a field to be displayed as a tag~~ - 22/08/2021
    - ~~Add mark criterias~~ - 03/09/2021
    - ~~Allow an information to have multiple authors~~ - 07/09/2021
    - ~~Order authors by alphabetical order~~ - 06/10/2021
    - ~~Order information by alphabetical order in administration panel~~ - canceled
    - ~~Fix issue in the admin panel for author with quote~~ - 06/10/2021
    - ~~Display less columns in a small screen resolution by default and create a button to display all column and reverse~~ - 06/10/2021
    - ~~Fix the date column sort when clicking on a date column title~~ - 18/08/2021
    - ~~Fix search bugs with tags with more than one word~~ - 07/11/2021
    - ~~Switch to full screen and rotate screen on mobile when compact mode is disabled (rotation replaced by an info message)~~ - 14/11/2021
    - ~~Add the number of items by domaine~~ - 14/11/2021
    - ~~Add an explanation video~~ - 20/11/2021
  - Bugs
    - ~~Search with accents doesn't work anymore~~ - 14/11/2021
    - ~~The author list doesn't contain multiple authors anymore~~ - 14/11/2021
    - ~~Order the media select~~ - 14/11/2021
    - ~~When click on the video, close tooltip panel~~ - 14/11/2021
    - ~~When click in the space, the tooltip should be closed~~ - 14/11/2021
- FAQ Panel
  - ~~Rewrite the FAQ~~ - 06/11/2021
- Contact Panel
  - ~~Implement hcaptcha in the contact form~~ - 11/07/2021
- Admin Panel
