<?php
include 'plugin/head.php';
include 'db.php';

// Fetch products from the database
$query = "SELECT `product_id`, `name`, `description`, `price`, `image`, `stock_quantity`, `created_at`, `updated_at` FROM `products` WHERE 1";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>/* Resetting some base styles */
/* Resetting some base styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Body Styling */
body {
  font-family: 'MedievalSharp', cursive;
  display: flex;
  flex-direction: column; /* Flex column layout to manage content and footer */
  min-height: 100vh; /* Ensure the body takes at least the full height of the screen */
  background-color: #f4f4f4;
  overflow-x: hidden; /* Prevent horizontal scrolling */
}

/* Main Content Styling */
.main-content {
  flex-grow: 1; /* Allows the main content to grow and take available space */
  padding: 20px;
  background-color: #f9f9f9;
  transition: all 0.3s ease-in-out;
  background: url('../uploads/liberator.png') no-repeat center center/cover;
  background-size: cover;
  overflow-y: auto; /* Allow vertical scrolling if content exceeds the viewport */
}

/* Welcome Animation */
.welcome-message {
  opacity: 0;
  animation: slideIn 2s forwards;
  font-size: 2.5rem;
  color: #ff9f00;
  text-align: center;
}

@keyframes slideIn {
  0% {
    transform: translateX(-100%);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

/* Cards Container */
.cards-container {
  display: flex;
  flex-wrap: wrap; /* Allow cards to wrap to the next row */
  justify-content: space-between; /* Distribute cards evenly */
  padding: 20px;
}

.cards-container .card {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  width: 100%;
  max-width: 350px; /* Optional: max-width for the cards */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out;
  margin: 15px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.card:hover {
  transform: scale(1.05); /* Slight zoom effect on hover */
}

/* Product Image Styling */
.card img {
  width: 100%;
  height: 200px; /* Fixed height for the image */
  object-fit: cover; /* Ensure the image fills the space without distortion */
  border-radius: 5px;
  margin-bottom: 15px;
}

/* Product Title */
.card h3 {
  font-size: 1.5rem;
  color: #333;
  margin-bottom: 10px;
}

/* Product Description */
.card p {
  font-size: 1rem;
  color: #666;
  margin-bottom: 15px;
}

/* Product Price Styling */
.card .price {
  font-size: 1.2rem;
  color: #f44336;
  margin-top: 10px;
  font-weight: bold; /* Make the price stand out */
}

/* Responsive Design for Cards */
@media (max-width: 768px) {
  .cards-container .card {
    width: 100%; /* Full-width cards on small screens */
    max-width: 90%;
  }

  .card img {
    height: 180px; /* Adjust image height for smaller screens */
  }

  .card h3 {
    font-size: 1.2rem; /* Adjust title font size */
  }

  .card p {
    font-size: 0.9rem; /* Adjust description font size */
  }
}

@media (max-width: 480px) {
  .cards-container .card {
    width: 100%; /* Cards should take up full width on very small screens */
    max-width: 90%;
  }

  .card img {
    height: 150px; /* Adjust image height for very small screens */
  }

  .card h3 {
    font-size: 1rem; /* Further reduce the title size */
  }

  .card p {
    font-size: 0.85rem; /* Further reduce description size */
  }

  .card .price {
    font-size: 1rem; /* Slightly smaller price */
  }
}

/* Logout Button Styling */
.logout-btn {
  background-color: #f44336;
  color: white;
  padding: 10px 20px;
  font-size: 1.1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: 150px;
  text-align: center;
  margin-top: 20px;
}

.logout-btn:hover {
  background-color: #d32f2f;
}

</style>
</head>
<body>

    <!-- Sidebar -->
  

    <!-- Main Content -->
    <div class="main-content">
        <!-- Animated Welcome Message -->
        <div class="welcome-message">
            Welcome to SPO Admin Dashboard
        </div>

        <!-- Cards Container -->
        <div class="cards-container">
            <?php
            // Loop through the fetched products and display them in cards
            if (mysqli_num_rows($result) > 0) {
                while ($product = mysqli_fetch_assoc($result)) {
                    echo '<div class="card">';
                    if ($product['image']) {
                        echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '">';
                    }
                    echo '<h3>' . $product['name'] . '</h3>';
                    echo '<p>' . $product['description'] . '</p>';
                    echo '<div class="price">₱' . number_format($product['price'], 2) . '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found.</p>';
            }
            ?>
        </div>
    </div>
    <footer>
        <?php include 'plugin/footer.php'; ?>
    </footer>

</body>
</html>
