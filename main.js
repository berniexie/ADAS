function exportFunc() {
  var inputs = document.getElementsByTagName("input");
  var cbs = []; //will contain all checked checkboxes
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
    window.location.href = "http://localhost:3000/pdf/" + keyWord + "/" + cbnums;
  } else {
    window.location.href = "http://localhost:3000/pdf/" + keyWord + "/" + ttlnums;
  }
}
