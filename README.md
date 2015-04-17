# Theater Trial

A child theme for Reactor designed for The Denver Post's Aurora theater shooting trial coverage microsite.

## Setting up for dev, beta or prod

#### Required parent theme

[Reactor (Customized DP version)](http://extras.denverpost.com/media/wp/reactor.zip)

#### Required Plugins

* [Jetpack](https://wordpress.org/plugins/jetpack/)
* [WP SEO](https://wordpress.org/plugins/wordpress-seo/)
* [AP Style Dates and Times](https://github.com/denverpost/ap-style-dates-and-times)

## Setup

### Site settings

1. Go to Settings -> General
	* Set the Site Title to "Theater Shooting Trial"

### Theme Customizations

All found in **Appearance -> Customize**

1. General
	* Set *Title* to **Theater Shooting Trial**
	* Set *Tagline* to **Aurora theater shooting trial coverage from The Denver Post**
	* Uncheck *Show Title & Tagline*
2. Navigation
	* Set *Top Bar Title* to **Theater Trial**
	* Set *Top Bar Title Link* to the appropriate fully-qualified URL (localhost, beta, etc.)
	* Check *Fixed Top Bar*
	* Uncheck *Sticky Top Bar*
	* Uncheck *Contain Top Bar Width*
	* Uncheck *Enable Top Bar Search*
3. Fonts & Colors
	* Set *Title Font* to **Raleway**
	* Set *Content Font* to **PT Sans**
4. Front Page
	* Set *Post Columns* to **1 Column**
	* Set *Number of Posts* to **10** or adjust as desired
	* Uncheck *Link Post Titles*
	* Check *Show Page Links*

### Plugin Setup

1. Jetpack
	* If on beta/prod, connect Jetpack to Wordpress using the DPO account.
2. AP Style Dates and Times
	* Activate plugin
	* in Settings->AP Dates & Times:
		* Check *Capitalize the word "today"*
		* Check *Yes, capitalize 'noon' and 'midnight'*
3. Disqus
	* Disable the Disqus plugin. There are no comments on this site.
4. Wordpress SEO
	* Under SEO->Social:
		1. Accounts tab:
			* Set *Facebook Page URL* to **http://facebook.com/denverpost**
			* Set *Twitter Username* to **denverpost**
			* Set *Google+ URL* to **http://plus.google.com/+DenverPost**
		2. Facebook tab:
			* **Check** *Add Open Graph meta data*
		3. Twitter tab:
			* **Check** *Add Twitter card meta data*
		4. Google+ tab:
			* **Check** *Add Google+ specific post meta data*
	* Under SEO->Advanced
		1. Permalinks tab:
			* **Check** *Strip the category base...*

### Set up Pages

#### Front Page

1. Create a blank page called **Aurora theater shooting trial coverage from The Denver Post**
	* Select the template **Front Page** from the *Page Template* dropdown at right
	* Don't put any content in the page body
2. Head to Settings -> Reading and set *Front page displays*  to **A static page**
	* Select the **Aurora theater shooting trial coverage from The Denver Post** page you just created under "Front page"
	* While you're here, don't forget to set the RSS feeds to "Summary"

### Menus

When adding items to menus, you can add or edit the *Navigation label* (displayed text) and *Title Attribute* (displayed on hover, used for SEO and Accessibility) under *Menu Structure* after the item is added.

#### Top Bar menu

* Must be named **top bar**
* Assign to the *Top Bar Right* position
* Add top-level categories and place sub categories beneath them as desired

### Discussion

1. Go to Settings->Discussion and:
2. **Uncheck**:
	* Attempt to notify any blogs linked to from the article
	* Allow link notifications from other blogs (pingbacks and trackbacks)
	* Allow people to post comments on new articles
	* Anyone posts a comment  
	* A comment is held for moderation
3. **Check**:
	* Comment must be manually approved
4. Click **Save Changes**
