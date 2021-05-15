$(function() {
    console.log("Function has been called!");

    $("#add-product").click(function()   {

        var productName = $("#product-name").val();
        var productDescription = $("#product-description").val();
        var vendorName = $("#vendor-name").val();
        var productCategory = $("#product-category").val();
        console.log("Product name: " + productName);
        addProduct(productName,productDescription,vendorName,productCategory);

    });


    function addProduct(productName,productDescription,vendorName,productCategory) {
     
      $.ajax({
        type: "POST",
        url: 'backend/add-product.php',
        data: {name: 'John'},
        success: function(data){
          console.log("Response :" + data);
        },
        error: function(xhr, status, error){
          console.error(xhr);
        }
      });

   }

});