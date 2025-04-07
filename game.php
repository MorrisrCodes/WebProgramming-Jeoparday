<?php
session_start();

// Ensure the session variables are initialized
if (!isset($_SESSION['player1_score'])) {
    $_SESSION['player1_score'] = 0;
}
if (!isset($_SESSION['player2_score'])) {
    $_SESSION['player2_score'] = 0;
}
if (!isset($_SESSION['current_turn'])) {
    $_SESSION['current_turn'] = 'Player 1';
}

// Toggle the turn if the answer was incorrect
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer_correct'])) {
    if ($_POST['answer_correct'] === 'false') {
        $_SESSION['current_turn'] = $_SESSION['current_turn'] === 'Player 1' ? 'Player 2' : 'Player 1';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <div id="page">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Web Programming Jeopardy</title>
            <link rel="stylesheet" href="style.css" />
            <link rel="icon" href="images/favicon.png" type="image/x-icon" />
            <style>
                #turn-indicator {
                    position: absolute;
                    top: 20px;
                    left: 20px;
                    padding: 10px 15px;
                    background-color: darkblue;
                    color: white;
                    border-radius: 5px;
                    font-size: 1.2rem;
                }
            </style>
        </head>
        <header>
            <h1>Web Programming Jeopardy</h1>
        </header>
        <body>
            <div id="turn-indicator">
                Current Turn: <?php echo htmlspecialchars($_SESSION['current_turn']); ?>
            </div>
            <main>
                <div id="leftpbox">
                    <div id="leftscorebox">
                        <h3>Score: <?php echo $_SESSION['player1_score']; ?></h3>
                    </div>
                    <img id='redp' src="red.png"/>
                    <div id="leftnamebox">
                        <h2>Player 1</h2>
                    </div>
                </div>
                <section>
                    <div id="categorybox">
                        <table>
                            <tr>
                                <th>HTML</th>
                                <th>CSS</th>
                                <th>PHP</th>
                                <th>JS</th>
                            </tr>
                        </table>
                    </div>
                    <div id="questionbox">
                        <table>
                            <!-- 100 Point Questions -->
                            <tr>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="HTML">
                                        <input type="hidden" name="difficulty" value="100">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">100</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="CSS">
                                        <input type="hidden" name="difficulty" value="100">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">100</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="PHP">
                                        <input type="hidden" name="difficulty" value="100">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">100</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="JS">
                                        <input type="hidden" name="difficulty" value="100">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">100</button>
                                    </form>
                                </th>
                            </tr>
                            <!-- 200 Point Questions -->
                            <tr>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="HTML">
                                        <input type="hidden" name="difficulty" value="200">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">200</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="CSS">
                                        <input type="hidden" name="difficulty" value="200">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">200</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="PHP">
                                        <input type="hidden" name="difficulty" value="200">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">200</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="JS">
                                        <input type="hidden" name="difficulty" value="200">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">200</button>
                                    </form>
                                </th>
                            </tr>
                            <!-- 300 Point Questions -->
                            <tr>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="HTML">
                                        <input type="hidden" name="difficulty" value="300">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">300</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="CSS">
                                        <input type="hidden" name="difficulty" value="300">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">300</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="PHP">
                                        <input type="hidden" name="difficulty" value="300">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">300</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="JS">
                                        <input type="hidden" name="difficulty" value="300">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">300</button>
                                    </form>
                                </th>
                            </tr>
                            <!-- 400 Point Questions -->
                            <tr>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="HTML">
                                        <input type="hidden" name="difficulty" value="400">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">400</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="CSS">
                                        <input type="hidden" name="difficulty" value="400">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">400</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="PHP">
                                        <input type="hidden" name="difficulty" value="400">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">400</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="JS">
                                        <input type="hidden" name="difficulty" value="400">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">400</button>
                                    </form>
                                </th>
                            </tr>
                            <!-- 500 Point Questions -->
                            <tr>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="HTML">
                                        <input type="hidden" name="difficulty" value="500">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">500</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="CSS">
                                        <input type="hidden" name="difficulty" value="500">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">500</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="PHP">
                                        <input type="hidden" name="difficulty" value="500">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">500</button>
                                    </form>
                                </th>
                                <th>
                                    <form action="question.php" method="post">
                                        <input type="hidden" name="category" value="JS">
                                        <input type="hidden" name="difficulty" value="500">
                                        <button type="submit" style="all: unset; cursor: pointer; color: gold;">500</button>
                                    </form>
                                </th>
                            </tr>
                        </table>
                    </div>
                </section>
                <div id="rightpbox">
                    <div id="rightscorebox">
                        <h3>Score: <?php echo $_SESSION['player2_score']; ?></h3>
                    </div>
                    <img id="bluep" src="blue.png"/>
                    <div id="rightnamebox">
                        <h2>Player 2</h2>
                    </div>
                </div>
            </main>
        </body>
        <footer>

        </footer>
    </div>
    <form action="logout.php" method="post" style="position: absolute; top: 20px; right: 20px;">
        <button type="submit" style="padding: 10px 15px; background-color: darkblue; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Logout
        </button>
    </form>
</html>