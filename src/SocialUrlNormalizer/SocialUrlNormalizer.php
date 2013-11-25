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

	/**
	 * extractFacebookUsername
	 *
	 * @return string
	 */
	private function extractFacebookUsername()
	{
		return preg_replace(
			'#'
			. '(?:(?:http|https)://)?'
			. '(?:www.)?'
			. '(?:facebook.com/)?'
			. '(?:(?:\w)*\#!/)?'
			. '(?:pages/)?'
			. '(?:[?\p{L}\-_]*/)?'
			. '(?:[?\w\-_]*/)?'
			. '(?:profile.php\?id=(?=\d.*))?'
			. '([\d\-]*)?'
			. '(?:\?.*)?'
			. '#u',
			'$1',
			$this->inputUri
		);
	}

	/**
	 * extractTwitterUsername
	 *
	 * @return string
	 */
	private function extractTwitterUsername()
	{
		return preg_replace(
			'#'
			. '(?:(?:http|https)://)?'
			. '(?:www.)?'
			. '(?:twitter\.com\/)?'
			. '(?:\#!\/)?'
			. '(?:@)?'
			. '([\w]+)'
			. '(?:.*)?'
			. '#',
			'$1',
			$this->inputUri
		);
	}

	/**
	 * extractYoutubeUsername
	 *
	 * @return string
	 */
	private function extractYoutubeUsername()
	{
		return preg_replace(
			'#'
			. '(?:(?:http|https)://)?'
			. '(?:www.)?'
			. '(?:youtube.com/)?'
			. '(?:user/)?'
			. '(?:[?\w\-_]*/)?'
			. '(?:\?.*)?'
			. '#u',
			'$1',
			$this->inputUri
		);
	}

	/**
	 * extractLinkedinUsername
	 *
	 * @return string
	 */
	private function extractLinkedinUsername()
	{
		return preg_replace(
			'#'
			. '(?:(?:http|https)://)?'
			. '(?:www.)?'
			. '(?:linkedin.com/)?'
			. '(?:company/)?'
			. '(?:[?\&p{L}\-_]*/)?'
			. '(?:\?.*)?'
			. '#u',
			'$1',
			$this->inputUri
		);
	}
}