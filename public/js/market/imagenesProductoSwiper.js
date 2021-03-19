/* gallery */
var galleryTop = new Swiper(".gallery", {
  spaceBetween: 10,
  grabCursor: false,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  keyboard: {
    enabled: true,
    onlyInViewport: false
  },
  thumbs: {
    swiper: galleryThumbs
  }
});

/* thumbs */
var galleryThumbs = new Swiper(".gallery-thumbs", {
  spaceBetween: 10,
  centeredSlides: true,
  slidesPerView: "auto",
  touchRatio: 0.4,
  slideToClickedSlide: true,
  loop: false,
  keyboard: {
    enabled: true,
    onlyInViewport: false
  }
});

/* set controller  */
galleryTop.controller.control = galleryThumbs;
galleryThumbs.controller.control = galleryTop;