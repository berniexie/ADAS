window.onload = function() {
  $("#printWordCloud").click(function() {
    console.log("button clicked");
    html2canvas(document.getElementById("wordCloud"), {
      onrendered: function(canvas) {
        var image = new Image();
        image.src = canvas.toDataURL("image/png");
        window.location.href = image.src;
      }
    });
  });
}
