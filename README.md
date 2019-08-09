# Sudoku-solver
This mvc php7 web app finds solutions to sudoku games.
There are 14 logical methods used to narrow down the possible numbers for each cell in the 9 by 9 grid.
If no logical change can be made, then the 15th method guesses in the first cell with only two possible numbers.
If the solution is wrong, then all the changes done since the guess are reversed, and the second number is chosen for that cell.
This app can solve sudoku games from easy to fiendish level.
Once a game is solved, the user can scroll through every single solution step generated by the code.
