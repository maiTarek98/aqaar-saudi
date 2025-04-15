var bodyDir = $('body').css('direction')
console.log(bodyDir)
var dirAr
if (bodyDir == "rtl") {
  dirAr = true
  console.log('dir' + dirAr)
  $('.owl-carousel').addClass('owl-rtl')
}
else {
  dirAr = false
  console.log('en');
  console.log('dir' + dirAr)
}

// Initialize all tooltips on the page
document.addEventListener('DOMContentLoaded', function () {
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});

if ($('.copy-text').length > 0) {
    let copyText = document.querySelector(".copy-text");
    copyText.querySelector("button").addEventListener("click", function () {
      let input = copyText.querySelector("input.text");
      input.select();
      document.execCommand("copy");
      copyText.classList.add("active");
      window.getSelection().removeAllRanges();
      setTimeout(function () {
        copyText.classList.remove("active");
      }, 2500);
    });
}

// upload and preview an image 
function initImageUpload(box) {
  let uploadField = box.querySelector('.image-upload');

  uploadField.addEventListener('change', getFile);

  function getFile(e) {
    let file = e.currentTarget.files[0];
    checkType(file);
  }

  function previewImage(file) {
    let thumb = box.querySelector('.js--image-preview'),
      reader = new FileReader(),
      img = thumb.querySelector('img');

    // إذا لم يكن هناك عنصر img، يتم إنشاؤه
    if (!img) {
      img = document.createElement('img');
      img.alt = "Preview Image";
      img.style.maxWidth = "100%";
      img.style.height = "auto";
      thumb.innerHTML = ''; // تأكد من إفراغ المحتوى الحالي
      thumb.appendChild(img);
    }

    reader.onload = function () {
      img.src = reader.result; // تعيين الصورة داخل العنصر img
    };
    reader.readAsDataURL(file);
    thumb.className += ' js--no-default';
  }

  function checkType(file) {
    let imageType = /image.*/;
    if (!file.type.match(imageType)) {
      throw 'Datei ist kein Bild';
    } else if (!file) {
      throw 'Kein Bild gewählt';
    } else {
      previewImage(file);
    }
  }
}

// upload and preview multiple images such as dropzone
function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = `
                <div class="col">
                    <div class='upload__img-box'>
                        <div 
                        data-number='${$(".upload__img-close").length}' 
                        data-file='${f.name}' 
                        class='img-bg'>
                            <div class='upload__img-close'></div>
                            <img src='${e.target.result}'>
                        </div>
                    </div>
                </div>`;
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
        console.log(imgArray)
      });
    });
  });

  $(document).on('click', ".upload__img-close", function (e) {
    var inputElement = $('.upload__inputfile')[0];

    // Select the image to be deleted.
    var fileName = $(this).parent().data("file");

    // Create a DataTransfer object to save new files after deletion
    var dt = new DataTransfer();

    // Update the array with the specified file deleted
    imgArray = imgArray.filter(file => file.name !== fileName);

    // Update input[type=file] with remaining files.
    for (var i = 0; i < inputElement.files.length; i++) {
      if (inputElement.files[i].name !== fileName) {
        dt.items.add(inputElement.files[i]);
      }
    }

    // Reset files to input[type=file]
    inputElement.files = dt.files;

    // Remove item from UI
    $(this).closest('.col').remove();

    console.log("remaining files :", imgArray);
  });

}
ImgUpload()

// toggle password type
$(document).on('click', '.pass', function (e) {
  $(this).children('i').toggleClass("bi-unlock bi-lock");
  var pass = $(this).closest('.input-group').find('input')[0];
  console.log(pass);
  if (pass.type == "password") {
    pass.setAttribute("type", "text");
  } else {
    pass.setAttribute("type", "password");
  }
})

// radio filter options
const labels = document.querySelectorAll('.filter-op label');
labels.forEach((label) => {
  const radio = label.previousElementSibling;
  const closeButton = label.querySelector('.op-close');

  // عند اختيار العنصر، أظهر زر الإغلاق
  radio.addEventListener('change', () => {
    document.querySelectorAll('.op-close').forEach((btn) => btn.classList.add('d-none')); // إخفاء الأزرار الأخرى
    closeButton.classList.remove('d-none'); // إظهار زر الإغلاق لهذا العنصر فقط
  });

  // عند النقر على زر الإغلاق، ألغِ التحديد وأخفِ الزر
  closeButton.addEventListener('click', (e) => {
    e.stopPropagation(); // منع تأثير الحدث على الـ label
    radio.checked = false;
    closeButton.classList.add('d-none');
  });
});

