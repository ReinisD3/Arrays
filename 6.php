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

function display_top(array $guessed_name_array,string $missed_guesses):void
{


    echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-".PHP_EOL.PHP_EOL;
    echo 'Guess the word:    ';
    foreach ($guessed_name_array as $letter)
    {
        echo $letter.' ';
    }
    echo PHP_EOL.PHP_EOL.'Missed guesses: '.$missed_guesses.PHP_EOL.PHP_EOL;

}


function get_valid_input($guessed_word_array,$missed_guesses):string
{
    $input = true;
    while($input)
    {
        $guess = readline('Make next guess: ');
        if (in_array($guess,$guessed_word_array) || in_array($guess,str_split($missed_guesses)) || strlen($guess) > 1)
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

function check_guess($guess, $guessing_word_array):bool
{
    if(in_array($guess,$guessing_word_array))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function update_guessed_word_array(string $guess,array $guessed_word_array, array $guessing_word_array):array
{
    for ($i = 0 ; $i < count($guessed_word_array); $i++)
    {
        if ($guess === $guessing_word_array[$i])
        {
            $guessed_word_array[$i] = $guess;
        }
    }
    return $guessed_word_array;
}

function check_if_guessed(array $guessing_word_array,array $guessed_word_array):bool
{
    if($guessing_word_array == $guessed_word_array)
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


    $guessing_word_array = choose_random_word($wordList);
    $guessed_word_array = generate($guessing_word_array);
    $missed_guesses = '';
    $game_on = true;

    while ($game_on) {

        display_top($guessed_word_array, $missed_guesses);
        $guess = get_valid_input($guessed_word_array, $missed_guesses);

        if (check_guess($guess, $guessing_word_array)) {
            $guessed_word_array = update_guessed_word_array($guess, $guessed_word_array, $guessing_word_array);
            if (check_if_guessed($guessing_word_array, $guessed_word_array)) {
                display_top($guessed_word_array, $missed_guesses);
                echo 'YOU GOT IT!' . PHP_EOL;
                if (new_game()){
                    $guessing_word_array = choose_random_word($wordList);
                    $guessed_word_array = generate($guessing_word_array);
                    $missed_guesses = '';
                }else{
                    $game_on = false;
                }

            }

        } else {
            $missed_guesses .= $guess;
            if (strlen($missed_guesses) === 6) {
                echo 'You have used 6 missed tries  - GAME OVER' . PHP_EOL;
                if (new_game()){
                    $guessing_word_array = choose_random_word($wordList);
                    $guessed_word_array = generate($guessing_word_array);
                    $missed_guesses = '';
                }else{
                    $game_on = false;
                }
            }
        }
    }

