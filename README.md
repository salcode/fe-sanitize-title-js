# Sanitize Title JavaScript Shortcode

This project is no longer actively maintained. WordPress core has introduced the JavaScript [cleanForSlug](https://www.npmjs.com/package/@wordpress/url#cleanForSlug), which appears to be a good alternative.

`cleanForSlug()` is available as part of the [@wordpress/url](https://www.npmjs.com/package/@wordpress/url#cleanForSlug) npm package.

------------

This WordPress plugin enables the shortcode `[sanitize-title-js]`, which is a demo of the JavaScript function `wpFeSanitizeTitle()`, which is a JavaScript function that mimics the behavior of the WordPress PHP function `sanitize_title()`.

The function `wpFeSanitizeTitle()` can be found in this plugin at `assets/wp-fe-sanitize-title.js`.  This JavaScript function is used by supplying a single parameter of type string, which will then be sanitized into a format usable as a URL slug.

## Example

```
wpFeSanitizeTitle( 'Spaces, -Dashes-, and other ch@racter$ are %REMOVED%!' );
```

will result in

```
spaces-dashes-and-other-chracter-are-removed
```

## Credits

[Sal Ferrarello](https://salferrarello.com/) / [@salcode](https://twitter.com/salcode)
