# Social Url Normalize

## Installation

Use composer

## Usage

### SocialUrlNormalizer::getProperties($url)

Will try and guess wich social network the $url belongs to, and extract the useful part out of it. Thus, it will only work with a fully formed url.

SocialUrlNormalizer::getProperties('https://www.facebook.com/my_page');

will return:

array('social_network' => 'facebook', 'username' => 'my_page');

### SocialUrlNormalizer::guessSocialNetwork($url)

Will try and guess wich social network the $url belongs to.

### SocialUrlNormalizer::extractUsername($uri, $social_network)

Will extract the useful part out of any input according to the given social network rules.