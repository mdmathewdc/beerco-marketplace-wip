$(function() {

  $("div#myDropzone").dropzone({ url: "/upload-product-image.php" },
  function() {
      console.log("Hello");
  });
    console.log("Script.js has been called!");

    $("#add-product").click(function()   {

        var productName = $("#product-name").val();
        var productDescription = $("#product-description").val();
        var vendorName = $("#vendor-name").val();
        var productCategory = $("#product-category").val();
        if(productName != "") {
          addProduct(productName,productDescription,vendorName,productCategory);
        }

    });


    function addProduct(productName,productDescription,vendorName,productCategory) {
     
      $.ajax({
        type: "POST",
        url: 'add-product.php',
        data: {'productName': productName, 
               'productDescription': productDescription, 
               'vendorName': vendorName,
               'productCategory': productCategory
              },
        success: function(data){
          //console.log(JSON.parse(data));
          console.log(data);
          $.toast({
            heading: 'Success',
            text: 'Product has been added!',
            showHideTransition: 'fade',
            icon: 'success'
        });

        },
        error: function(xhr, status, error){
          console.error(xhr);
          $.toast({
            heading: 'Error',
            text: 'Unexpected error!',
            icon: 'error'
        })
        }
      });

   }

});