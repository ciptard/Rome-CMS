# Rome CMS

This project is more about the framework under the CMS, named **Roam**. I started working on it because I wanted a way to quickly prototype small web apps, but after a couple of days some co-workers and friends start to show some interest in using it themselves.

While cleaning it up for them, I created this **single page** CMS. I bold the 'single page' piece because I've recently been of the opinion that: there are enough content tools out there (ie: Twitter and Tumblr), that I don't need to build another. Instead, I'll have one page and parse the content from those providers and display a subset.

The idea is for the CMS to be very lightweight and simple in functionality.  I think I've achieved that, but do need to say that it is very very early in development!

## Who is the CMS for?

Developers. There is still plenty of work that has to be done, and there is relatively no documentation yet. It needs some better error handling, and some built-in unit testing.

## How feature rich will this become?

Not very. The plan from the beginning has been to keep the framework ridiculously small, and I think the CMS will follow suit. I am toying around with the idea of adding functionality to support multiple pages, but I haven't decided yet.

## Use at your own risk

Like I stated above, this is very much an early early beta. I'm sure there are lots of things that need cleaning up.

## Installing

Simple.  Run the SQL file on a database, configure your database credentials in the Environment.php file, set the environment in the Config.php file and fire her up.

There is a default Admin account setup to start you off, the password is: admin. I'd uh…change that.

Login at: http://yourdomain/admin

## CMS Features So Far

**Short list of features so far:**

* Single page CMS system
* Multiple user accounts
* Admin and regular user level accounts
* Twitter feed cacheing
* Markdown support
* Ability to select active theme from admin panel
* Template specific admin panel generated from a small config file placed in a theme's directory (optional)
* Crons pre-written to fetch and cache Twitter feed, and cache index page
* Custom content interface so users can generate content outside of predefined template content, and easily pull it into the template with a short bit of code






