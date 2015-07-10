Networkteam.Neos.Shariff
========================

Social plugins are on every page today, but if you have concerns about privacy of your visitors it is not that easy
to integrate them. The german publisher Heise created a general solution that allows to show the counts for each share
while preserving the privacy of website visitory. This is accomplished by using the server of the website as proxy for
the visitors. http://ct.de/-2467514

This plugin integrates Shariff into Neos with a few simple steps.

Installation:
-------------

    $ composer require networkteam/neos-shariff

Configuration:
--------------

Include the package routes in your *global* `Routes.yaml` for fetching the counts via AJAX:

    -
      name: 'NetworkteamNeosShariff'
      uriPattern: 'shariff/<NetworkteamNeosShariffSubroutes>'
      subRoutes:
        NetworkteamNeosShariffSubroutes:
          package: Networkteam.Neos.Shariff

Configure the list of services to show in a `Settings.yaml` (e.g. in your site package):

    Networkteam:
      Neos:
        Shariff:
          options:
            services:
              - WhatsApp
              - Twitter
              - Facebook
              - GooglePlus
              - Pinterest
              - Mail

See `Configuration/Settings.yaml` for more information about possible options.

Usage:
------

This package contains a simple Node Type `Networkteam.Neos.Shariff:Shariff` that renders social
share buttons via Shariff. Just add a new node of this type to a document in the Neos backend.

Usage via TypoScript:
---------------------

In your prototype define a property which renders the social plugins like this:

    prototype(My.Awesome.Package:Post) {
        socialButtons = Networkteam.Neos.Shariff:Shariff
    }

Then in the corresponding template render the path like this:

    {socialButtons -> f:format.raw()}
