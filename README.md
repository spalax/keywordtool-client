[![Build Status](https://travis-ci.org/spalax/keywordtool-client.svg?branch=master)](https://travis-ci.org/spalax/keywordtool-client)
[![Coverage Status](https://coveralls.io/repos/github/spalax/keywordtool-client/badge.svg?branch=master)](https://coveralls.io/github/spalax/keywordtool-client?branch=master)
# Object Orient keywordtool.io API Client

It is implementation of public API for the keywordtool.io, 
it can be reviewed here http://keywordtool.io/api/documentation

To start you will need to have an API key, which will be send to your EMAIL
or you will be able to get it after login in tab API.

## Quick start

Example using google keywords:
```php
require './vendor/autoload.php';

// Keyword which you want to research
$keyword = 'iOS';

// Trying to get all keywords related to the keyword with volume metrics
// usage country is United States (google.com) and language English
// full list of available countries and languages you can found http://keywordtool.io/api/documentation
$request = \KWTClient\RequestFactory::google($keyword)->metrics(true)->country('us')->language('en');

$client = new \KWTClient\Client('[YOUR-API-KEY]');
$response = $client->research($request);

// will display
// Array
// (
//     [0] => Array
//         (
//             [kw] => ios
//             [vol] => 74000
//         )
//    ....

print_r($response->getKeywords());
```

But service provide you possibilities to get youtube, appstore and bing keywords suggestions.

For youtube:
```php
....
$request = \KWTClient\RequestFactory::youtube('iOS');
....
```

For appstore:
```php
....
$request = \KWTClient\RequestFactory::appstore('iOS');
....
```

For bing:
```php
....
$request = \KWTClient\RequestFactory::bing('iOS');
....
```

## Supported params for request returned from RequestFactory

#### country($countryCode = 'us')
Country to looking for keyword suggestions. On example, if you will declare $countryCode = 'ar' for Argentina, it will looks for 
keywords searched via google.com.ar
List of country codes for different services available here http://keywordtool.io/api/documentation - Supported values for "country" parameter

#### language($language = 'en')
Language of the keyword suggestions. 
List of language codes for different services available here http://keywordtool.io/api/documentation - Supported values for "language" parameter

#### excludeKeywords(array $keywords = [])
Use this parameter to specify negative keywords, i.e. the keywords that you want to exclude from your results.
For example, an API call that contains "keyword=iphone&exclude=case|game|price" will return keyword suggestions
for the keyword "iphone" but there will be no keyword suggestions that contain words "case", "game", or "price".
Meaning the keyword suggestion "best iphone price" will not show up in the results.

#### metrics($flag = false)
Allows to get Search Volume, CPC and AdWords Competition data for
keywords in English language if this parameter is set to "true".

#### type($type = 'suggestions')
Type of search query.
Available types are: "suggestions" and "questions".

#### complete($flag = false)
Allows to get the full set of autocomplete results.
Please note that certain percent of requests might return an error
if this parameter is set to "true".

## Contribution
Wellcome to add anything you want to this Client.
You just need to run unit tests, to make sure that
your commit will not brake Client.
And please write unit tests for your pull requests.

```
composer install --dev
./vendor/bin/phpunit --testsuite=unit
```

## References
Full API documentation can be located http://keywordtool.io/api/documentation

## License

Use this guide. Attributions are appreciated.

## Copyright

Copyright (c) 2014-2016 Oleksii Mylotskyi

(The MIT License)
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the 'Software'), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
