# Networkteam.Neos.Shariff

Social plugins are on every page today, but if you have concerns about privacy of your visitors it is not that easy
to integrate them. The german publisher Heise created a general solution that allows to show the counts for each share
while preserving the privacy of website visitory. This is accomplished by using the server of the website as proxy for
the visitors. http://ct.de/-2467514

This plugin integrates Shariff into Neos with a few simple steps.

## Installation

    $ composer require networkteam/neos-shariff

### Compatibility

See the following table for the correct plugin version to choose:

| Neos CMS | Plugin version |
| -------- | -------------- |
| >= 3.0   | 3.x            |
| < 3.0    | 2.x            |
| < 2.0    | 1.x            |

## Configuration

Including the package routes in your *global* `Routes.yaml` is no longer needed as of Flow 4.0.

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

## Usage

### As a content element

This package contains a simple node type `Networkteam.Neos.Shariff:Shariff` that renders social
share buttons via Shariff. Just add a new node of this type to a document in the Neos backend.

### Usage via TypoScript

In your prototype define a property which renders the social plugins like this:

    prototype(My.Awesome.Package:Post) {
        socialButtons = Networkteam.Neos.Shariff:Shariff
    }

Then in the corresponding template render the path like this:

    {socialButtons -> f:format.raw()}

## Configuration

Shariff is configured by data-attributes. A basic set of these attributes is already defined by package settings.

* `data-backend-url`
* `data-services`
* `data-theme`
* `data-orientation`
* `data-lang`

You can override them in your settings.yaml.

    Networkteam:
      Neos:
        Shariff:
          frontend:
            theme: standard
            orientation: horizontal
            language: en
          options:
            domain: ~
            cache:
              ttl: 3600
            services:
    #          - Facebook
    #          - GooglePlus
    #          - Twitter
    #          - LinkedIn
    #          - Reddit
    #          - StumbleUpon
    #          - Flattr
    #          - Pinterest
    #          - Xing

If you want to extend the configuration just go like this:

    prototype(Networkteam.Neos.Shariff:Shariff) {
        attributes {
            // Put additional attributes here, see https://github.com/heiseonline/shariff#options-data-attributes
            // data-example = 'value'
        }
    }
    
## Using Pinterest

In order to use a "Pin it" button in shariff pinterest won't grab an image of your page automatically.
You have to define one by using the "data-media-url" attribute. So just extend
`prototype(Networkteam.Neos.Shariff:Shariff)` and use e.g. the twitterCardImage property of the current Document Node to
serve a proper image.

## Development

When you publish a new version, make sure to run `npm run-script build`. This will update the Shariff package and copy the assets into public folder.
After build check in the modified files.

## Acknowledgments

Development of the Neos integration sponsored by [networkteam GmbH - Neos Agentur](https://networkteam.com/fokus/neos-cms.html).

## License

Licensed under GPLv2+, see [LICENSE](LICENSE).
