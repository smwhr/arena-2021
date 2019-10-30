let board = document.querySelector('#board')
let myBoard = board.firstChild.textContent.split('')

const data = '../data/data.json'

var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", data, false);
xmlhttp.send(null); 
json = JSON.parse(xmlhttp.responseText)
directions = json.directions

for(let i = 0; i < myBoard.length; i++)
{
    switch(myBoard[i])
    {
        case 'x':
            wall = document.createElement('span')
            wall.setAttribute('class', 'wall')
            myBoard[i] = wall.outerHTML;
        break

        case ' ':
            floor = document.createElement('span')
            floor.setAttribute('class', 'floor')
            myBoard[i] = floor.outerHTML;
        break

        case 'A':
            robotA = document.createElement('span')
            robotA.setAttribute('id', 'robotA')

            switch(directions.A)
            {
                case 'N':
                    console.log('Nord')
                    robotA.setAttribute('class', 'north')

                break;

                case 'S':
                    console.log('Sud')
                    robotA.setAttribute('class', 'south')
                break;

                case 'E':
                    console.log('Est')
                    robotA.setAttribute('class', 'est')

                break;

                case 'W':
                    console.log('Ouest')
                    robotA.setAttribute('class', 'west')
                break;
            }

            myBoard[i] = robotA.outerHTML;
        break

        case 'B':
            robotB = document.createElement('span')
            robotB.setAttribute('id', 'robotB')

            switch(directions.B)
            {
                case 'N':
                    console.log('Nord')
                    robotB.setAttribute('class', 'north')

                break;

                case 'S':
                    console.log('Sud')
                    robotB.setAttribute('class', 'south')
                break;

                case 'E':
                    console.log('Est')
                    robotB.setAttribute('class', 'est')

                break;

                case 'W':
                    console.log('Ouest')
                    robotB.setAttribute('class', 'west')
                break;
            }

            myBoard[i] = robotB.outerHTML;
        break
    }
}

board.innerHTML = myBoard.join('')