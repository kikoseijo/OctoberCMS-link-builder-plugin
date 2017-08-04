# octoberCMS-link-builder

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
Slug                    | Slug for the item
Phone (Optional)        | Phone number of the link
Order (Optional)        | Numeric field to order the items
LINK (Optional)         | Link/Item URL
Target (Optional)       | To open the link in a new window
Enabled (Optional)      | To set as hidden
Description (Optional)  | Description of the Item with rich editor area
Image (Optional)        | Image related to the item


### Usage
#### Copy the template
Copy /plugins/ksoft/links/components/links/default.htm to your themes partials/links folder. Here is the default template, you can format it any way you like.
~~~
<div class="container m-t-lg">
    <div class="row">
        {% for item in __SELF__.links %}
            <div class="col-lg-4">
                <div class="icon-block center-align">
                    {% if item.link %}
                        <a {% if item.target %}target="_blank"{% endif %} href="{{ item.link }}" class="blue-grey-text">www</a>
                    {% endif %}
                    {% if item.image %}
                        <img class="img-responsive img-circle " src="/storage/app/media{{ item.image }}" alt="{{ item.title }}" {% if item.title %}title="{{ item.title }}"{% endif %}>
                    {% endif %}
                    <a href="{{ item.pageUrl }}">
                        <h5 class="center">{{ item.title }}</h5>
                    </a>
                    <small>posted {{ item.created_at|date('F Y') }} in <a href="{{ item.category.pageUrl }}">{{ item.category.name }}</a></small>
                    {% if item.phone %}
                    <p>
                        {{ item.phone|raw }}
                    </p>
                    {% endif %}
                </div>
            </div>
        {% endfor %}
    </div>

    {% if __SELF__.links.lastPage > 1 %}
    <div class="row">
        <div class="col-sm-12">
            <ul class="pagination">
                {% if __SELF__.links.currentPage > 1 %}
                <li><a href="{{ this.page.baseFileName|page({ page: (__SELF__.links.currentPage - 1) }) }}">&larr; Prev</a></li>
                {% endif %}

                {% for page in 1..__SELF__.links.lastPage %}
                <li class="{{ __SELF__.links.currentPage == page ? 'active' : null }}">
                    <a href="{{ this.page.baseFileName|page({ page: page }) }}">{{ page }}</a>
                </li>
                {% endfor %}

                {% if __SELF__.links.lastPage > __SELF__.links.currentPage %}
                <li><a href="{{ this.page.baseFileName|page({ page: (__SELF__.links.currentPage + 1) }) }}">Next &rarr;</a></li>
                {% endif %}
            </ul>
        </div>
    </div>
    {% endif %}
</div>
~~~

#### Links list page
Now you can embed portfolio in your pages. Just use the portfolio component in your page, select category of your portfolio and place `{% component 'links' %}` anywhere you like.

Simple use case:
~~~
title = "Links"
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
The link item detail component is to show off a single link.
It is also used to show your link when clicking the title of a displayed list links component.

### Usage
#### Copy the template
Copy /plugins/ksoft/links/components/item/default.htm to your themes partials/item folder. Here is the default template, you can format it any way you like.
~~~
{% set item = __SELF__.item %}
<div class="container m-t-lg">
    <div class="row">
        <div class="col-lg-6">
            {% if item.image %}
            <div class="col-sm-6">
                <img class="img-responsive " src="/storage/app/media{{ item.image }}" alt="{{ item.title }}" {% if item.title %}title="{{ item.title }}"{% endif %}>
            </div>
            {% endif %}
        </div>
        <div class="col-lg-6">
            <h1>Portfolio Item {{ item.id }}</h1>
            <h2>{{ item.title }}</h2>
            <small>posted {{ item.created_at|date('j m Y') }} in <a href="{{ item.category.pageUrl }}">{{ item.category.name }}</a></small>
            <div>
                {% for tag in item.tags %}
                <a href="{{ tag.pageUrl }}"><span class="label label-default">{{ tag.name }}</span></a>
                {% endfor %}
            </div>
            <p>{{ item.description|raw }}</p>
            {% if item.link %}
                <a href="{{ item.link }}" class="btn btn-default" {% if item.target %}target="_blank"{% endif %}>view link web</a>
            {% endif %}
            {% if item.phone %}
                <a href="tel:{{ item.phone }}" class="btn btn-default" target="_blank">{{item.phone}}</a>
            {% endif %}
        </div>
    </div>
</div>
~~~

### Add the component
Create a page and add the component to it, this way you will be able to follow links to the detail page.
A simple example:
~~~
title = "Link detail page"
url = "/link/:item_slug"

[Ksoft\Links\Components\Item item]
item = 0
itemSlug = "{{ :item_slug }}"
catListPage = "links"
==
{% component 'item' %}
~~~

Another way to use the item component is to show single links items in any page. Just add the item component in your page, select the item from your link builder and place `{% component 'links' %}` anywhere you like.
Use the same example as above with any URL you like to use and select from the item component the correct 'Item to show' and save the page.

// TODO: fix the importer to be able to add data massively.
