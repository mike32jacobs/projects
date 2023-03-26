var playerTurn = "O";
var gameOn = true;
var winner = "No Winner";
// for (i = 1; i <= 5; i++) {
// 	document.write("hello");
// }

// royals = {
// 	teamName: "Royals",
// 	color1: "#174885",
// 	color2: "#c0995a",
// 	color3: "#7bb2dd",
// };
// redsox = {
// 	teamName: "Red Sox",
// 	color1: "#BD3039",
// 	color2: "#0C2340",
// 	color3: "#FFFFFF",
// };
// astros = {
// 	teamName: "Astros",
// 	color1: "#002D62",
// 	color2: "#EB6E1F",
// 	color3: "#F4911E",
// };
// var themes = [royals, redsox, astros];
// var teams = ["Royals", "Red Sox", "Astros"];

// JSON generated from chat GPT
const themes = {
	Diamondbacks: {
		primary: "#A71930",
		secondary: "#E3D4AD",
		tertiary: "#000000",
		quaternary: "#FFFFFF",
	},
	Braves: {
		primary: "#CE1141",
		secondary: "#13274F",
	},
	Orioles: {
		primary: "#DF4601",
		secondary: "#000000",
	},
	"Red Sox": {
		primary: "#BD3039",
		secondary: "#0C2340",
	},
	Cubs: {
		primary: "#0E3386",
		secondary: "#CC3433",
	},
	"White Sox": {
		primary: "#000000",
		secondary: "#C4CED4",
	},
	Reds: {
		primary: "#C6011F",
		secondary: "#000000",
	},
	Indians: {
		primary: "#0C2340",
		secondary: "#E31937",
		tertiary: "#1C2841",
	},
	Rockies: {
		primary: "#33006F",
		secondary: "#C4CED4",
		tertiary: "#231F20",
	},
	Tigers: {
		primary: "#0C2340",
		secondary: "#FA4616",
	},
	Astros: {
		primary: "#EB6E1F",
		secondary: "#002D62",
	},
	Royals: {
		primary: "#174884",
		secondary: "#C09A5B",
		tertiary: "#7bb2dd",
	},
	Angels: {
		primary: "#BA0021",
		secondary: "#003263",
	},
	Dodgers: {
		primary: "#005A9C",
		secondary: "#EF3E42",
	},
	Marlins: {
		primary: "#00A3E0",
		secondary: "#EF3E42",
		tertiary: "#F0A133",
		quaternary: "#000000",
	},
	Brewers: {
		primary: "#0A2351",
		secondary: "#B6922E",
	},
	Twins: {
		primary: "#0C2340",
		secondary: "#BA0C2F",
	},
	Mets: {
		primary: "#002D72",
		secondary: "#FF5910",
	},
	Yankees: {
		primary: "#0C2340",
		secondary: "#C4CED4",
	},
	Athletics: {
		primary: "#003831",
		secondary: "#EFB21E",
	},
	Phillies: {
		primary: "#E81828",
		secondary: "#002D72",
	},
	Pirates: {
		primary: "#27251F",
		secondary: "#FDB827",
	},
	Padres: {
		primary: "#2F241D",
		secondary: "#FFC425",
		// tertiary: "#A2AAAD",
		// quaternary: "#FFC425",
	},
	Giants: {
		primary: "#FD5A1E",
		secondary: "#27251F",
		tertiary: "#8B6F4E",
		quaternary: "#FFFFFF",
	},
	Mariners: {
		primary: "#0C2C56",
		secondary: "#C4CED4",
		tertiary: "#005C5C",
	},
	Cardinals: {
		primary: "#C41E3A",
		secondary: "#0C2340",
		tertiary: "#FEDB00",
	},
	Rays: {
		primary: "#8FBCE6",
		secondary: "#092C5C",
		tertiary: "#F5D130",
	},
	Rangers: {
		primary: "#C0111F",
		secondary: "#003278",
		tertiary: "#0C2C56",
	},
	"Blue Jays": {
		primary: "#134A8E",
		secondary: "#1D2D5C",
	},
	Nationals: {
		primary: "#AB0003",
		secondary: "#14225A",
	},
};

