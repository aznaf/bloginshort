<?php
include("autoload.php");
include("connect.php");
include("pixabay.php");
include("pexels.php");
include("gpt.php");


// get random category
// Select a random category from the category table
$sql = "SELECT * FROM category ORDER BY RAND() LIMIT 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    // Retrieve the ID of the randomly selected category
    $category_id = $row["id"];
    $category = $row["category_name"];
    echo $category;
  }
} else {
  $category = "Grwoing Tots Preschool and Daycare";
}


// get image from pixabay and save to images folder
$largeimageslist = getpixabay($category);
if(empty($largeimageslist)){
    $largeimageslist = getpexels($category);
}
$random_index = array_rand($largeimageslist);
$random_image = $largeimageslist[$random_index];

$url = $random_image;  // replace with the actual image URL
$filename = basename($url);  // extract the filename from the URL
$folder = 'images/';  // specify the folder where you want to save the image

// download the image from the URL
$data = file_get_contents($url);

// save the downloaded image to the specified folder
$file = fopen($folder . $filename, "w");
fwrite($file, $data);
fclose($file);

$image = $folder . $filename;


// create blog content 
$content = gpt("write a small article less than 100 words which is apealing to parents and make them to think title : ".$category);
echo "\n".$content;

// define the query to insert data into the blogs table
$sql = "INSERT INTO blogs (content, image, category, timestamp) VALUES (?, ?, ?, NOW())";

// prepare the statement
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    echo "Error preparing blog data: " . mysqli_error($conn);
} else {
    // bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "ssi", $content, $image, $category_id);

    // execute the statement
    if(mysqli_stmt_execute($stmt)) {
        echo "Blog saved successfully.";
    } else {
        echo "Error saving blog data: " . mysqli_stmt_error($stmt);
    }

    // close the statement
    mysqli_stmt_close($stmt);
}
