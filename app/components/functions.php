<?php

function theme_preset($default_theme)
{
	if (isset($_SESSION['theme']) == false)
		$_SESSION['theme'] = $default_theme;
}

function set_language($db)
{
	if (isset($_SESSION['language']) == false)
		if ($_SESSION['client_info']['country'] == 'Bulgaria')
			$_SESSION['language'] = 'BG';
		else if ($_SESSION['client_info']['country'] == 'Afghanistan')
			$_SESSION['language'] = 'PS';
		else
			$_SESSION['language'] = 'EN';

	$_SESSION['phrases'] = get_phrases($db);
	$_SESSION['languages'] = get_languages($db);
}

function get_phrases($db)
{
	$query = "SELECT KEY, VALUE FROM PHRASES WHERE LANGUAGE_ISO_CODE = '{$_SESSION['language']}'";
	$results = $db->query($query);

	$phrases = array();
	while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
		$phrases[$row['KEY']] = $row['VALUE'];
	}

	return $phrases;
}

function get_languages($db)
{
	$query = "SELECT ISO_CODE, NAME FROM LANGUAGES";
	$results = $db->query($query);

	$languages = array();
	while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
		$languages[] = $row;
	}

	return $languages;
}

function get_ip_information()
{
	$ip = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}


	# $ip = '52.25.109.230'; # US
	# $ip = '180.94.77.212'; # AFG
	$ipdat = @json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip=' . $ip));

	$_SESSION['client_info']['ip'] = $ip;
	$_SESSION['client_info']['country'] = $ipdat->geoplugin_countryName;
	$_SESSION['client_info']['city'] = $ipdat->geoplugin_city;
	$_SESSION['client_info']['continent'] = $ipdat->geoplugin_continentName;
	$_SESSION['client_info']['latitude'] = $ipdat->geoplugin_latitude;
	$_SESSION['client_info']['longitude'] = $ipdat->geoplugin_longitude;
	$_SESSION['client_info']['currency_symbol'] = $ipdat->geoplugin_currencySymbol;
	$_SESSION['client_info']['currency_code'] = $ipdat->geoplugin_currencyCode;
	$_SESSION['client_info']['timezone'] = $ipdat->geoplugin_timezone;
}

function log_user_visit($db, $page)
{
	$stmt = $db->prepare("INSERT INTO VISITS (PAGE, IP_HASH, COUNTRY, CITY, CONTINENT, LATITUDE, LONGITUDE, CURRENCY_SYMBOL, CURRENCY_CODE, TIMEZONE) VALUES (:page, :ip_hash, :country, :city, :continent, :latitude, :longitude, :currencySymbol, :currencyCode, :timezone)");
	$stmt->bindValue(':ip_hash', hash('sha256', 'Let\'s make it more secure with a salt value. Just in case ;)', $_SESSION['client_info']['ip']));
	$stmt->bindValue(':page', $page);
	$stmt->bindValue(':country', $_SESSION['client_info']['country']);
	$stmt->bindValue(':city', $_SESSION['client_info']['city']);
	$stmt->bindValue(':continent', $_SESSION['client_info']['continent']);
	$stmt->bindValue(':latitude', $_SESSION['client_info']['latitude']);
	$stmt->bindValue(':longitude', $_SESSION['client_info']['longitude']);
	$stmt->bindValue(':currencySymbol', $_SESSION['client_info']['currency_symbol']);
	$stmt->bindValue(':currencyCode', $_SESSION['client_info']['currency_code']);
	$stmt->bindValue(':timezone', $_SESSION['client_info']['timezone']);
	$stmt->execute();
}

function get_visitor_data($db)
{
	$last_month = date("Y-m-d", strtotime("-1 month"));

	$query = "SELECT COUNT(IP_HASH) AS USER_COUNT, COUNTRY, CITY FROM VISITS WHERE VISIT_DATETIME > '$last_month 00:00:00' GROUP BY COUNTRY, CITY ORDER BY COUNT(IP_HASH) DESC";
	$results = $db->query($query);

	$visits = array();
	while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
		$visits[] = $row;
	}
	return $visits;
}

/**
 * Generate a new CSRF token and store it in the session
 * @return string The generated CSRF token
 */
function generate_csrf_token()
{
	if (!isset($_SESSION['csrf_token'])) {
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}
	return $_SESSION['csrf_token'];
}

/**
 * Verify that the submitted CSRF token matches the one in the session
 * @param string $token The token to verify
 * @return bool Whether the token is valid
 */
function verify_csrf_token($token)
{
	if (!isset($_SESSION['csrf_token']) || !isset($token)) {
		return false;
	}

	// Use a timing-safe comparison to prevent timing attacks
	if (hash_equals($_SESSION['csrf_token'], $token)) {
		// Optional: Regenerate the token after each verification for added security
		// $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
		return true;
	}

	return false;
}

/**
 * Get all project data from the database
 * Handles translation of content based on current language
 * 
 * @param SQLite3 $db The database connection
 * @return array Array of project data
 */
function get_projects($db) {
    $query = "SELECT * FROM PROJECTS ORDER BY FEATURED DESC, ID ASC";
    $results = $db->query($query);
    
    $projects = array();
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        // Get the translated content using the keys
        $titleQuery = "SELECT VALUE FROM PHRASES WHERE KEY = '{$row['TITLE_KEY']}' AND LANGUAGE_ISO_CODE = '{$_SESSION['language']}'";
        $descriptionQuery = "SELECT VALUE FROM PHRASES WHERE KEY = '{$row['DESCRIPTION_KEY']}' AND LANGUAGE_ISO_CODE = '{$_SESSION['language']}'";
        $challengeQuery = "SELECT VALUE FROM PHRASES WHERE KEY = '{$row['CHALLENGE_KEY']}' AND LANGUAGE_ISO_CODE = '{$_SESSION['language']}'";
        $solutionQuery = "SELECT VALUE FROM PHRASES WHERE KEY = '{$row['SOLUTION_KEY']}' AND LANGUAGE_ISO_CODE = '{$_SESSION['language']}'";
        $resultQuery = "SELECT VALUE FROM PHRASES WHERE KEY = '{$row['RESULT_KEY']}' AND LANGUAGE_ISO_CODE = '{$_SESSION['language']}'";
        
        $titleResult = $db->querySingle($titleQuery);
        $descriptionResult = $db->querySingle($descriptionQuery);
        $challengeResult = $db->querySingle($challengeQuery);
        $solutionResult = $db->querySingle($solutionQuery);
        $resultResult = $db->querySingle($resultQuery);
        
        // Build the project array with decoded JSON fields and translations
        $project = [
            'image' => $row['IMAGE'],
            'tags' => json_decode($row['TAGS'], true),
            'title' => $titleResult ?: $row['TITLE_KEY'], // Fallback if translation not found
            'description' => $descriptionResult ?: $row['DESCRIPTION_KEY'],
            'challenge' => $challengeResult ?: $row['CHALLENGE_KEY'],
            'solution' => $solutionResult ?: $row['SOLUTION_KEY'],
            'result' => $resultResult ?: $row['RESULT_KEY'],
            'metrics' => json_decode($row['METRICS'], true),
            'media' => json_decode($row['MEDIA'], true)
        ];
        
        $projects[] = $project;
    }
    
    return $projects;
}
