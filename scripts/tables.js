function sortTable(tableId,tableColumnNo) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
  table = document.getElementById(tableId);
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("td")[tableColumnNo];
      y = rows[i+1].getElementsByTagName("td")[tableColumnNo];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }    
      }else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }     
      }
    }

    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i+1],rows[i]);
      switching = true;
      switchCount++;
    }else{
      if (switchCount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

/**
 * 
 * @param {string} tableId Id of the table
 * @param {number} tableColumnId The column count of the table where the data to be searched resides. This cout is zero-based counting from left-to-right
 * @param {string} searchId Id of the search field
 */
function searchTable(tableId,tableColumnId,searchId) {
  // $("#" + searchId).on("keyup", function() {
  //   var value = $(this).val().toLowerCase();
  //   $("#" + tableId + " tr").filter(function() {
  //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  //   });
  // });

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById(searchId);
  filter = input.value.toLowerCase();
  table = document.getElementById(tableId);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[tableColumnId];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toLowerCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      }else{
        tr[i].style.display = "none";
      }
    } 
  } 

}

/**
 * 
 * @param {string} tableId Id of the table
 * @param {number} tableColumnNo The number of the column in the table starting from 0 counting from left to right
 * @returns {array} An array of the phone numbers
 */
function getPhoneNumbers(tableId,tableColumnNo) {
  var table,rows,phoneNumbers=[];
  table = document.getElementById(tableId);
  rows = table.rows;
  for (let i = 1; i < rows.length; i++) {
    phoneNumbers.push(rows[i].getElementsByTagName("td")[tableColumnNo].innerText);   
  }
  return phoneNumbers;
}

/**
 * 
 * @param {array} data An array containing the data to be saved as csv
 * @param {string} headings A comma separated string of the heading of the data to be saved
 * @param {string} filename A string to be used as the filename for the data to be saved. It can optionally end with .csv
 */
function exportDataAsCSV(data,headings,filename) {
  csvData = headings + "\n";
  data.forEach((item)=>{
    if (!isArray(item)) { //!Array.isArray(item); item instanceof Array
      csvData += item + "\n";      
    }else{
      csvData += item.join(",") + "\n";
    }
  });

  function isArray(x) {
    return x.constructor.toString().indexOf("Array") > -1;
  }

  var hiddenElement = document.createElement("a");
  if (window.navigator.msSaveBlob) { // IE 10+
    //alert('IE' + csv);
    window.navigator.msSaveOrOpenBlob(new Blob([csvData], {type: "text/plain;charset=utf-8;"}), filename)
  } 
  else {
    hiddenElement.href = "data:application/csv;charset=utf-8;"+encodeURIComponent(csvData);
    hiddenElement.target = "_blank";
    hiddenElement.download = filename.endsWith(".csv") ? filename : filename + ".csv";
  }
  hiddenElement.click();
}
function exportAsCSV(csv ,filename) {
  csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
  if (window.navigator.msSaveBlob) { // IE 10+
      //alert('IE' + csv);
    window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), filename)
  } 
  else {
    $(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' }); 
  }
}

function getEmails(tableId,tableColumnNo) {
  var table,rows,i,emails=[];
  table = document.getElementById(tableId);
  rows = table.rows;
  for (i = 1; i < rows.length; i++) {
    emails.push(rows[i].getElementsByTagName("td")[tableColumnNo].innerText);   
  }
  return emails;
}

/**
 * 
 * @param {string} tableId The id of the table whose data is to exported
 * @param {string} filename String to be used as the filename of the file
 * @param {boolean} showHidden Whether to export hidden rows. Default is false
 */
function exportTable(tableId,filename,showHidden=false) {
  var table,headings,rows,tr,td="";
  var tableData,rowData=[];
  table = document.getElementById(tableId);
  rows = table.rows;
  rows.forEach(row => {
    tr=row.children;
    // check for hidden rows
    if (tr.style.display !="none" && showHidden) {
      rowData = [];
      tr.forEach(item=>{
        //check for merged cells pending
        rowData.push(item.innerText);
      });
      tableData.push(rowData);      
    }
  });
  
  exportDataAsCSV(tableData,headings,filename);
}

function exportTableToCSV($table, filename) {
  
  var $rows = $table.find('tr:has(td),tr:has(th)'),

  // Temporary delimiter characters unlikely to be typed by keyboard
  // This is to avoid accidentally splitting the actual contents
  tmpColDelim = String.fromCharCode(11), // vertical tab character
  tmpRowDelim = String.fromCharCode(0), // null character

  // actual delimiter characters for CSV format
  colDelim = '","',
  rowDelim = '"\r\n"',

  // Grab text from table into CSV formatted string
  csv = '"' + $rows.map(function (i, row) {
      var $row = $(row), $cols = $row.find('td,th');

      return $cols.map(function (j, col) {
          var $col = $(col), text = $col.text();

          return text.replace(/"/g, '""'); // escape double quotes

      }).get().join(tmpColDelim);

  }).get().join(tmpRowDelim)
      .split(tmpRowDelim).join(rowDelim)
      .split(tmpColDelim).join(colDelim) + '"'
  // Data URI
  csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
  if (window.navigator.msSaveBlob) { // IE 10+
      //alert('IE' + csv);
      window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv")
  } 
  else {
      $(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' }); 
  }
}