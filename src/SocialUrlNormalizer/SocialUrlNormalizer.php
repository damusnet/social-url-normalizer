<?php

namespace SocialUrlNormalizer;

class SocialUrlNormalizer
{
	static $suportedSocialNetworks = array(
		'facebook',
		'twitter',
		'youtube',
		'linkedin'
	);

	public function __construct($uri)
	{
		$this->inputUri = $uri;
	}

	/**
	 * getUrlProperties
	 *
	 * @return array
	 */
	public function getProperties()
	{
		$social_network = $this->guessSocialNetwork();

		$username = $this->extractUsername($social_network);
		return array('social_network' => $social_network, 'username' => $username);
	}

	public function is($network)
	{
		return $network === $this->guessSocialNetwork();
	}

	/**
	 * guessSocialNetwork
	 *
	 * @return string
	 */
	public function guessSocialNetwork()
	{
		foreach (self::$suportedSocialNetworks as $social_network) {
			if (strpos($this->inputUri, $social_network)) {
				return $social_network;
			}
		}
		// TODO: throw Exception, could not guess Social Network
		return false;
	}

	/**
	 * extractUsername
	 *
	 * @return string
	 */
	public function extractUsername($social_network)
	{
		if (!in_array($social_network, self::$suportedSocialNetworks)) {
			// TODO: throw Exception, unsuported Social Network
			return false;
		}
		$extractSocialNetworkUsername = 'extract' . ucfirst($social_network) . 'Username';
		return $this->$extractSocialNetworkUsername();
	}

	private function regexpFactory($pattern)
	{
		return preg_replace(
			'#'
			. '(?:(?:http:|https:)//)?'
			. '(?:www.)?'
			. $pattern
			. '(?:(?:\?|\#).*)?'
			. '#u',
			'$1',
			$this->inputUri
		);
	}

	/**
	 * extractFacebookUsername
	 *
	 * @return string
	 */
	private function extractFacebookUsername()
	{
		return $this->regexpFactory(
			'(?:facebook.com/)?'
			. '(?:(?:\w)*\#!/)?'
			. '(?:pages/)?'
			. '(?:[?\p{L}\-_]*/)?'
			. '(?:[?\w\-_]*/)?'
			. '(?:profile.php\?id=(?=\d.*))?'
			. '([\d\-]*)?'
		);
	}

	/**
	 * extractTwitterUsername
	 *
	 * @return string
	 */
	private function extractTwitterUsername()
	{
		return $this->regexpFactory(
			'(?:twitter.com/)?'
			. '(?:\#!\/)?'
			. '(?:@)?'
			. '(?:[?\w\-_]*/)?'
		);
	}

	/**
	 * extractYoutubeUsername
	 *
	 * @return string
	 */
	private function extractYoutubeUsername()
	{
		return $this->regexpFactory(
			'(?:youtube.com/)?'
			. '(?:user/)?'
			. '(?:[?\w\-_]*/)?'
		);
	}

	/**
	 * extractLinkedinUsername
	 *
	 * @return string
	 */
	private function extractLinkedinUsername()
	{
		return $this->regexpFactory(
			'(?:linkedin.com/)?'
			. '(?:company/)?'
			. '(?:[?\&p{L}\-_]*/)?'
		);
	}
}