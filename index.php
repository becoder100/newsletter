<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech News Hub</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .hero-image {
            height: 400px;
            background: linear-gradient(45deg, #6366f1, #8b5cf6);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            transition: transform 0.2s ease-in-out;
        }
        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .category-button.active {
            background-color: #4f46e5;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Loading Spinner -->
    <div class="loading">
        <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-indigo-600"></div>
    </div>

    <!-- Navigation -->
  <!-- Navigation code to use in all pages -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="index.php" class="text-2xl font-bold text-indigo-600">TechNews</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'; ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Latest</a>
                    
                    <a href="popular.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'popular.php') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'; ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Popular</a>
                    
                    <a href="categories.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'categories.php') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'; ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Categories</a>
                </div>
            </div>
        </div>
    </div>
</nav>

    <!-- Category Filter -->
    <div class="max-w-7xl mx-auto px-4 mt-8">
        <div class="flex space-x-4 overflow-x-auto pb-4" id="categoryFilters">
            <button class="category-button active px-4 py-2 rounded-md bg-gray-200 hover:bg-indigo-600 hover:text-white" data-category="technology">Technology</button>
            <button class="category-button px-4 py-2 rounded-md bg-gray-200 hover:bg-indigo-600 hover:text-white" data-category="business">Business</button>
            <button class="category-button px-4 py-2 rounded-md bg-gray-200 hover:bg-indigo-600 hover:text-white" data-category="science">Science</button>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Featured Article -->
        <div class="mb-12" id="featuredArticle">
            <?php
            require_once 'config.php';
            $featuredNews = fetchFeaturedNews();
            if (isset($featuredNews['articles'][0])) {
                $article = $featuredNews['articles'][0];
                 
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
            ?>
        </div>
        <!-- Article Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="newsGrid">
            <?php
            $news = fetchCategoryNews('technology');
            if (isset($news['articles'])) {
                foreach ($news['articles'] as $article) {
                    echo '<div class="bg-white rounded-lg shadow-md overflow-hidden card-hover">';
                    echo '<a href="' . htmlspecialchars($article['url']) . '" target="_blank" rel="noopener noreferrer" class="block">';
                    echo '<img src="' . ($article['urlToImage'] ?? '/api/placeholder/400/250') . '" alt="Article thumbnail" class="w-full h-48 object-cover"/>';
                    echo '<div class="p-6">';
                    echo '<span class="text-indigo-600 text-sm font-medium">Technology</span>';
                    echo '<h2 class="text-xl font-semibold mt-2">' . htmlspecialchars($article['title']) . '</h2>';
                    echo '<p class="text-gray-600 mt-2">' . htmlspecialchars($article['description']) . '</p>';
                    echo '</div></a></div>';
                    
                }
            }
            
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">TechNews</h3>
                    <p class="text-gray-400">Your source for the latest technology news and insights.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                    <form class="mt-4" id="newsletterForm">
                        <input type="email" placeholder="Enter your email" class="w-full px-4 py-2 rounded-md text-gray-900">
                        <button class="mt-2 bg-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-700 w-full">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryButtons = document.querySelectorAll('.category-button');
            const newsGrid = document.getElementById('newsGrid');
            const loading = document.querySelector('.loading');

            // Newsletter form handling
            const newsletterForm = document.getElementById('newsletterForm');
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = this.querySelector('input[type="email"]').value;
                if (validateEmail(email)) {
                    fetch("/internship2/send_mail.php", {
                        method: "POST",
                       headers: {
                              "Content-Type": "application/json"
                        },
                       body: JSON.stringify({
                       email: email
                     })
                   }) 
                  .then(response => response.json())
                   .then(data => {
                         console.log("Response:", data);
                     })
                    .catch(error => {
                   console.error("Error:", error);
                   });

                    alert('Thank you for subscribing!');
                    this.reset();
                } else {
                    alert('Please enter a valid email address');
                }
            });

            // Category filter handling
            categoryButtons.forEach(button => {
                button.addEventListener('click', async function() {
                    const category = this.dataset.category;
                    
                    // Update active state
                    categoryButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Show loading
                    loading.style.display = 'flex';

                    try {
                        const response = await fetch(`get_news.php?category=${category}`);
                        const data = await response.json();
                        updateNewsGrid(data.articles);
                    } catch (error) {
                        console.error('Error fetching news:', error);
                    } finally {
                        loading.style.display = 'none';
                    }
                });
            });

            function validateEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            function updateNewsGrid(articles) {
                newsGrid.innerHTML = articles.map(article => `
                    <a href="${article.url}" target="_blank" rel="noopener noreferrer" class="block">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover">
                            <img src="${article.urlToImage || '/api/placeholder/400/250'}" alt="Article thumbnail" class="w-full h-48 object-cover"/>
                            <div class="p-6">
                                <span class="text-indigo-600 text-sm font-medium">${article.source.name}</span>
                                <h2 class="text-xl font-semibold mt-2">${article.title}</h2>
                                <p class="text-gray-600 mt-2">${article.description || ''}</p>
                            </div>
                        </div>
                    </a>
                `).join('');
            }
        });
    </script>
</body>
</html>