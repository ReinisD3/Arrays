<?php


$board = [[' ',' ',' '],[' ',' ',' '],[' ',' ',' ']];

function display_board(array $board):void
{
    echo "---+---+---\n";
    echo " {$board[0][0]} | {$board[0][1]} | {$board[0][2]} \n";
    echo "---+---+---\n";
    echo " {$board[1][0]} | {$board[1][1]} | {$board[1][2]} \n";
    echo "---+---+---\n";
    echo " {$board[2][0]} | {$board[2][1]} | {$board[2][2]} \n";
}

function clean_board():array
{
    return [[' ',' ',' '],[' ',' ',' '],[' ',' ',' ']];
}

function ask_new_game():bool
{
    if (readline('New game press y: ')==='y' )
    {
        return true;
    }else{
        return false;
    }
}


function player_turn(int $player_index):string
{
    if($player_index % 2 == 0 )
    {
        return 'X';
    }else {
        return 'O';
    }
}
function check_tie(array $board):bool
{
    foreach ($board as $row)
    {
        if (in_array(' ',$row))
        {
            return false;
        }
    }
    return true;

}

function check_for_win(array $board):bool
{

    for ($i=0; $i<3;$i++)
    {
        if ($board[$i][0] === $board[$i][1] && $board[$i][1] === $board[$i][2] && $board[$i][0] !== ' ' ) {
            return true;
        }elseif ($board[0][$i] === $board[1][$i] && $board[1][$i] === $board[2][$i] && $board[0][$i] !== ' ')
        {
            return true;
        }elseif ($board[0][0] === $board[1][1] && $board[1][1] === $board[2][2] && $board[0][0] !== ' ' )
        {
            return true;
        }elseif ($board[2][0] === $board[1][1] && $board[1][1] === $board[0][2] && $board[2][0] !== ' ')
        {
            return true;
        }
    }
   return false;

}
function get_valid_input(string $player,array $board):string
{
    $run = true;
    while($run)
    {
        $input = readline($player.", choose your location (row, column): ");
        $row = (int) $input[0];
        $column = (int) $input[2];
        if (isset($board[$row][$column]) && $board[$row][$column] === ' ')
        {
             $run = false;
        }
        else
        {
            echo 'Wrong input try again ! Valid input: row(number) space column(number) '.PHP_EOL;
        }
    }

    return $input;

}


echo 'Welcome to tic-tac-toe'.PHP_EOL;
$player_index = 1;
$game_on = true;
while ($game_on == true)
{
        display_board($board);
        $player = player_turn($player_index);
        $player_index++;
        $input = get_valid_input($player,$board);
        $row = (int) $input[0];
        $column = (int) $input[2];
        $board[$row][$column] = $player;
        if(check_for_win($board))
            {
                display_board($board);
                echo $player.' won the game'.PHP_EOL;
                if(ask_new_game())
                {
                    $board = clean_board();
                }else{
                    return $game_on = false;
                }
            }
        elseif (check_tie($board))
            {
                echo 'It is a tie'.PHP_EOL;
                if(ask_new_game())
                {
                    $board = clean_board($board);
                }else{
                    return $game_on = false;
                }
            }

}



