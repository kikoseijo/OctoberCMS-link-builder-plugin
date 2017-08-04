# OctoberCMS Plugin: Links builder manager

[![StyleCI](https://styleci.io/repos/99113402/shield?branch=master)](https://styleci.io/repos/99113402)

This plugin allows you to show off a list of `categorized links` on your website. It also can be used to show a list of interests or a single link in any page with the component.  
It comes with `4 diferent list templates` to use when showing the list of link items in your pages: List View, Table View, Card View (bootstrap4) and Plain.  
The table view its a Vue.js mini script that will load the lists from the links API endpoint. (Its for demo purposes on how the api works)

> To use the API enpoints build in `apiEnabled` must be set to true in the config.php

Links are categorized with the following structure:

**Field**               | **Description**
------------------------|--------------------
Title                   | Name of the Link Item
Category (Optional)     | Category of the Item
Slug                    | Slug for the item url
Phone (Optional)        | Phone number of the link
Order (Optional)        | Numeric field to order the items
LINK (Optional)         | Link/Item URL
Target (Optional)       | To open the link in a new window
Enabled (Optional)      | To set as hidden
Description (Optional)  | Description of the Item with rich editor area
Image (Optional)        | Image related to the item


### Usage
#### Copy components templates to your theme directory
Copy the componets to override them on your themes `partials/links` folder so you can customized and wont be overwriten on updates:
~~~
`/plugins/ksoft/links/components/links/default.htm`
`/plugins/ksoft/links/components/links/layout_card.htm`
`/plugins/ksoft/links/components/links/layout_list.htm`
`/plugins/ksoft/links/components/links/layout_plain.htm`
`/plugins/ksoft/links/components/links/layout_table.htm`
~~~

#### Page configuration example to show the component

Simple use case:
~~~
title = "Links page"
url = "/links/:selected_cat?/:page?"

[links]
category = 0
itemsPerPage = 6
order = "asc"
pageNumber = "{{ :page }}"
selectedCat = "{{ :selected_cat }}"
catListPage = "links"
itemPage = "link"
==
{% component 'links' %}
~~~




## Link Item detail component

The link item detail component is to show off a single link in a page, it can take an url parameter or you can define the one on the componen settings.
You should at least have 1 page to redirect the user when they click on the Link item detail page.

### Usage
#### Copy the template
Copy `/plugins/ksoft/links/components/item/default.htm` to your themes partials/item folder, then, you can customize the way you like.


### Add the component to a page
Create a page and add the component to it, this way you will be able to follow links to the detail page.
A simple example:
~~~
title = "Link detail page"
url = "/link/:item_slug"

[Ksoft\Links\Components\Item item] \\ Item being a very popular word for components, use the Plugin\Path, for having few, change item for your customized name
item = 0
itemSlug = "{{ :item_slug }}"
catListPage = "links"
==
{% component 'item' %}
~~~

Another way to use the item component is to show single links items in any page. Just add the item component in your page, select the item from your link builder and place `{% component 'links' %}` anywhere you like.
Use the same example as above with any URL you like to use and select from the item component the correct 'Item to show' and save the page.


## Future Roadmap

There is no priority on this list, if you have any request please open an issue or request and ill add them.

- Backlink checker. Using OctoberCMS cron system to check backlinks on referrals pages.
- Links importer. Using OctoberCMS importing features (50% done).
- Add more translations. (If you have to translate the plugin and want to help other users...send me!)



> This plugin is in active development, merge request are welcome





      
