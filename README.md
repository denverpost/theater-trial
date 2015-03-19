# Theater Trial

A child theme for Reactor designed for The Denver Post's Aurora theater shooting trial coverage microsite.

## Setting up for dev, beta or prod

#### Required parent theme

[Reactor (Customized DP version)](http://extras.denverpost.com/media/wp/reactor.zip)

#### Required Plugins

* [Jetpack](https://wordpress.org/plugins/jetpack/)
* [WP SEO](https://wordpress.org/plugins/wordpress-seo/)

## Setup

### Site settings

1. Go to Settings -> General
	* Set the Site Title to "Theater Trial"

### Theme Customizations

All found in **Appearance -> Customize**

1. General
	* Set *Title* to **Theater Trial**
	* Set *Tagline* to **Aurora theater shooting trial coverage from The Denver Post**
	* Uncheck *Show Title & Tagline*
2. Navigation
	* Set *Top Bar Title* to **Theater Trial**
	* Set *Top Bar Title Link* to the appropriate fully-qualified URL (localhost, beta, etc.)
	* Uncheck *Fixed Top Bar*
	* Check *Sticky Top Bar*
	* Check *Contain Top Bar Width*
	* Check *Enable Top Bar Search*
3. Posts & Pages
	* Set *Default Layout* to **Two Columns, Left**
	* Uncheck *Show Breadcrumbs*
4. Fonts & Colors
	* Set *Title Font* to **Alegreya Sans**
	* Set *Content Font* to **Alegreya Sans**
5. Front Page
	* Check *Exclude From Blog*
	* Set *Post Columns* to **1 Column**
	* Set *Number of Posts* to **10** or adjust as desired
	* Check *Link Post Titles*
	* Check *Show Page Links*

### Plugin Setup

1. Jetpack
	* If on beta/prod, connect Jetpack to Wordpress using the DPO account.

### Set up Pages

#### Front Page

1. Create a blank page called **Music news and analysis from The Denver Post**
	* Select the template **Front Page** from the *Page Template* dropdown at right
	* Don't put any content in the page body
2. Head to Settings -> Reading and set *Front page displays*  to **A static page**
	* Select the **Music news and analysis from The Denver Post** page you just created under "Front page"
	* While you're here, don't forget to set the RSS feeds to "Summary"

### Menus

When adding items to menus, you can add or edit the *Navigation label* (displayed text) and *Title Attribute* (displayed on hover, used for SEO and Accessibility) under *Menu Structure* after the item is added.

#### Top Bar menu

* Must be named **top bar**
* Assign to the *Top Bar Left* position
* Add top-level categories and place sub categories beneath them as desired

#### Footer Links menu

* Must be named **footer links**
* Assign to the *Footer Menu* position

1. From the *Links* tab, add the following links:
	* Ethics Policy
		* URL: **http://www.denverpost.com/ethics**
		* Navigation label: **Ethics Policy**
		* Title Attribute: **Denver Post Ethics Policy**
	* Terms of Use
		* URL: **http://www.denverpost.com/termsofuse**
		* Navigation label: **Terms of Use**
		* Title Attribute: **Denver Post Terms of Use**
	* Privacy Policy
		* URL: **http://www.denverpost.com/privacypolicy**
		* Navigation label: **Privacy Policy**
		* Title Attribute: **Denver Post Privacy Policy**
