<?php
// popular.php
require_once 'config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular News - Tech News Hub</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            transition: transform 0.2s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="index.php" class="text-2xl font-bold text-indigo-600">TechNews</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="index.php" class="border-transparent text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Latest</a>
                        <a href="popular.php" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Popular</a>
                        <a href="categories.php" class="border-transparent text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Categories</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Popular News</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="popularNewsGrid">
            <?php
            $popularNews = fetchPopularNews();
            if (isset($popularNews['articles'])) {
                foreach ($popularNews['articles'] as $article) {
                    
                    echo '<div class="bg-white rounded-lg shadow-md overflow-hidden card-hover">';
                    echo '<a href="' . htmlspecialchars($article['url']) . '" target="_blank" rel="noopener noreferrer">';
                    echo '<img src="' . ($article['urlToImage'] ?? '/api/placeholder/400/250') . '" alt="Article thumbnail" class="w-full h-48 object-cover"/>';
                    echo '<div class="p-6">';
                    echo '<span class="text-indigo-600 text-sm font-medium">' . htmlspecialchars($article['source']['name']) . '</span>';
                    echo '<h2 class="text-xl font-semibold mt-2">' . htmlspecialchars($article['title']) . '</h2>';
                    echo '<p class="text-gray-600 mt-2">' . htmlspecialchars($article['description']) . '</p>';
                    echo '<div class="mt-4">';
                    echo '<span class="text-sm text-gray-500">' . date('M d, Y', strtotime($article['publishedAt'])) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                    
                }
            }
            ?>
        </div>
    </main>

    <!-- Footer included here -->
</body>
</html>