function newGame() {
	playerTurn = "X";
	makeBoard();
	gameOn = true;
	winner = "No Winner";
	displayNextPlayer();
	let squares = document.getElementsByClassName("square");

	for (let i = 0; i < 9; i++) {
		// squares[i].innerHTML = "";
		squares[i].setAttribute("data-state", "OPEN");
		squares[i].addEventListener("click", clickSquare);
	}

	// console.log(htmlstring);
}
function changeTheme(team) {
	// how many official colors? should be 2, 3, or 4
	let numColors = Object.keys(team).length;
	console.log(numColors);

	// Get the root element
	var r = document.querySelector(":root");

	// Get the styles (properties and values) for the root
	var rs = getComputedStyle(r);

	r.style.setProperty("--color1", team.primary);
	r.style.setProperty("--color2", team.secondary);
	if (numColors == 2) {
		r.style.setProperty("--color3", "gray");
		r.style.setProperty("--color4", "white");
	} else if (numColors == 3) {
		r.style.setProperty("--color3", team.tertiary);
		r.style.setProperty("--color4", "white");
	} else {
		r.style.setProperty("--color3", team.tertiary);
		r.style.setProperty("--color4", team.quaternary);
	}

	// r.style.setProperty("--color3", themes[index].color3);
}
/*function changeTheme(index) {
	// This version of the theme will change the theme colors when the number index of the team is passed in.
	// Get the root element
	var r = document.querySelector(":root");

	// Get the styles (properties and values) for the root
	var rs = getComputedStyle(r);

	r.style.setProperty("--color1", themes[index].color1);
	r.style.setProperty("--color2", themes[index].color2);
	r.style.setProperty("--color3", themes[index].color3);
	// Do the 4th or 5th colors exist
	console.log("Properties in Royals " + Object.keys(themes[index]).length);
	Object.keys(themes[index]).length > 4
		? r.style.setProperty("--color4", themes[index].color4)
		: r.style.setProperty("--color4", "#FFFFFF");
	Object.keys(themes[index]).length > 5
		? r.style.setProperty("--color5", themes[index].color5)
		: r.style.setProperty("--color5", "#000000");

	// rs.getPropertyValue("--color4"))
	// 	r.style.setProperty("--color4", themes[index].color4);
	// if (rs.getPropertyValue("--color5"))
	// 	r.style.setProperty("--color5", themes[index].color5);
}
*/
function makeBoard() {
	let squaresString = "";
	for (let i = 0; i < 9; i++) {
		// squaresString += `
		// <button id="sq-${i}" class="square" data-state="X" onclick="clickSquare(this)">${i}</button>`;
		squaresString += `
        <button id="sq-${i}" class="square" data-state="X">&nbsp</button>`;
		// console.log(squaresString);
	}
	document.getElementById("squaresContainer").innerHTML = squaresString;
	// Now ad an event listener to each square.
	// let squares = document.querySelectorAll("square");
	// squares.forEach((square) => {
	// 	square.addEventListener(onclick, clickSquare);
	// });
	buildDropdown();
}
function buildDropdown() {
	if (document.getElementById("teamSelect")) return;
	let dropDownDiv = document.getElementById("dropdown");
	let ddElement = document.createElement("select");
	let ddLabel = document.createElement("label");
	ddLabel.setAttribute("for", "teamSelect");
	ddLabel.innerHTML = "Choose a team to change your theme. ";
	ddElement.id = "teamSelect";
	// ddElement.setAttribute("size", "15");
	// put the select on the dom
	dropDownDiv.appendChild(ddLabel);
	dropDownDiv.appendChild(ddElement);

	// Loop through the teams and add an option for each
	let teams = Object.keys(themes);
	teams.forEach((teamName) => {
		let option = document.createElement("option");
		option.value = teamName;
		option.text = teamName;
		if (teamName == "Royals") option.selected = true;
		ddElement.appendChild(option);
	});

	// Add an event listener to the dropdown
	ddElement.addEventListener("change", (ev) => {
		let team = ev.target.value;
		// console.log(Object.keys(themes[team]).length);
		console.log(themes[team]);
		changeTheme(themes[team]);
	});
	// console.log(themes);
}
function clickSquare() {
	let square_state = this.getAttribute("data-state");
	switch (square_state) {
		case "OPEN":
			if (gameOn) {
				console.log("mark OPEN: " + square_state);
				this.setAttribute("data-state", playerTurn);
				this.innerHTML = playerTurn;
				checkForWinner();
				// toggleTurn();
			} else {
				playerTurn == winner
					? displayMessage(
							"You already won. No need to click on those squares. Player " +
								winner +
								" won the game."
					  )
					: displayMessage(
							"My goodness! Are you still trying to win? Player " +
								winner +
								" won the game."
					  );
			}
			break;
		case "X":
			console.log("mark X: " + square_state);
			if (playerTurn == "X") {
				displayMessage(
					"That square is already yours, dummy. Click on an open square."
				);
			} else {
				displayMessage(
					"That square is already taken by your opponent. You can't steal it. Try clicking on an open square."
				);
			}

			break;
		case "O":
			console.log("mark O: " + square_state);
			if (playerTurn == "O") {
				displayMessage(
					"That square is already yours, dummy . Click on an open square."
				);
			} else {
				displayMessage(
					"That square is already taken by your opponent. You can't steal it. Try clicking on an open square."
				);
			}
			break;
	}

	console.log("mark 1- Player Turn" + playerTurn);
}

