/* ==============
 ========= js documentation ==========================
*/
(function ($) {
  "use strict";

  jQuery(function () {

    

    /**
     * ======================================
     * 11. offcanvas cart
     * ======================================
     */

    $(".cart").on("click", function () {
      $(".sidebar-cart").addClass("sidebar-cart-active");
      $(".cart-backdrop").addClass("cart-backdrop-active");
      $("body").toggleClass("body-active");
    });

    $(".close-cart").on("click", function () {
      $(".sidebar-cart").removeClass("sidebar-cart-active");
      $(".cart-backdrop").removeClass("cart-backdrop-active");
      $("body").removeClass("body-active");
    });

    $(".cart-backdrop").on("click", function () {
      $(".sidebar-cart").removeClass("sidebar-cart-active");
      $(".cart-backdrop").removeClass("cart-backdrop-active");
      $("body").removeClass("body-active");
    });

    $(".sidebar-cart").on("click", function (event) {
      event.stopPropagation();
    });

    function calculateTotalPrice() {
      var totalPrice = 0;
      $(".cart-item-single").each(function () {
        var quantity = parseInt($(this).find(".item-quantity").text());
        var price = parseFloat($(this).find(".item-price").text());
        totalPrice += quantity * price;
      });
      $(".total-price").text(totalPrice.toFixed(2));
    }

    $(".cart-item-single").each(function () {
      var quantity = parseInt($(this).find(".item-quantity").text());
      $(this)
        .find(".quantity-increase")
        .click(function () {
          if (quantity < 20) {
            quantity++;
            $(this).siblings(".item-quantity").text(quantity);
            calculateTotalPrice();
          }
        });
      $(this)
        .find(".quantity-decrease")
        .click(function () {
          if (quantity > 1) {
            quantity--;
            $(this).siblings(".item-quantity").text(quantity);
            calculateTotalPrice();
          }
        });
      $(this)
        .find(".delete-item")
        .click(function () {
          $(this).closest(".cart-item-single").hide();
        });
    });

  });
})(jQuery);