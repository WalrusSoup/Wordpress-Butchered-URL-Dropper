# Wordpress-Butchered-URL-Dropper
Stop search engines from attempting to index busted\mutilated URLS in wordpress that return a 200 OK for some reason.

A lot of times this is a search page, or just a page that happens to load. This plugin will check if the viewer
is a search engine and then just issue a 404 if it contains some odd `$_GET` params.

## Customizing
If you're having issues, check google search console and look for any odd parameters in the URL and add it to the `$strangeParameters` array.

```php
protected $strangeParameters = [
    '__hstc',
    '__hsfp',
    'wtime',
    'seek_to_second_number',
    'wordfence_lh',
    'search',
    '_ga'
];
```

If you see one missing that is affecting you, please contribute a PR so we can stop this nonsense.

## Known Search Engines
```php
'Googlebot',
'Bingbot',
'Slurp',
'DuckDuckBot',
'Baiduspider',
'YandexBot',
'Sogou',
'Exabot',
'facebot',
'ia_archiver',
```