<?php
include("connect.php");
// Assuming you have established a mysqli connection in $conn
$sql = "SELECT b.*, c.category_name
FROM blogs b
INNER JOIN category c ON b.category = c.id
ORDER BY RAND()
LIMIT 50"; // Fetch 5 random blog items
$result = mysqli_query($conn, $sql);

$newBlogs = array(); // Create an empty array for new blog data

while($blog = mysqli_fetch_assoc($result)) {
  // Add the image URL and content of each blog item to the array
  $newBlogItem = array(
    'image' => $blog['image'],
    'content' => $blog['content'],
    'category' => $blog['category_name']
  );
  array_push($newBlogs, $newBlogItem);
}

// Return the new blog data as a JSON-encoded string
echo json_encode($newBlogs);

?>
