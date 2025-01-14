<?php
// Define constants
define('NEWS_API_KEY', '0a5a8e4e2b3849e8b94c7e438e088246');
define('NEWS_API_ENDPOINT', 'https://newsapi.org/v2/');

// Helper function to make API requests
function makeApiRequest($endpoint, $params = []) {
    $url = NEWS_API_ENDPOINT . $endpoint . '?' . http_build_query($params);
    
    // Initialize cURL
    $ch = curl_init($url);
    if ($ch === false) {
        die('Failed to initialize cURL');
    }

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: PHP News Fetcher/1.0'
    ]);
    
    // Execute cURL request
    $response = curl_exec($ch);
    if ($response === false) {
        die('cURL error: ' . curl_error($ch));
    }

    curl_close($ch);

    // Decode JSON response
    return json_decode($response, true);
}

// Function to fetch latest news
function fetchNews($category = 'technology', $pageSize = 6) {
    return makeApiRequest('top-headlines', [
        'category' => $category,
        'pageSize' => $pageSize,
        'apiKey' => NEWS_API_KEY,
        'language' => 'en'
    ]);
}

// Function to fetch featured news
function fetchFeaturedNews() {
    return fetchNews('technology', 1);
}

// Function to fetch news by category
function fetchCategoryNews($category) {
    return fetchNews($category, 6);
}

// Function to fetch popular news
function fetchPopularNews($pageSize = 12) {
    return makeApiRequest('everything', [
        'sortBy' => 'popularity',
        'pageSize' => $pageSize,
        'apiKey' => NEWS_API_KEY,
        'language' => 'en',
        'domains' => 'techcrunch.com,wired.com,theverge.com'
    ]);
}
?>
