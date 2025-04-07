<?php
// Define the question pool
$questions = [
    "HTML" => [
        "100" => ["This tag is used to attach a stylesheet", "This tag is used to attach a script"],
        "200" => ["This tag is used to create a new line without css", "This is the largest heading tag"],
        "300" => ["The meaning of HTML", "This is used to start a list in HTML"],
        "400" => ["This tag  is used for hyper links", "This tag can be used to make a button that can go to another page without js"],
        "500" => ["This loads a HTML boiler plate in most IDE's", "This is the small heading tag"]
    ],
    "CSS" => [
        "100" => ["This property changes text color", "This property changes background color"],
        "200" => ["This is how you reference a class in css", "This is how you reference an id in css"],
        "300" => ["This property changes the layering level of elements", "This is how you change a cursor to a pointer"],
        "400" => ["This scales elements relative to screen size", "This is black in hex"],
        "500" => ["This scales relative to font size", "This is how many characters are in hex color definition"]
    ],
    "PHP" => [
        "100" => ["This is the php opening tag", "The symbol used to start a variable"],
        "200" => ["This is how you output text in php", "The operator used to concatenate strings"],
        "300" => ["This is how you get data from url", "This is how you send data to url"],
        "400" => ["This is how to write a loop through an array", "How  you start a session in PHP"],
        "500" => ["The function that returns the type of a variable", "The method used to open a file"]
    ],
    "JS" => [
        "100" => ["This is how you start a comment", "The keyword used to create a function"],
        "200" => ["This is how you define a non changing variable", "This is how you define a potentially changing variable"],
        "300" => ["This is an outdated assignment for a variable", "This is how you get an element by it's id"],
        "400" => ["The value returned when a variable has no value", "The object that represents the current web page"],
        "500" => ["This is how you check strict equality", "The object that represents the current browser page"]
    ]
];

// Get the category and difficulty from the form submission
$category = $_POST['category'] ?? null;
$difficulty = $_POST['difficulty'] ?? null;

// Select a random question from the pool
if ($category && $difficulty && isset($questions[$category][$difficulty])) {
    $questionPool = $questions[$category][$difficulty];
    $randomQuestion = $questionPool[array_rand($questionPool)];
} else {
    $randomQuestion = "Invalid category or difficulty.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Question</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .popup {
            background-color: white;
            border: 2px solid darkblue;
            border-radius: 10px;
            padding: 20px;
            width: 400px;
            margin: 100px auto;
            text-align: center;
        }

        .popup h2 {
            color: darkblue;
        }

        .popup p {
            font-size: 1.2rem;
        }

        .popup a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: darkblue;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .popup a:hover {
            background-color: navy;
        }
    </style>
</head>
<body>
    <div class="popup">
        <h2>Category: <?php echo htmlspecialchars($category); ?></h2>
        <p><?php echo htmlspecialchars($randomQuestion); ?></p>
        <a href="game.php">Back to Game</a>
    </div>
</body>
</html>