function toggleTurn() {
	playerTurn == "X" ? (playerTurn = "O") : (playerTurn = "X");

	displayNextPlayer();
}
function displayNextPlayer() {
	let messageDiv = document.getElementById("message");
	if (gameOn) {
		messageDiv.setAttribute("data-state", playerTurn);
		displayMessage("Player " + playerTurn + " is up.");
	} else {
		messageDiv.setAttribute("data-state", winner);
		winner == "Draw"
			? displayMessage("Draw")
			: displayMessage("Player " + winner + " won the game.");
	}
}
function displayMessage(msg) {
	// This function will display a message to the players above the game board
	document.getElementById("message").innerHTML = msg;
}
function checkForWinner() {
	// Get an array of all of the data-states
	let squares = document.getElementsByClassName("square");
	// console.log(squares);

	let moves = [];
	for (let i = 0; i < 9; i++) {
		moves[i] = squares[i].getAttribute("data-state");
		// console.log(moves[i]);
	}
	let winningCombos = [];
	winningCombos.push(moves[0] + moves[1] + moves[2]);
	winningCombos.push(moves[3] + moves[4] + moves[5]);
	winningCombos.push(moves[6] + moves[7] + moves[8]);
	winningCombos.push(moves[0] + moves[3] + moves[6]);
	winningCombos.push(moves[1] + moves[4] + moves[7]);
	winningCombos.push(moves[2] + moves[5] + moves[8]);
	winningCombos.push(moves[0] + moves[4] + moves[8]);
	winningCombos.push(moves[2] + moves[4] + moves[6]);
	// console.log("Mark winningCombos" + winningCombos);

	if (winningCombos.includes("XXX")) {
		// X is the winner
		console.log("mark 13");
		gameOn = false;
		winner = "X";
	} else if (winningCombos.includes("OOO")) {
		// O is the winner
		console.log("mark 14");
		gameOn = false;
		winner = "O";
	} else {
		// No Winner. The game is still on or it is a draw
		console.log("mark 15");

		if (moves.includes("OPEN")) {
			console.log("Mark 15-AAAAAA Game is still on");

			// Still spaces available. Game is on
			toggleTurn();
		} else {
			console.log("Mark 15-BBBBBB No Spaces Available");

			// No spaces available. End game in a draw
			winner = "Draw";
			gameOn = false;
			toggleTurn();
			displayMessage("This game was a draw. No surprise.");
		}
	}
	displayNextPlayer();
}
