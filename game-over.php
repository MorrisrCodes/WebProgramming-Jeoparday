<?php
session_start();

// Check if the game is over (all questions used)
$totalQuestions = 20; // Total number of questions in the game (5 categories x 4 difficulties)
$usedQuestions = isset($_SESSION['used_questions']) ? count($_SESSION['used_questions']) : 0;

if ($usedQuestions < $totalQuestions) {
    // Redirect back to the game if the game is not over
    header("Location: game.php");
    exit();
}

// Determine the winner
$player1Score = $_SESSION['player1_score'] ?? 0;
$player2Score = $_SESSION['player2_score'] ?? 0;

if ($player1Score > $player2Score) {
    $winner = "Player 1";
    $winnerScore = $player1Score;
} elseif ($player2Score > $player1Score) {
    $winner = "Player 2";
    $winnerScore = $player2Score;
} else {
    $winner = "It's a tie!";
    $winnerScore = $player1Score; // Both scores are the same
}

// Reset the session to allow a new game
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Confetti container */
        .confetti-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        /* Individual confetti pieces */
        .confetti {
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: red;
            animation: fall 3s linear infinite;
        }

        /* Different colors for confetti */
        .confetti:nth-child(2n) { background-color: blue; }
        .confetti:nth-child(3n) { background-color: yellow; }
        .confetti:nth-child(4n) { background-color: green; }
        .confetti:nth-child(5n) { background-color: purple; }

        /* Falling animation */
        @keyframes fall {
            0% {
                transform: translateY(-100%) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Randomize confetti positions and animation delays */
        <?php for ($i = 1; $i <= 50; $i++): ?>
        .confetti:nth-child(<?php echo $i; ?>) {
            left: <?php echo rand(0, 100); ?>%; /* Random horizontal position */
            animation-delay: <?php echo rand(0, 3000) / 1000; ?>s; /* Random animation delay */
            animation-duration: <?php echo rand(2000, 5000) / 1000; ?>s; /* Random animation duration */
        }
        <?php endfor; ?>

        .game-over-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgb(73, 73, 255);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .game-over-container h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .game-over-container p {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .game-over-container a,
        .game-over-container form button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: darkblue;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2rem;
            border: none;
            cursor: pointer;
        }

        .game-over-container a:hover,
        .game-over-container form button:hover {
            background-color: navy;
        }

        .game-over-container form {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="game-over-container">
        <div class="confetti-container">
            <!-- Generate 50 confetti pieces -->
            <?php for ($i = 1; $i <= 50; $i++): ?>
                <div class="confetti"></div>
            <?php endfor; ?>
        </div>
        <h1>Game Over!</h1>
        <?php if ($winner === "It's a tie!") : ?>
            <p>It's a tie! Both players scored <?php echo htmlspecialchars($winnerScore); ?> points.</p>
        <?php else : ?>
            <p>Congratulations, <?php echo htmlspecialchars($winner); ?>!</p>
            <p>You won with a score of <?php echo htmlspecialchars($winnerScore); ?> points.</p>
        <?php endif; ?>
        <a href="game.php">Start a New Game</a>
        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>