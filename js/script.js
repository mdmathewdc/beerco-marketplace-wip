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

        console.log("Add product function...");
        var settings = {
            "url": "https://5e0c9d0ee789975147ebd70d5d71cb1f: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@beerco-pty-ltd.myshopify.com/admin/api/2020-10/products.json",
            "method": "POST",
            "timeout": 0,
            "headers": {
              "Content-Type": "application/json",
              "Authorization": "Basic NWUwYzlkMGVlNzg5OTc1MTQ3ZWJkNzBkNWQ3MWNiMWY6c2hwcGFfMmQ4ZTdkMDRjOTFiYzk2OWJjZGU3NjRkMjUyYjA2ODY="
            },
            "data": JSON.stringify({
              "product": {
                "title": "xxx product",
                "body_html": "<strong>This is a test product description</strong>",
                "vendor": "crsip",
                "product_type": "Barrel hfjdbj",
                "tags": [
                  "barrel1",
                  "barrel2"
                ],
                "status": "draft"
              }
            }),
            "dataType": "JSON",
            "crossDomain": "true"

          };
          
          $.ajax(settings).done(function (response) {
            console.log(response);
          });
        
    }


});