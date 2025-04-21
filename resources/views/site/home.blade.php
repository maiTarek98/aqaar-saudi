@extends('site.index')
@section('title', app(App\Models\GeneralSettings::class)->site_name())
@section('content')
    <!-- hero section -->
    <section class="heroSec position-relative">
      <div class="overlay"></div>
      <div class="hero-content text-center text-white">
        <div class="container-fluid h-100">
          <h1 class="mb-2 fs-2 fw-semibold">اكتشف عقارك المناسب بكل سهولة</h1>
          <p class="fs-4">
            بيع، شراء، توثيق، ومشاركة العقارات بخطوات بسيطة وآمنة
          </p>

          <div class="search-box">
            <form method="post" action="">
              <select name="">
                <option value="">للبيع</option>
                <option value="18">للإيجار</option>
              </select>
              <input
                type="search"
                name="search"
                id="search"
                value=""
                placeholder=" ابحث عن العقار الذي تريده "
                class="ui-autocomplete-input"
                autocomplete="off"
              />
              <button type="submit" class="btn main-btn">
                <i class="bi bi-search me-1 d-none d-md-inline"></i>
                <span>بحث</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      <nav aria-label="scroll to next section">
        <ul class="scroll-to-next p-0">
          <li>
            <a href="#about_sec">
              <i class="bi bi-arrow-down"></i>
              <span>التمرير للأسفل</span>
            </a>
          </li>
        </ul>
      </nav>
    </section>

    <!-- about us -->
    <section id="about_sec" class="about-us py-5">
      <div class="container-fluid">
        <div class="row align-items-center gy-3 gx-md-5 mb-4">
          <div class="col-lg-6">
            <div class="section-title">
              <h2 class="secDesc fw-bold secondary fs-4">
                تعرف على عقارات السعودية
              </h2>
            </div>
            <div class="about-txt d-flex flex-column gap-3 my-4">
              <p>
                في عقارات السعودية، نؤمن بأن العثور على العقار المثالي يجب أن
                يكون تجربة سهلة وواضحة. نحن منصة إلكترونية متخصصة في عرض
                العقارات داخل المملكة، نقدم حلولاً ذكية ومبتكرة للبحث عن عقارات
                للبيع أو الإيجار بما يتناسب مع احتياجاتك وطموحاتك
              </p>
            </div>
            <a
              href="about.html"
              aria-label="تعرف على شركتنا السعودية للعقارات"
              class="main-outline-btn"
            >
              المزيد
            </a>
          </div>
          <div class="col-lg-6">
            <img src="images/about.png" class="w-100" alt="" />
          </div>
        </div>

        <div class="row align-items-center gy-3 gx-md-5">
          <div class="col-lg-6">
            <img src="images/why.png" class="w-100" alt="" />
          </div>
          <div class="col-lg-6">
            <div class="section-title">
              <h2 class="secDesc fw-bold secondary fs-4">
                لماذا عقارات السعودية هو خيارك المناسب ؟  
              </h2>
            </div>
            <div class="about-txt d-flex flex-column gap-3 my-4">
              <p>
                نحرص على توفير معلومات دقيقة، وخيارات متنوعة من الشقق، الفلل، الأراضي، والمكاتب التجارية، من مصادر موثوقة وبأسعار تنافسية. رؤيتنا هي أن نكون وجهتك الأولى في السوق العقاري السعودي، ورسالتنا هي تسهيل عملية البحث والاختيار من خلال أدوات متقدمة وخدمة عملاء متميزة. 

                <span class="d-block main">
                  انضم إلينا، ودعنا نساعدك في اتخاذ القرار الأفضل في رحلتك العقارية
                </span>
              </p>
            </div>
            <a
              href="about.html"
              aria-label="تعرف على شركتنا السعودية للعقارات"
              class="main-outline-btn"
            >
              المزيد
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- features section -->
    <div class="features py-5">
      <div class="container-fluid">
        <div class="row gy-3">
          <div class="col-lg-4">
            <div class="feature">
              <div class="feature-icon">
                <img src="images/step1.png" alt="" />
              </div>
              <div class="feature-content">
                <h3 class="fs-6 fw-bold main my-3">راحة وموثوقية في كل خطوة</h3>
                <p>
                  اختار عقارك وأنت مطمّن، لأننا بنعرض بس العقارات اللي تم التحقق منها ومراجعتها بعناية
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="feature">
              <div class="feature-icon">
                <img src="images/step2.png" alt="" />
              </div>
              <div class="feature-content">
                <h3 class="fs-6 fw-bold main my-3">استثمر بأمان وسهولة</h3>
                <p>
                  سواء كنت بتدور على فرصة استثمارية أو شقة للإيجار، منصتنا بتساعدك توصل للفرصة الصح في المكان الصح                
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="feature">
              <div class="feature-icon">
                <img src="images/step3.png" alt="" />
              </div>
              <div class="feature-content">
                <h3 class="fs-6 fw-bold main my-3">عقارات تناسب كل الأذواق</h3>
                <p>
                  من شقق صغيرة لعائلات، لمكاتب، لمشاريع سكنية كاملة — تقدر تلاقي كل الأنواع في مكان واحد                
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- estates section -->
    <section class="our-estates py-5">
      <div class="container-fluid">
        <div class="section-title text-center pb-4">
          <h2 class="secDesc fw-bold secondary fs-4">اكتشف عقارك المثالي</h2>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-4">
          <div class="col">
            <div class="card">
              <!-- estate link -->
              <a
                href="estate-details.html"
                aria-label="مشاهدة تفاصيل عقار اسم العقار"
                class="link"
              ></a>
              
              <div class="estate-category"> 
                عقار متزايد
              </div>

              <!-- estate img -->
              <div class="estate-img">
                <img
                  src="images/Image.png"
                  class="card-img-top"
                  alt="estate name"
                />
              </div>
              <!-- estate info -->
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="estate-price secondary fw-bold">
                    1500 <span>ريال سعودي</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-2">
                  <p class="estate-name card-title fw-semibold">
                    برج المملكة – الرياض
                  </p>
                  <small class="estate-type text-muted">شقة للإيجار</small>
                </div>
                <p class="estate-location card-text main">
                  <i class="bi bi-geo-alt"></i>
                  <small>الرياض، شارع الملك فهد، برج المملكة، الطابق 10</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <!-- estate link -->
              <a
                href="estate-details.html"
                aria-label="مشاهدة تفاصيل عقار اسم العقار"
                class="link"
              ></a>
              
              <div class="estate-category"> 
                عقار متشارك 
              </div>
              <!-- estate img -->
              <div class="estate-img">
                <img
                  src="images/Image-1.png"
                  class="card-img-top"
                  alt="estate name"
                />
              </div>
              <!-- estate info -->
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="estate-price secondary fw-bold">
                    1500 <span>ريال سعودي</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-2">
                  <p class="estate-name card-title fw-semibold">
                    برج المملكة – الرياض
                  </p>
                  <small class="estate-type text-muted">شقة للإيجار</small>
                </div>
                <p class="estate-location card-text main">
                  <i class="bi bi-geo-alt"></i>
                  <small>الرياض، شارع الملك فهد، برج المملكة، الطابق 10</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <!-- estate link -->
              <a
                href="estate-details.html"
                aria-label="مشاهدة تفاصيل عقار اسم العقار"
                class="link"
              ></a>

              <div class="estate-category"> 
                عقار متزايد
              </div>
              
              <!-- estate img -->
              <div class="estate-img">
                <img
                  src="images/Image-2.png"
                  class="card-img-top"
                  alt="estate name"
                />
              </div>
              <!-- estate info -->
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="estate-price secondary fw-bold">
                    1500 <span>ريال سعودي</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-2">
                  <p class="estate-name card-title fw-semibold">
                    برج المملكة – الرياض
                  </p>
                  <small class="estate-type text-muted">شقة للإيجار</small>
                </div>
                <p class="estate-location card-text main">
                  <i class="bi bi-geo-alt"></i>
                  <small>الرياض، شارع الملك فهد، برج المملكة، الطابق 10</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <!-- estate link -->
              <a
                href="estate-details.html"
                aria-label="مشاهدة تفاصيل عقار اسم العقار"
                class="link"
              ></a>
              
              <div class="estate-category"> 
                عقار متزايد
              </div>

              <!-- estate img -->
              <div class="estate-img">
                <img
                  src="images/Image.png"
                  class="card-img-top"
                  alt="estate name"
                />
              </div>
              <!-- estate info -->
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="estate-price secondary fw-bold">
                    1500 <span>ريال سعودي</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-2">
                  <p class="estate-name card-title fw-semibold">
                    برج المملكة – الرياض
                  </p>
                  <small class="estate-type text-muted">شقة للإيجار</small>
                </div>
                <p class="estate-location card-text main">
                  <i class="bi bi-geo-alt"></i>
                  <small>الرياض، شارع الملك فهد، برج المملكة، الطابق 10</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <!-- estate link -->
              <a
                href="estate-details.html"
                aria-label="مشاهدة تفاصيل عقار اسم العقار"
                class="link"
              ></a>
              
              <div class="estate-category"> 
                عقار متشارك 
              </div>
              <!-- estate img -->
              <div class="estate-img">
                <img
                  src="images/Image-1.png"
                  class="card-img-top"
                  alt="estate name"
                />
              </div>
              <!-- estate info -->
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="estate-price secondary fw-bold">
                    1500 <span>ريال سعودي</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-2">
                  <p class="estate-name card-title fw-semibold">
                    برج المملكة – الرياض
                  </p>
                  <small class="estate-type text-muted">شقة للإيجار</small>
                </div>
                <p class="estate-location card-text main">
                  <i class="bi bi-geo-alt"></i>
                  <small>الرياض، شارع الملك فهد، برج المملكة، الطابق 10</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <!-- estate link -->
              <a
                href="estate-details.html"
                aria-label="مشاهدة تفاصيل عقار اسم العقار"
                class="link"
              ></a>

              <div class="estate-category"> 
                عقار متزايد
              </div>
              
              <!-- estate img -->
              <div class="estate-img">
                <img
                  src="images/Image-2.png"
                  class="card-img-top"
                  alt="estate name"
                />
              </div>
              <!-- estate info -->
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="estate-price secondary fw-bold">
                    1500 <span>ريال سعودي</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between align-items-center my-2">
                  <p class="estate-name card-title fw-semibold">
                    برج المملكة – الرياض
                  </p>
                  <small class="estate-type text-muted">شقة للإيجار</small>
                </div>
                <p class="estate-location card-text main">
                  <i class="bi bi-geo-alt"></i>
                  <small>الرياض، شارع الملك فهد، برج المملكة، الطابق 10</small>
                </p>
              </div>
            </div>
          </div>
        </div>
        <a
          href="estates.html"
          aria-label="المزيد"
          class="main-outline-btn m-auto mt-4"
        >
          المزيد
        </a>
      </div>
    </section>

    <!-- discover section -->
    <section class="discover-wrapper py-5">
      <div class="container-fluid">
        <div class="discover position-relative">
          <div class="discover-bg"></div>
          <div class="d-flex flex-lg-row flex-column-reverse align-items-center">
            <div class="discover-content">
              <div class="about">
                <div class="section-title">
                  <h2 class="secDesc fw-bold secondary fs-4">
                    أحدث العروض والإعلانات
                  </h2>
                </div>
                <div class="about-txt d-flex flex-column gap-3 my-4">
                  <p>
                    اكتشف أحدث العروض والإعلانات المميزة من شركتنا. نحن نقدم لك فرصة للحصول على أفضل العروض والتخفيضات على منتجاتنا وخدماتنا، بالإضافة إلى إعلانات حصرية لتحسين تجربتك معنا
                  </p>
                </div>
                <a
                  href="estates.html"
                  aria-label="اكتشف أحدث العروض والإعلانات المميزة من شركتنا"
                  class="main-outline-btn"
                >
                العقارات
                </a>
              </div>
            </div>
            <div class="discover-img col-lg-6">
              <img src="images/new-ads.png" class="w-100" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- blogs section -->
    <section class="blogs py-5">
      <div class="container-fluid">
        <div class="section-title text-center pb-4">
          <h2 class="secDesc fw-bold secondary fs-4">
            اكتشف آخر الأخبار والمقالات
          </h2>
        </div>
        <div class="row g-3 row-cols-lg-3 row-cols-md-2 row-cols-1">
          <div class="col">
            <div class="card">
              <!-- blog link -->
              <a
                href="blog-details.html"
                aria-label="الانتقال الى مقال بعنوان اسم المقال"
                class="link"
              ></a>
              <!-- blog img -->
              <div class="blog-img">
                <img
                  src="images/Image.png"
                  class="card-img-top"
                  alt="blog name"
                />
              </div>
              <!-- blog info -->
              <div class="card-body">
                <span class="blog-date">5 سبتمبر 2022</span>
                <p class="blog-name cut-text card-title fw-semibold fs-6 my-2">
                  أحدث أخبار العقارات في السعودية
                </p>
                <p class="blog-description cut-text card-text text-muted">
                  تابع آخر المقالات والاتجاهات في سوق العقارات السعودي. نقدم لك نصائح ومراجعات تساعدك في اتخاذ قرارات استثمارية ذكية في عالم العقارات
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <!-- blog link -->
              <a
                href="blog-details.html"
                aria-label="الانتقال الى مقال بعنوان اسم المقال"
                class="link"
              ></a>
              <!-- blog img -->
              <div class="blog-img">
                <img
                  src="images/Image.png"
                  class="card-img-top"
                  alt="blog name"
                />
              </div>
              <!-- blog info -->
              <div class="card-body">
                <span class="blog-date">5 سبتمبر 2022</span>
                <p class="blog-name cut-text card-title fw-semibold fs-6 my-2">
                  أحدث أخبار العقارات في السعودية
                </p>
                <p class="blog-description cut-text card-text text-muted">
                  تابع آخر المقالات والاتجاهات في سوق العقارات السعودي. نقدم لك نصائح ومراجعات تساعدك في اتخاذ قرارات استثمارية ذكية في عالم العقارات
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <!-- blog link -->
              <a
                href="blog-details.html"
                aria-label="الانتقال الى مقال بعنوان اسم المقال"
                class="link"
              ></a>
              <!-- blog img -->
              <div class="blog-img">
                <img
                  src="images/Image.png"
                  class="card-img-top"
                  alt="blog name"
                />
              </div>
              <!-- blog info -->
              <div class="card-body">
                <span class="blog-date">5 سبتمبر 2022</span>
                <p class="blog-name cut-text card-title fw-semibold fs-6 my-2">
                  أحدث أخبار العقارات في السعودية
                </p>
                <p class="blog-description cut-text card-text text-muted">
                  تابع آخر المقالات والاتجاهات في سوق العقارات السعودي. نقدم لك نصائح ومراجعات تساعدك في اتخاذ قرارات استثمارية ذكية في عالم العقارات
                </p>
              </div>
            </div>
          </div>
        </div>
        <a
          href="blogs.html"
          aria-label="مشاهدة كل المقالات"
          class="main-outline-btn m-auto mt-4"
        >
          المزيد
        </a>
      </div>
    </section>
@endsection