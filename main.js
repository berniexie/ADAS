function exportFunc() {
  var inputs = document.getElementsByTagName("input");
  var cbnums = "";
  var ttlnums = "";
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type == "checkbox") {
      ttlnums += i;
      ttlnums += ',';
      if(inputs[i].checked){
        cbnums += i;
        cbnums += ',';
      }
    }
  }
  var keyWord = document.getElementById('paperHeader').getElementsByTagName('h2')[0].innerHTML;
  keyWord = keyWord.substring(1, keyWord.length-1);
  if(cbnums.length != 0){
    //If boxes are checked, send indexes of the checked boxes
    window.location.href = "http://localhost:3000/pdf/" + keyWord + "/" + cbnums;
  } else {
    //If none of the boxes are checked, send indexes of all boxes
    window.location.href = "http://localhost:3000/pdf/" + keyWord + "/" + ttlnums;
  }
}

function ssCloud() {
  var inputs = document.getElementsByTagName("input");
  var cbnums = "";
  var ttlnums = "";
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type == "checkbox") {
      ttlnums += i;
      ttlnums += ',';
      if(inputs[i].checked){
        cbnums += i;
        cbnums += ',';
      }
    }
  }
  var keyWord = document.getElementById('paperHeader').getElementsByTagName('h2')[0].innerHTML;
  keyWord = keyWord.substring(1, keyWord.length-1);
  if(cbnums.length != 0){
    //If boxes are checked, send indexes of the checked boxes
    window.location.href = "http://localhost:3000/sscloud/" + keyWord + "/" + cbnums;
  } else {
    //If none of the boxes are checked, send indexes of all boxes
    window.location.href = "http://localhost:3000/sscloud/" + keyWord + "/" + ttlnums;
  }
}
