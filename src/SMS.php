<?php

namespace APIMaster\SMS;

class SMS {

	private static $api_key = null;

	private static $error = null;

	/**
	 * Get web service information
	 *
	 * @return bool|string
	 */
	static function info() {
		return self::request( 'sms/v1' );
	}

	/**
	 * Get list of sent sms
	 *
	 * @return bool|string
	 */
	static function list() {
		return self::request( 'sms/v1/list' );
	}

	/**
	 * Get list of variables
	 *
	 * @return bool|string
	 */
	static function vars() {
		return self::request( 'sms/v1/vars' );
	}

	/**
	 * Get list of patterns
	 *
	 * @return bool|string
	 */
	static function patterns() {
		return self::request( 'sms/v1/patterns' );
	}

	/**
	 * Get list of patterns
	 *
	 * @param       $phone
	 * @param int $pattern_id
	 * @param array $vars
	 *
	 * @return bool|string
	 */
	static function send( $phone, int $pattern_id, array $vars ) {
		$data = [
			'phone'      => $phone,
			'pattern_id' => $pattern_id,
			'data'       => $vars,
		];

		return self::request( 'sms/v1/send', $data );
	}

	/**
	 * Get status of a message
	 *
	 * @param int $message_id
	 *
	 * @return bool|string
	 */
	static function status( int $message_id ) {
		return self::request( 'sms/v1/status', [ 'message_id' => $message_id ] );
	}

	/**
	 * Get api key information
	 *
	 * @return bool|string
	 */
	static function key() {
		return self::request( 'sms_key' );
	}

	/**
	 * @return string
	 */
	public static function getApiKey() {
		return self::$api_key;
	}

	/**
	 * @param string $api_key
	 */
	public static function setApiKey( string $api_key ) {
		self::$api_key = $api_key;
	}

	/**
	 * @return null
	 */
	public static function getError() {
		return self::$error;
	}

	/**
	 * @param string $endpoint
	 * @param array $data
	 *
	 * @return bool|string
	 */
	private static function request( string $endpoint, array $data = array() ) {
		$curl = curl_init();

		$url = sprintf( 'http://api.apimaster.ir/%s/%s', self::$api_key, $endpoint );

		curl_setopt_array( $curl, [
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => count( $data ) ? 'POST' : 'GET',
			CURLOPT_POSTFIELDS     => http_build_query( $data ),
			CURLOPT_HTTPHEADER     => [
				"Accept: application/json",
				"cache-control: no-cache",
			],
		] );

		$response = curl_exec( $curl );
		$error    = curl_error( $curl );

		curl_close( $curl );

		if ( $error ) {
			self::$error = "cURL Error #: " . $error;

			return [
				'success' => false,
				'message' => 'خطا در ارتباط با سرور'
			];
		}

		return json_decode( $response );
	}
}
