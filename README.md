# ReviveGreece-WordPress-Theme

Solution for the final assignment entitled "WordPress Theme (Version B)" of the "Extended Introduction to Web Development" seminar by [ReviveGreece](https://revivegreece.org/).

I have created a WordPress theme whose purpose is to cover the presentation of books for a library or bookstore.
I preferred to focus on the "library"-type functionality, as no price field or sales function was implemented.
Features that have been created:
* Custom Logo support via theme customizer
* 2 Menu Locations (header & footer)
* Custom Post Type "Books" for archiving books with the following features (beyond basic support):
    * Featured Image
    * Custom taxonomies [Genres (hierarchical) & Publishers (non-hierarchical)]
    * As I wanted to have the same features where the theme would be installed I implemented the fields with metaboxes instead of custom fields. (Category, ISBN, Language, Author, Page Number)
* Display custom post types in Search other than pages and posts.
* Differentiation of front-page layout, single-post, single page, single book and taxonomy archive.
* Two sidebars for importing widgets, which in this phase only grow on the front page as I did not find the need for another page.
* Count all types of Post Type tags from widgets.
All of the above is hardcoded and therefore ported to the theme as functions without the need to install a plugin.