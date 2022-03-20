_Any instructions/notes in italics should be removed from the template before submitting_

# Project 1
+ By: *Michael Jacobs*
+ URL: <http://e2p1.nhroyal.com>

## War planning
+ _Create an array for a deck of cards._
+ _The "deck" array should hold 4 different arrays. One for each suit._
+ _Shuffle the "deck."_
+ _Create an array for each player. Call them Player1Hand and Player2Hand._
+ _Deal 26 cards to each player. Do this by running a while loop._
+ _Create a variable drawCard._

+ _Play the game until one player has zero cards left. I will use a while loop to accomplish this._

+ _use array_shift to take the first card off, and then push it onto the appropriate playerhand._
+ _Once both players have their cards, they should take the card off the top, and place it on the board._
+ _Compare the values of player1Card and player2Card. The interesting thing will be how to compare cards. Each card should have a numerical value. The key for each card will be the name. "jack" has a value of 11. "ace" has a value of 14._
+ _The result of the comparison will either add cards to one of the player's hands or discard them._
+ _ There will also be a display of the result of each hand _
+ _A new row in the table will be created for each round._
+ _The table row will display player1Card, player2Card, result, and the number of cards in each players' hand._
+ _There will be a global variable to count the number of rounds.
+ _There will a display which tells the reader the winner.









## Outside resources
*your list of outside resources go here*
*[Matching Pennies](https://en.wikipedia.org/wiki/Matching_pennies)*
*[Stack Overflow - conditional while loop in php](https://stackoverflow.com/questions/2435457/conditional-while-loop-in-php)*
*[W3 schools - PHP if...else...elseif Statements](https://www.w3schools.com/php/php_if_else.asp)*
*[PHP create HTML table with a while loop - tutorial 09.3](https://youtu.be/N_S7_wg87GU)*
*[Allowed memory size of 33554432 bytes exhausted (tried to allocate 43148176 bytes) in php](https://stackoverflow.com/questions/415801/allowed-memory-size-of-33554432-bytes-exhausted-tried-to-allocate-43148176-byte)*


## Notes for instructor
*any notes for me to refer to while grading; if none, omit this section*
+ _I had to make decisions about how to build a deck. Idecided that each card needed a name, a suit, and a value. It was a tedious setup, but it seemeed to work well. I started the project only using hearts. I thought that I could finish the game logic, and then add the cards after. Once I completed it, I went to add the cards and ran into a memory storage problem._
+ _Because I ran out of memory, I tried creating the deck dynamically. It turned out to be "better" than hard-coding 52 cards. It did not solve my memory problem, but it did make it easier for me to create future card games, because now I have the code for a deck._


