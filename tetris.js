document.addEventListener('DOMContentLoaded', () => {
    const board = document.getElementById('game-board');
    let score = 0;

    // Create the game board
    for (let i = 0; i < 200; i++) {
        const square = document.createElement('div');
        board.appendChild(square);
    }

    // Define the Tetris pieces and their rotations
    const pieces = [
        [1, 11, 21, 31], // I
        [0, 1, 11, 12],  // O
        [1, 11, 12, 13], // L
        [1, 11, 10, 9],  // J
        [0, 10, 11, 12], // T
        [1, 10, 11, 12], // S
        [0, 1, 2, 11]    // Z
    ];

    let currentPiece = randomPiece();

    function randomPiece() {
        const randomIndex = Math.floor(Math.random() * pieces.length);
        return pieces[randomIndex];
    }

    function draw() {
        currentPiece.forEach(index => {
            if (index >= 0 && index < 200) {
                board.childNodes[index].classList.add('piece');
            }
        });
    }

    function undraw() {
        currentPiece.forEach(index => {
            board.childNodes[index].classList.remove('piece');
        });
    }

    function moveDown() {
        undraw();
        currentPiece = currentPiece.map(index => index + 10);
        draw();
        freeze();
    }

    function freeze() {
        if (currentPiece.some(index => index + 10 >= 200 || board.childNodes[index + 10].classList.contains('taken'))) {
            currentPiece.forEach(index => board.childNodes[index].classList.add('taken'));
            currentPiece = randomPiece();
            draw();
            if (currentPiece.some(index => board.childNodes[index].classList.contains('taken'))) {
                // Game over
                alert('Game Over! Your score: ' + score);
                resetGame();
            }
        }
    }

    function resetGame() {
        board.childNodes.forEach(node => node.classList.remove('taken', 'piece'));
        score = 0;
        updateScore();
        currentPiece = randomPiece();
        draw();
    }

    function moveLeft() {
        undraw();
        const isAtLeftEdge = currentPiece.some(index => (index % 10) === 0);
        if (!isAtLeftEdge) currentPiece = currentPiece.map(index => index - 1);
        draw();
    }

    function moveRight() {
        undraw();
        const isAtRightEdge = currentPiece.some(index => (index % 10) === 9);
        if (!isAtRightEdge) currentPiece = currentPiece.map(index => index + 1);
        draw();
    }

    function rotate() {
        undraw();
        const isAtLeftEdge = currentPiece.some(index => (index % 10) === 0);
        const isAtRightEdge = currentPiece.some(index => (index % 10) === 9);
        if (!isAtLeftEdge && !isAtRightEdge) {
            // Rotate the piece if it's not at the left or right edge
            currentPiece = rotatePiece(currentPiece);
        }
        draw();
    }

    function rotatePiece(piece) {
        const pivot = piece[1]; // Use the second square as the pivot
        const relativePositions = piece.map(index => index - pivot);
        const rotatedPositions = relativePositions.map(pos => -pos); // Rotate 90 degrees
        return rotatedPositions.map(pos => pos + pivot);
    }

    function removeFullRows() {
        for (let row = 19; row >= 0; row--) {
            if (board.childNodes[row * 10].classList.contains('taken') &&
                board.childNodes[row * 10 + 1].classList.contains('taken') &&
                board.childNodes[row * 10 + 2].classList.contains('taken') &&
                board.childNodes[row * 10 + 3].classList.contains('taken') &&
                board.childNodes[row * 10 + 4].classList.contains('taken') &&
                board.childNodes[row * 10 + 5].classList.contains('taken') &&
                board.childNodes[row * 10 + 6].classList.contains('taken') &&
                board.childNodes[row * 10 + 7].classList.contains('taken') &&
                board.childNodes[row * 10 + 8].classList.contains('taken') &&
                board.childNodes[row * 10 + 9].classList.contains('taken')) {
                // Remove the full row
                board.childNodes[row * 10].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 1].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 2].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 3].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 4].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 5].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 6].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 7].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 8].classList.remove('taken', 'piece');
                board.childNodes[row * 10 + 9].classList.remove('taken', 'piece');

                // Move all rows above down
                for (let i = row - 1; i >= 0; i--) {
                    if (board.childNodes[i * 10].classList.contains('taken')) {
                        board.childNodes[(i + 1) * 10].classList.add('taken');
                        board.childNodes[i * 10].classList.remove('taken');
                        board.childNodes[(i + 1) * 10].classList.add('piece');
                        board.childNodes[i * 10].classList.remove('piece');
                    }
                }

                // Increase the score
                score += 10;
                updateScore();
            }
        }
    }

    function updateScore() {
        document.getElementById('score').innerText = 'Score: ' + score;
    }

    function control(e) {
        if (e.keyCode === 37) {
            moveLeft();
        } else if (e.keyCode === 38) {
            rotate();
        } else if (e.keyCode === 39) {
            moveRight();
        } else if (e.keyCode === 40) {
            moveDown();
        }
    }

    document.addEventListener('keydown', control);
    setInterval(() => {
        moveDown();
        removeFullRows();
    }, 1000);
});
