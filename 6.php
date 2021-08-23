<?php



$wordList = ['instrument','function','philosophy','generation'];

function choose_random_word(array $wordList):array
{
    $random_index = rand(0,count($wordList)-1);
    return str_split($wordList[$random_index]);
}
function generate(array $guessing_word):array
{
    $arr = [];
    foreach ($guessing_word as $i)
    {
        array_push($arr,'_');
    }
    return $arr;
}

function display(array $guessed_name_array,string $missedGuesses):void
{


    echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-".PHP_EOL.PHP_EOL;
    echo 'Guess the word:    ';
    foreach ($guessed_name_array as $letter)
    {
        echo $letter.' ';
    }
    echo PHP_EOL.PHP_EOL.'Missed guesses: '.$missedGuesses.PHP_EOL.PHP_EOL;

}


function get_valid_input($alreadyGuessed,$missedGuesses):string
{
    $input = true;
    while($input)
    {
        $guess = readline('Make next guess: ');
        if (in_array($guess,$alreadyGuessed) || in_array($guess,str_split($missedGuesses)) || strlen($guess) > 1)
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
    if(in_array($guess,$guessWord))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function update_guessed_word(string $guess,array $alreadyGuessed, array $guessWord):array
{
    for ($i = 0 ; $i < count($alreadyGuessed); $i++)
    {
        if ($guess === $guessWord[$i])
        {
            $alreadyGuessed[$i] = $guess;
        }
    }
    return $alreadyGuessed;
}

function check_if_guessed(array $guessWord,array $alreadyGuessed):bool
{
    if($guessWord == $alreadyGuessed)
    {
        return true;
    }
    return false;
}

function new_game():bool
{
    if (readline("Play 'again' or 'quit'?: ") === "again")
    {

        return true;
    }
    return false;

}



//game logic


    $guessWord = choose_random_word($wordList);
    $alreadyGuessed = generate($guessWord);
    $missedGuesses = '';
    $gameOn = true;

    while ($gameOn) {

        display($alreadyGuessed, $missedGuesses);
        $guess = get_valid_input($alreadyGuessed, $missedGuesses);

        if (check_guess($guess, $guessWord)) {
            $alreadyGuessed = update_guessed_word($guess, $alreadyGuessed, $guessWord);
            if (check_if_guessed($guessWord, $alreadyGuessed)) {
                display($alreadyGuessed, $missedGuesses);
                echo 'YOU GOT IT!' . PHP_EOL;
                if (new_game()){
                    $guessWord = choose_random_word($wordList);
                    $alreadyGuessed = generate($guessWord);
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
                    $alreadyGuessed = generate($guessWord);
                    $missedGuesses = '';
                }else{
                    $gameOn = false;
                }
            }
        }
    }

