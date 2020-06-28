$(document).on('change',"#userImage",function () {
    var chosenImageFile = $("#userImage").get(0).files[0]
    const reader = new FileReader()
    reader.addEventListener("load", function () {
      $("#chosenUserImage").attr("src",reader.result);
    }, false);
    if (chosenImageFile) {
      reader.readAsDataURL(chosenImageFile);
    }
});