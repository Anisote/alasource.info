
# alasource.info

This is the Git repository of [https://alasource.info](https://alasource.info/).

## TODO list

- Global
  - ~~Implement a footer with the Github link~~
  - ~~Add a robots.txt file with a sitemap.xml~~ - 04/07/2021
  - ~~Add a Mastodon Link~~ - 12/11/2021
  - Resize the datable when the zoom changed
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
    - Add explanation videos for all displayed (mobile & compact)
    - Create a rss link
  - Bugs
    - ~~Search with accents doesn't work anymore~~ - 14/11/2021
    - ~~The author list doesn't contain multiple authors anymore~~ - 14/11/2021
    - ~~Order the media select~~ - 14/11/2021
- FAQ Panel
  - ~~Rewrite the FAQ~~ - 06/11/2021
- Contact Panel
  - ~~Implement hcaptcha in the contact form~~ - 11/07/2021
  - Contact page doesn't work anymore
- Admin Panel
  - Add a tag when a field is selected
  - Forbid the addition of an existing author, media or category
  - Fix an issue when inserting of authors without tags in an information
  - Author should be required to add an information

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
