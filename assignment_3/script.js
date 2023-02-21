//this function is used to set and structure the marks in table
function fillUserMarks(m) {
  // spliting the marks
  var container = document.getElementById("container");
  var table = document.getElementById("table_my");
  let marks_arr = m.split("-");
  for (var i = 0; i < marks_arr.length; i++) {
    var tr = document.createElement("tr");
    var td1 = document.createElement("td");
    var td2 = document.createElement("td");
    var sub_mark_arr = marks_arr[i].split("*");
    td1.innerHTML = sub_mark_arr[0];
    td2.innerHTML = sub_mark_arr[1];
    tr.appendChild(td1);
    tr.appendChild(td2);
    table.appendChild(tr);
  }
  container.appendChild(table);
}