// initialize box-scope
var boxes = document.querySelectorAll('.box');
for (let i = 0; i < boxes.length; i++) {
  let box = boxes[i];
  initDropEffect(box);
  initImageUpload(box);
}
/// drop-effect
function initDropEffect(box) {
  let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

  // get clickable area for drop effect
  area = box.querySelector('.js--image-preview');
  area.addEventListener('click', fireRipple);

  function fireRipple(e) {
    area = e.currentTarget;
    // create drop
    if (!drop) {
      drop = document.createElement('span');
      drop.className = 'drop';
      this.appendChild(drop);
    }
    // reset animate class
    drop.className = 'drop';

    // calculate dimensions of area (longest side)
    areaWidth = getComputedStyle(this, null).getPropertyValue("width");
    areaHeight = getComputedStyle(this, null).getPropertyValue("height");
    maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

    // set drop dimensions to fill area
    drop.style.width = maxDistance + 'px';
    drop.style.height = maxDistance + 'px';

    // calculate dimensions of drop
    dropWidth = getComputedStyle(this, null).getPropertyValue("width");
    dropHeight = getComputedStyle(this, null).getPropertyValue("height");

    // calculate relative coordinates of click
    x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10) / 2);
    y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10) / 2) - 30;

    // position drop and animate
    drop.style.top = y + 'px';
    drop.style.left = x + 'px';
    drop.className += ' animate';
    e.stopPropagation();
  }
}

// copy url
if ($('.copy-text').length > 0) {
  $(document).on('click', '.copy-text button', function (e) {
    let $copyText = $(this).closest('.copy-text');
    let $input = $copyText.find('input.text');
    $input.select();
    document.execCommand("copy");
    $copyText.addClass('active');
    window.getSelection().removeAllRanges();
    setTimeout(function () {
      $copyText.removeClass('active');
    }, 2500);
  });
}
var changeSlide = 4; // mobile -1, desktop + 1
// Resize and refresh page. slider-two slideBy bug remove
var slide = changeSlide;
if ($(window).width() < 600) {
  var slide = changeSlide;
  slide--;
} else if ($(window).width() > 999) {
  var slide = changeSlide;
  slide++;
} else {
  var slide = changeSlide;
}

$(".one").owlCarousel({
  nav: false,
  items: 1,
  margin: 5,
  // autoplay: 5000,
  rtl: dirAr,
});
$(".two").owlCarousel({
  nav: false,
  margin: 5,
  rtl: dirAr,
  responsive: {
    0: {
      items: changeSlide - 1,
      slideBy: changeSlide - 1,
    },
    600: {
      items: changeSlide,
      slideBy: changeSlide,
    },
    1000: {
      items: changeSlide + 1,
      slideBy: changeSlide + 1,
    },
  },
});
var owl = $(".one");
owl.owlCarousel();
owl.on("translated.owl.carousel", function (event) {
  $(".right").removeClass("nonr");
  $(".left").removeClass("nonl");
  if ($(".one .owl-next").is(".disabled")) {
    $(".slider .right").addClass("nonr");
  }
  if ($(".one .owl-prev").is(".disabled")) {
    $(".slider .left").addClass("nonl");
  }
  $(".slider-two .item").removeClass("active");
  var c = $(".slider .owl-item.active").index();
  $(".slider-two .item").eq(c).addClass("active");
  var d = Math.ceil((c + 1) / slide) - 1;
  $(".slider-two .owl-dots .owl-dot").eq(d).trigger("click");
});
$(".right").click(function () {
  $(".slider .owl-next").trigger("click");
});
$(".left").click(function () {
  $(".slider .owl-prev").trigger("click");
});
$(".slider-two .item").click(function () {
  var b = $(".item").index(this);
  $(".slider .owl-dots .owl-dot").eq(b).trigger("click");
  $(".slider-two .item").removeClass("active");
  $(this).addClass("active");
});
var owl2 = $(".two");
owl2.owlCarousel();
owl2.on("translated.owl.carousel", function (event) {
  $(".right-t").removeClass("nonr-t");
  $(".left-t").removeClass("nonl-t");
  if ($(".two .owl-next").is(".disabled")) {
    $(".slider-two .right-t").addClass("nonr-t");
  }
  if ($(".two .owl-prev").is(".disabled")) {
    $(".slider-two .left-t").addClass("nonl-t");
  }
});
$(".right-t").click(function () {
  $(".slider-two .owl-prev").trigger("click");
});
$(".left-t").click(function () {
  $(".slider-two .owl-next").trigger("click");
});


// carousel
$(".owl-carousel:not(.latestReviews)").owlCarousel({
  nav: false,
  loop: false,
  responsiveClass: true,
  stagePadding: 20,
  margin: 10,
  rtl: dirAr,
  responsive: {
    0: {
      items: 2,
      stagePadding: 12
    },
    768: {
      items: 3
    },
    992: {
      items: 5
    }
  }
});
$(".owl-carousel.latestReviews").owlCarousel({
  nav: false,
  dots: false,
  loop: true,
  autoplay: true,
  responsiveClass: true,
  margin: 10,
  rtl: dirAr,
  items: 1
});

$('.select2').select2();

$('.summernote').summernote({
  height: 200,               // Set initial height
  minHeight: 100,            // Minimum height
  maxHeight: 800,            // Maximum height
  focus: true,               // Optional: automatically focus on the editor
  callbacks: {
    onChange: function (contents, $editable) {
      var editor = $editable.closest('.note-editor').find('.note-editable');
      var height = editor[0].scrollHeight; // Get content height
      editor.height(height); // Set height based on content
    }
  }
});



