@php
    $settings = app(App\Models\GeneralSettings::class);
    $seo = app(App\Models\SeoSettings::class);
    $siteName = $settings->site_name();
    $logoPath = asset('/storage/' . $settings->logo);
    $metaDescription = ($seo->meta_description()) ?? 'وصف افتراضي';
    $metaKeywords = $seo->keywords ?? '';
@endphp

@if(\Request::route()->getName() != 'site.blogs.show')
    <meta property="og:title" content="{{ $siteName }}" />
    <meta property="og:type" content="website.agency" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:image" content="{{ $logoPath }}" />
    <meta property="og:locale" content="ar_AR" />
    <meta property="og:site_name" content="{{ $siteName }}" />
    <!-- باقي الوسوم -->
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
@else
    @php
        $blog = App\Models\Blog::whereHas('blog_seo', function($q) {
            $q->where('page_url', request()->segment(2));
        })->first();
        $blogSeo = $blog?->blog_seo;
        $pageTitle = $blogSeo->page_title ?? 'افتراضي - تحسينات SEO';
        $pageDescription = $blogSeo->page_description ?? 'وصف الصفحة الافتراضي';
        $pageUrl = url('/') . '/blogs/' . ($blogSeo->page_url ?? 'default-url');
        $ogImage = $blog?->getFirstMediaUrl('blogs_image', 'thumb') ?? url('dashboard/dist/dist/img/no-photo.png');
    @endphp

    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $blogSeo?->keywords }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $pageUrl }}">

    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $pageUrl }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $ogImage }}" alt="{{ $blog?->name_en }}">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta property="twitter:image" content="{{ $ogImage }}" alt="{{ $blog?->name_en }}">
@endif
