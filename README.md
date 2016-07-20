# Mbiz_Twitter

This module, for now, allows you to send a tweet like this:

```php
$twitter = Mage::getSingleton('mbiz_twitter/api');
$twitter->tweet("Hello World!");
```

But before that, you have to configure the access tokens.

If you don't have a Twitter app you can
[create one in the apps center](https://apps.twitter.com/app/new).

## Configuration

To configure it you have to set the following configuration:

```xml
<?xml version="1.0" encoding="utf-8"?>
<config>
    <!-- … -->
    <default>
        <mbiz_twitter>
            <general>
                <oauth_access_token/>
                <oauth_access_token_secret/>
                <consumer_key/>
                <consumer_secret/>
            </general>
        </mbiz_twitter>
    </default>
</config>
```

You can of course set it by using a `system.xml` file with your configuration
fields to manage it in admin panel.

