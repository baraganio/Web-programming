const images = ['image-0.jpg', 'image-1.jpg', 'image-2.jpg', 'image-3.jpg', 'image-4.jpg', 'image-5.jpg', 'image-6.jpg', 'image-7.jpg', 'image-8.jpg'];
const puzzle = document.getElementById('puzzle');
const cells = Array.from(document.getElementsByClassName('cell'));
const solveBtn = document.getElementById('solve-btn');

let emptyCellIndex = 8;

// Shuffle the images randomly
function shuffleImages() {
  for (let i = 0; i < images.length; i++) {
    const j = Math.floor(Math.random() * (i + 1));
    [images[i], images[j]] = [images[j], images[i]];
  }
}

// Set the background image for each cell
function setCellImages() {
  for (let i = 0; i < cells.length; i++) {
    cells[i].style.backgroundImage = `url(${images[i]})`;
  }
}

// Swap the contents of two cells
function swapCells(currentIndex, targetIndex) {
    // Swap the background images of the current cell and the target cell
    const temp = cells[currentIndex].style.backgroundImage;
    cells[currentIndex].style.backgroundImage = cells[targetIndex].style.backgroundImage;
    cells[targetIndex].style.backgroundImage = temp;
}

// Check if the puzzle is solved
function isPuzzleSolved() {
    for (let i = 0; i < cells.length; i++) {
      // Get the current image position from the cell's background image
      const currentImage = cells[i].style.backgroundImage;
      const currentPosition = Number(currentImage.split('-')[1].charAt(0));
  
      // If the current position doesn't match the expected position, the puzzle is not solved
      if (currentPosition !== i) {
        return false;
      }
    }
  
    // If all positions match, the puzzle is solved
    return true;
  }
  


// Keep track of the last clicked cell
let lastClickedCell = null;

// Check where is the cell that represents the head
// Method made for the modification required
function checkHead(){
  for(let i=0;i<images.length;i++){

    let headPosition = cells[i].style.backgroundImage.split('-')[1].charAt(0);
    if(Number(headPosition) == 1){
      return i;
    }
  }
  return -1;
}

function handleCellClick(cellIndex) {
  // If the last clicked cell is not null, and the clicked cell is not the last clicked cell
  // MODIFICATION: one of the clicked cell must be the one that repreesents the head
  if (lastClickedCell !== null && cellIndex !== lastClickedCell && (checkHead()==cellIndex || checkHead()==lastClickedCell)) {
    // Swap the background images of the two cells
    swapCells(cellIndex, lastClickedCell);

    // Clear the last clicked cell
    lastClickedCell = null;

    // Check if the puzzle is solved
    if (isPuzzleSolved()) {
      alert('Well done!');
    }
  } else {
    // Set the last clicked cell to the current cell
    lastClickedCell = cellIndex;
  }
}


// Solve the puzzle
function solvePuzzle() {
    for (let i = 0; i < cells.length; i++) {
      // Calculate the expected image position based on the cell index
      const expectedPosition = i;
  
      // Get the current image position from the cell's background image
      const currentImage = cells[i].style.backgroundImage;
      const currentPosition = Number(currentImage.split('-')[1].charAt(0));
  
      // If the current position doesn't match the expected position, swap the cells
      if (currentPosition !== expectedPosition) {
        swapCells(i, currentPosition);
      }
    }
  
    // Check if the puzzle is solved
    if (isPuzzleSolved()) {
      alert('Well done!');
    }
  }
  

// Shuffle the puzzle on page load
shuffleImages();
setCellImages();


// Set up event listeners for each cell
for (let i = 0; i < cells.length; i++) {
    cells[i].addEventListener('click', function() {
      handleCellClick(i);
    });
  }
  

// Add click event listener to solve button
solveBtn.addEventListener('click', () => {
  solvePuzzle();
});
