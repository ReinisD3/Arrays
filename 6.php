<?php

$wordList = ['instrument','function','philosophy','generation'];

function choose_random_word(array $wordList):array
{
    $random_index = rand(0,count($wordList)-1);
    return str_split($wordList[$random_index]);
}
function generate(array $guessWord):array
{
    $emptyWord = [];
    foreach ($guessWord as $i)
    {
        array_push($emptyWord,'_');
    }
    return $emptyWord;
}

function display(array $guessedLetters,string $missedGuesses):void
{
    echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-".PHP_EOL.PHP_EOL;
    echo 'Guess the word:    ';
    foreach ($guessedLetters as $letter)
    {
        echo $letter.' ';
    }
    echo PHP_EOL.PHP_EOL.'Missed guesses: '.$missedGuesses.PHP_EOL.PHP_EOL;
}


function get_valid_input($guessedLetters,$missedGuesses):string
{
    $input = true;
    $guess = '';
    while($input)
    {
        $guess = readline('Make next guess: ');
        if (in_array($guess,$guessedLetters) || in_array($guess,str_split($missedGuesses)) || strlen($guess) > 1)
        {
            echo 'Wrong input or already used letter, try again : '.PHP_EOL;
        }
        else
        {
            $input = false;
        }
    }
    return $guess;
}
function check_guess($guess, $guessWord):bool
{
    return (in_array($guess,$guessWord));
}
function update_guessed_word(string $guess,array $guessedLetters, array $guessWord):array
{
    for ($i = 0 ; $i < count($guessedLetters); $i++)
    {
        if ($guess === $guessWord[$i])
        {
            $guessedLetters[$i] = $guess;
        }
    }
    return $guessedLetters;
}
function check_if_guessed(array $guessWord,array $guessedLetters):bool
{
    return $guessWord == $guessedLetters;
}

function new_game():bool
{
    return (readline("Play 'again' or 'quit'?: ") === "again");
}
//game logic
    $guessWord = choose_random_word($wordList);
    $guessedLetters = generate($guessWord);
    $missedGuesses = '';
    $gameOn = true;
    while ($gameOn) {
        display($guessedLetters, $missedGuesses);
        $guess = get_valid_input($guessedLetters, $missedGuesses);

        if (check_guess($guess, $guessWord)) {
            $guessedLetters = update_guessed_word($guess, $guessedLetters, $guessWord);
            if (check_if_guessed($guessWord, $guessedLetters)) {
                display($guessedLetters, $missedGuesses);
                echo 'YOU GOT IT!' . PHP_EOL;
                if (new_game()){
                    $guessWord = choose_random_word($wordList);
                    $guessedLetters = generate($guessWord);
                    $missedGuesses = '';
                }else{
                    $gameOn = false;
                }
            }

        } else {
            $missedGuesses .= $guess;
            if (strlen($missedGuesses) === 6) {
                echo 'You have used 6 missed tries  - GAME OVER' . PHP_EOL;
                if (new_game()){
                    $guessWord = choose_random_word($wordList);
                    $guessedLetters = generate($guessWord);
                    $missedGuesses = '';
                }else{
                    $gameOn = false;
                }
            }
        }
    }

