function exportFunc() {
  var inputs = document.getElementsByTagName("input");
  var cbs = []; //will contain all checked checkboxes
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type == "checkbox") {
      if(inputs[i].checked){
        cbs.push(inputs[i]);
      }
    }
  }
  console.log("this happened" + cbs.length);
}
