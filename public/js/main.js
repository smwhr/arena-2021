let board = document.querySelector('#board')
let myBoard = board.firstChild.textContent.split('')

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
            robotA.setAttribute('class', 'robotA')
            myBoard[i] = robotA.outerHTML;
        break

        case 'B':
            robotB = document.createElement('span')
            robotB.setAttribute('class', 'robotB')
            myBoard[i] = robotB.outerHTML;
        break
    }
}

board.innerHTML = myBoard.join('')