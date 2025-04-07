<?php
session_start();

// Define the question pool
$questions = [
    "HTML" => [
        "100" => [
            ["question" => "This tag is used to attach a stylesheet", "answer" => "<style>"],
            ["question" => "This tag is used to attach a script", "answer" => "<script>"]
        ],
        "200" => [
            ["question" => "This tag is used to create a new line without css", "answer" => "<br>"],
            ["question" => "This is the largest heading tag", "answer" => "<h1>"]
        ],
        "300" => [
            ["question" => "The meaning of HTML", "answer" => "Hyper Text Markup Language"],
            ["question" => "This is used to start a list in HTML", "answer" => "<li>"]
        ],
        "400" => [
            ["question" => "This tag  is used for hyper links", "answer" => "<a>"],
            ["question" => "This tag can be used to make a button that can go to another page without js", "answer" => "<a>"]
        ],
        "500" => [
            ["question" => "This loads a HTML boiler plate in most IDE's", "answer" => "!"],
            ["question" => "This is the small heading tag", "answer" => "<h6>"]
        ],
    ],
    "CSS" => [
        "100" => [
            ["question" => "This property changes text color", "answer" => "color:"],
            ["question" => "This property changes background color", "answer" => "background-color:"]
        ],
        "200" => [
            ["question" => "This is how you reference a class in css", "answer" => ".class"],
            ["question" => "This is how you reference an id in css", "answer" => "#id"]
        ],
        "300" => [
            ["question" => "This property changes the layering level of elements", "answer" => "z-index"],
            ["question" => "This is how you change a cursor to a pointer", "answer" => "cursor: pointer"]
        ],
        "400" => [
            ["question" => "This scales elements relative to screen size", "answer" => "%"],
            ["question" => "This is black in hex", "answer" => "#000000"]
        ],
        "500" => [
            ["question" => "This scales relative to font size", "answer" => "em"],
            ["question" => "This is how many characters are in hex color definition", "answer" => "6"]
        ],
    ],
    "PHP" => [
        "100" => [
            ["question" => "This is the php opening tag", "answer" => "<?php"],
            ["question" => "The symbol used to start a variable", "answer" => "$"]
        ],
        "200" => [
            ["question" => "This is how you output text in php", "answer" => "echo"],
            ["question" => "The operator used to concatenate strings", "answer" => "."]
        ],
        "300" => [
            ["question" => "This function is used to include the contents of one PHP file into another", "answer" => "include()"],
            ["question" => "This function is used to check if a variable is set and not null", "answer" => "isset()"]
        ],
        "400" => [
            ["question" => "This is how to write a loop through an array", "answer" => "foreach"],
            ["question" => "How you start a session in PHP", "answer" => "session_start()"]
        ],
        "500" => [
            ["question" => "The function that returns the type of a variable", "answer" => "gettype()"],
            ["question" => "The method used to open a file", "answer" => "fopen()"]
        ],
    ],
    "JS" => [
        "100" => [
            ["question" => "This is how you start a comment", "answer" => "//"],
            ["question" => "The keyword used to create a function", "answer" => "function"]
        ],
        "200" => [
            ["question" => "This is how you define a non changing variable", "answer" => "const?"],
            ["question" => "This is how you define a potentially changing variable", "answer" => "let"]
        ],
        "300" => [
            ["question" => "This is an outdated assignment for a variable", "answer" => "var"],
            ["question" => "This is how you get an element by it's id", "answer" => "document.getElementById('id')"]
        ],
        "400" => [
            ["question" => "The value returned when a variable has no value", "answer" => "undefined"],
            ["question" => "The object that represents the current web page", "answer" => "document"]
        ],
        "500" => [
            ["question" => "This is how you check strict equality", "answer" => "==="],
            ["question" => "The object that represents the current browser page", "answer" => "window"]
        ],
    ]
];

// Get the category and difficulty from the form submission
$category = $_POST['category'] ?? null;
$difficulty = $_POST['difficulty'] ?? null;

// Select a random question from the pool
if ($category && $difficulty && isset($questions[$category][$difficulty])) {
    $questionPool = $questions[$category][$difficulty];
    $selectedQuestion = $questionPool[array_rand($questionPool)];
    $question = $selectedQuestion['question'];
    $correctAnswer = strtolower($selectedQuestion['answer']);

    // Store the correct answer in the session for validation
    $_SESSION['current_question'] = [
        'category' => $category,
        'difficulty' => $difficulty,
        'question' => $question,
        'answer' => $correctAnswer
    ];
} else {
    $question = "Invalid category or difficulty.";
    $correctAnswer = null;
}

// Determine the current player
$currentPlayer = $_SESSION['current_turn'] ?? 'Player 1';

// Handle answer submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $playerAnswer = strtolower(trim($_POST['answer']));
    $storedQuestion = $_SESSION['current_question'] ?? null;

    if ($storedQuestion && $playerAnswer === $storedQuestion['answer']) {
        // Update scores if the answer is correct
        if ($currentPlayer === 'Player 1') {
            $_SESSION['player1_score'] += (int)$storedQuestion['difficulty'];
        } else {
            $_SESSION['player2_score'] += (int)$storedQuestion['difficulty'];
        }

        // Redirect back to the game with a success message
        header("Location: game.php?answer_correct=true");
        exit();
    } else {
        // Redirect back to the game with a failure message
        header("Location: game.php?answer_correct=false");
        exit();
    }
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

        .popup form {
            margin-top: 20px;
        }

        .popup input[type="text"] {
            padding: 10px;
            width: 80%;
            border: 1px solid darkblue;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .popup input[type="submit"] {
            padding: 10px 15px;
            background-color: darkblue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup input[type="submit"]:hover {
            background-color: navy;
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
        <p><?php echo htmlspecialchars($question); ?></p><br/>
        <p><?php echo htmlspecialchars($currentPlayer); ?>'s Answer:</p>
        <form action="question.php" method="post">
            <input type="text" name="answer" placeholder="What is" required>
            <input type="submit" value="Submit Answer">
        </form>
        <a href="game.php">Back to Game</a>
    </div>
</body>
</html>