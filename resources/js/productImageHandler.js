$(document).on('change',"#productImage",function () {
    var chosenImageFile = $("#productImage").get(0).files[0]
    const reader = new FileReader()
    reader.addEventListener("load", function () {
      $("#chosenImage").attr("src",reader.result);
    }, false);
    if (chosenImageFile) {
      reader.readAsDataURL(chosenImageFile);
    }
});