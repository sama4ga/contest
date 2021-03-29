$(document).ready(function() {
  var rows,cols,btnType,freePos,forbiddenLeft,forbiddenRight,direction,player;

  rows = 10;
  cols = 10;
  direction = [0,1,2,3];
  //direction = ["bottomRight","topRight","topLeft","bottomLeft"];
  init();

  /**
   * @description Initiation function for creating the game and its associated controls
   */
  function init() {
    // create the board
    let cellColor1,cellColor2,tr,td,cellCount=0,cellId,numCellsOccupied;
    numCellsOccupied = Math.floor(rows/3);
    cellColor1 = "#853d2b";
    cellColor2 = "#c49376";
    var container = document.createElement("div");
    var turn = document.createElement("div");
    $(turn).attr("id","turn");
    var message = document.createElement("div");
    $(message).attr("id","message");
    var board = document.createElement("table");
    for (let row = 0; row < rows; row++) {
      tr = document.createElement("tr");
      for (let col = 0; col < cols; col++) {
        cellCount++;
        cellId = "tile"  + cellCount;
        td = document.createElement("td");
        $(td).attr({"id":cellId,"data-position":cellCount});

        if (row % 2 == col % 2) {
          $(td).css("background-color",cellColor1); 
          // append button
          if (row < numCellsOccupied) {
            let btn = document.createElement("button");
            $(btn).addClass("player1"); 
            $(td).append(btn);
          }else if (row > (rows-numCellsOccupied-1)) {
            let btn = document.createElement("button");
            $(btn).addClass("player2");
            $(td).append(btn);
          }
        }else{
          $(td).css("background-color",cellColor2);        
        }
        $(tr).append(td);
      }
      $(board).append(tr);
    }
    $(container).append(turn).append(message).append(board);
    $("body").append(container);
    
    // global variables for the game
    btnType = "normal";
    player = Math.ceil(Math.random()*2);
    forbiddenLeft = [1];
    forbiddenRight = [rows];
    for (let i = 0; i < rows-1; i++) {
      forbiddenLeft.push(forbiddenLeft[i]+rows);
      forbiddenRight.push(forbiddenRight[i]+rows);
    } 
    switchPlayer();

    play();
  }

  /**
   * @description The main function for playing the game
   */
  function play() {
    let btn,cellId,cell,adjCells,tile,enemyFound=false,moved=false,checkComplete=false;
    $("button").on("click",function() {
      btn = this;
      removeMarkForMovementAll();
      removeMarkForCheckingAll();
      cellId = $(btn).parent().data("position");
      adjCells = getAllFreeCells(cellId);
      let dir = 0;
      for (const id of adjCells){
        if(id != undefined){
          cell = "#tile"+id;

          if (!isCellFree(id)) {
            //check for enemy
            if (isCellEnemy(id)) {
              enemyFound = true;
              jumps = [];
              do {
                result = getJumps(cellId,dir); console.log(result);
                if (result.length == 0) {
                  enemyFound = false;
                }else{
                  result.forEach((id)=>{
                    cellId = "#tile"+id.cell;
                    //markCellForMovement(cell);
                  });
                  jumps.push(result);
                }
                
              } while (enemyFound);
            }
          }else{
            // check for backward movement when there is no enemy
            if (player == 1 && (dir == 0 || dir == 3)) {dir++;continue;}
            if (player == 2 && (dir == 1 || dir == 2)) {dir++;continue};
            markCellForMovement(cell);
            // enable movement
            $(cell).on("click",function() {
              moveBtn(btn,this);
              removeMarkForMovementAll();
              moved =  true;
              switchPlayer();
            });
          }
        }
        dir++;
      }
      // if (moved) {
      //   switchPlayer();
      // }
    });
  }

  function getJumps(cell,dir) {
    // don't repeat the back direction from which the search is coming from
    let jumpCells = [];
    for (const d of direction) {
      if (dir == 3 && d == 1) continue;
      if (dir == 1 && d == 3) continue;
      if (dir == 0 && d == 2) continue;
      if (dir == 2 && d == 0) continue;
      let adjCell1 = getCell(d,cell);
      if (!isCellFree(adjCell1) && isCellEnemy(adjCell1)) {
        let tile1 = "#tile"+adjCell1;
        let btn = $(tile1).find("button")[0];
        let adjCell2 =  getCell(d,adjCell1);
        let tile2 = "#tile"+adjCell2;
        if (isCellFree(adjCell2)) {
          markCellForMovement(tile2);
          jumpCells.push({cell:adjCell2,button:btn});
        }
      }
      
    };
    return jumpCells;
  }

  /**
   * @description For moving buttons on the board
   * @param {HTMLButtonElement} btn The html button to be moved
   * @param {HTMLTableDataCellElement} cell The cell the button is to be moved to
   */
  function moveBtn(btn,cell) {
    $(cell).append(btn);
  }

  /**
   * @description Performs checking on buttons
   * @param {HTMLTableDataCellElement} cell The cell the button is to moved to
   * @param {HTMLButtonElement} btnChecked The button that has been checked.
   * @param {HTMLButtonElement} btnChecking The button performing the checking
   */
  function performCheck(cell,btnChecked,btnChecking) {
    $(btnChecked).remove();
    moveBtn(btnChecking,cell);
  }

  /**
   * @description For marking cells where buttons can be moved to
   * @param {HTMLTableDataCellElement} cell The cell to be marked
   */
  function markCellForMovement(cell) {
    $(cell).addClass("possible-move");
  }
  
  /**
   * @description Removes cells that were marked for movement
   * @param {HTMLTableDataCellElement} cell Cell to be unmarked
   */
  function removeMarkForMovement(cell) {
    $(cell).removeClass("possible-move").off("click");
  }
  
  /**
   * @description Removes marking from cells that were marked for movement
   */
  function removeMarkForMovementAll() {
    $("td").removeClass("possible-move").off("click");
  }
  
  /**
   * @description For marking cells for checking
   * @param {HTMLTableDataCellElement} cell The cell to be marked
   */
  function markCellForChecking(cell) {
    $(cell).addClass("possible-check");
  }

  /**
   * @description Removes cells that were marked for checking
   * @param {HTMLTableDataCellElement} cell Cell to be unmarked
   */
  function removeMarkForChecking(cell) {
    $(cell).removeClass("possible-check").off("click");
  }
  
  /**
   * @description Removes marking from cells that were marked for checking
   */
  function removeMarkForCheckingAll() {
    $("td").removeClass("possible-check").off("click");
  }

  /**
   * @description Gets all cells adjacent the current cell
   * @param {number} cellId data-position of cell
   */
  function getAllFreeCells(cellId) {
    return [getRightCellDown(cellId),getRightCellUp(cellId),getLeftCellUp(cellId),getLeftCellDown(cellId)];
  }

  /**
   * @description Gets all cells adjacent the current cell available for movement
   * @param {number} cellId data-position of cell
   */
  function getFreeCellsForMovement(cellId) {
    if (player == 1) return [undefined,getRightCellUp(cellId),getLeftCellUp(cellId),undefined];
    return [getRightCellDown(cellId),undefined,undefined,getLeftCellDown(cellId)];
  }

  /**
   * @description Gets the cell in the specified direction
   * @param {number} dirIndex A number denoting the direction to get the cell
   * @param {number} cellId data-position of cell
   * @returns The data-position of the next cell in the specified direction or undefined
   */
  function getCell(dirIndex,cellId) {
    if (dirIndex == 0) return getRightCellDown(cellId); // bottom-right
    if(dirIndex == 1) return getRightCellUp(cellId); // top-right
    if (dirIndex == 2) return getLeftCellUp(cellId); // top-left
    if(dirIndex == 3) return getLeftCellDown(cellId); // bottom-left
  }

  /**
   * @description Gets the cell to the top-left of the current cell
   * @param {number} cellId data-position of cell
   */
  function getLeftCellUp(cellId) {
    let left = cellId + rows - 1;
    if (left <= rows*cols && forbiddenLeft.indexOf(cellId) == -1) {
      return left;
    }
    return undefined;
  }
  
  /**
   * @description Gets the cell to the bottom-left of the current cell
   * @param {number} cellId data-position of cell
   */
  function getLeftCellDown(cellId) {
    let left = cellId - rows - 1;
    if (left > 0 && forbiddenLeft.indexOf(cellId) == -1) {
      return left;
    }
    return undefined;
  }
  
  /**
   * @description Gets the cell to the top-right of the current cell
   * @param {number} cellId data-position of cell
   */
  function getRightCellUp(cellId) {
    let right = cellId + rows + 1;
    if (right < rows*cols && forbiddenRight.indexOf(cellId) == -1) {
      return right;
    }
    return undefined;
  }
  
  /**
   * @description Gets the cell to the bottom-right of the current cell
   * @param {number} cellId data-position of cell
   */
  function getRightCellDown(cellId) {
    let right = cellId - rows + 1;
    if (right > 0 && forbiddenRight.indexOf(cellId) == -1) {
      return right;
    }
    return undefined;
  }

  /**
   * @description Checks if the cell is occupied by a button
   * @param {number} cellId data-position of cell
   */
  function isCellFree(cellId) {
    let tile = "#tile"+cellId;
    return $(tile).find("button")[0] == undefined;
  }
  
  /**
   * @description Checks if the button in the cell belongs to the other user
   * @param {number} cellId data-position of cell
   */
  function isCellEnemy(cellId) {
    let tile = "#tile"+cellId;
    let enemy = player == 1 ? 2 : 1;
    enemy = "player"+enemy;
    let btn = $(tile).find("button")[0];
    return $(btn).hasClass(enemy);
  }
  /**
   * @description Switches the player
   */
  function switchPlayer() {
    if (player == 2) {
      $("td button.player2").attr("disabled",true);
      $("td button.player1").attr("disabled",false);
      player = 1;
      $(turn).text("It is the turn of Player: " + player);
      return;
    }
    $("td button.player1").attr("disabled",true);
    $("td button.player2").attr("disabled",false);
    player = 2
    $(turn).text("It is the turn of Player: " + player);
    return;
  }

  /**
   * @description Restarts the game
   */
  function restart() {
    $(container).remove();
  }
});