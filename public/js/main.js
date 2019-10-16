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
    }
}

board.innerHTML = myBoard.join('')