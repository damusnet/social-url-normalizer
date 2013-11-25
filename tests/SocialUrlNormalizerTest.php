<?php

use SocialUrlNormalizer\SocialUrlNormalizer;

require 'SocialUrlNormalizerFixture.php';

class SocialUrlNormalizerTest extends PHPUnit_Framework_TestCase
{
	public function testGetProperties()
	{
		$social_network_urls = SocialUrlNormalizerFixture::socialNetworksUrls();
		foreach ($social_network_urls as $url => $properties) {
			$this->assertEquals($properties, SocialUrlNormalizer::getProperties($url));
		}
	}

	public function testExtractUsernames()
	{
		$suportedSocialNetworks = SocialUrlNormalizer::$suportedSocialNetworks;
		foreach ($suportedSocialNetworks as $social_network) {
			$this->extractUsernameFor($social_network);
		}
	}

	private function extractUsernameFor($social_network)
	{
		$socialNetworkUrlsFunction = $social_network . 'Urls';
		$social_network_urls = SocialUrlNormalizerFixture::$socialNetworkUrlsFunction();
		foreach ($social_network_urls as $url => $expected) {
			$this->assertEquals($expected, SocialUrlNormalizer::extractUsername($url, $social_network));
		}
	}
}