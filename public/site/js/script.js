// تحديد لغة الموقع
var bodyDir = $("body").css("direction");
console.log(bodyDir);
var dirAr;
if (bodyDir == "rtl") {
  dirAr = true;
} else {
  dirAr = false;
}
$(document).ready(function () {

  $('#lang').on('click', function () {
    $('html').attr('dir', $('html').attr('dir') === 'ltr' ? 'rtl' : 'ltr');
    $('html').attr('lang', $('html').attr('lang') === 'en' ? 'ar' : 'en');
    $('#lang-text').text($('html').attr('lang') === 'en' ? 'العربية' : 'English');
    $('.owl-carousel').toggleClass('owl-rtl');
    $('#bootstrap-style').attr('href', $('html').attr('lang') === 'en' ? 'css/bootstrap.min.css' : 'css/bootstrap.rtl.min.css');
  });

  $(".file-input").change(function () {
    const fileInput = $(this).find('[type="file"]')[0];
    const label = $(this).find("[data-js-label]")[0];
  
    if (!fileInput.files.length) return;
  
    // الحصول على أسماء جميع الملفات المختارة
    const fileNames = Array.from(fileInput.files).map(file => file.name).join(", ");
  
    $(label).html(fileNames);
  });
  

  // Scroll to the top of the page
  window.addEventListener('scroll', () => {
    document.getElementById('scrollUp').style.display = window.scrollY > 300 ? 'block' : 'none';
  });

  $(".brands .owl-carousel").owlCarousel({
    center: true,
    items: 2,
    loop: true,
    autoplay: true,
    margin: 20,
    nav: true,
    dots: false,
    navText: [
      "<i class='fa-solid fa-chevron-right'></i>",
      "<i class='fa-solid fa-chevron-left'></i>",
    ],
    rtl: dirAr,
    responsive: {
      0: {
        items: 3,
      },
      600: {
        items: 5,
      },
      992: {
        items: 10,
      },
    },
  });

  $(".screens .owl-carousel").owlCarousel({
    center: true,
    items: 2,
    loop: true,
    autoplay: true,
    margin: 0,
    nav: true,
    dots: false,
    navText: [
      "<i class='fa-solid fa-chevron-right'></i>",
      "<i class='fa-solid fa-chevron-left'></i>",
    ],
    rtl: dirAr,
    responsive: {
      0: {
        items: 1.5,
      },
      600: {
        items: 3,
      },
      992: {
        items: 5,
      },
    },
  });
});




