Networkteam.Neos.Shariff
========================

Social plugins are on every page today, but if you have concerns about privacy of your visitors it is not that easy
to integrate them. The german computer magazin C`t created together with the publisher heise a general solution
also providing the number of shares each social button counts can be shown. This is accomplished by using the
server of the website as proxy for the visitors. http://ct.de/-2467514

This plugin integrates shariff into neos with a few simple steps.

Installation:
-------------

    $ composer require networkteam/neos-shariff

Configuration:
--------------

Include the routing from the package to enable shariff to communicate to the server to fetch the counts.

    Routes.yaml
    -
      name: 'NetworkteamNeosShariff'
      uriPattern: 'shariff/<NetworkteamNeosShariffSubroutes>'
      subRoutes:
        NetworkteamNeosShariffSubroutes:
          package: Networkteam.Neos.Shariff


Next you need to configure the domain this site runs on, this is to prevent using you server as open relay for the
requests.


    Settings.yaml
    Networkteam:
      Neos:
        Sharrif:
          options:
            domain: <your domain name here>

There are more options here, for example to configure which plugins to show, for more settings check the Settings.yaml
inside the plugin.

Usage via TypoScript 2
----------------------

In the TypoScript2 Object define a property which should contain the social plugins like this:

    prototype(My.Awesome.Package:Post) {
        socialButtons = Networkteam.Neos.Shariff:Shariff
    }

Then in the corresponding Template render the path like this

    {socialButtons -> f:format.raw()}

Development
-----------

Updating the original Shariff JS and CSS:

* Download https://github.com/heiseonline/shariff
* Adjust Gruntfile.js to disable ``sequences`` in ``uglifyify`` (for IE8 compatibility)
* Runt ``grunt build``
* Copy the generated JS and CSS to this package
