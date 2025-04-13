@if(\Request::route()->getName() != 'site.blogs.show') 
<meta property="og:title" content="{{app(App\Models\GeneralSettings::class)->site_name()}}" />
<meta property="og:type" content="website.agency" />
<meta property="og:url" content="{{url('/')}}" />
<meta property="og:image" content="{{asset('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" />
{{--<meta property="og:description" content="{{app(App\Models\GeneralSettings::class)->about()}}" />--}}
<meta property="og:determiner" content="the" />
<meta property="og:locale" content="ar_AR" />
<meta property="og:locale:alternate" content="en_GB" />
<meta property="og:site_name" content="{{app(App\Models\GeneralSettings::class)->site_name()}}" />
<meta property="og:image" content="{{asset('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" />
<meta property="og:image:secure_url" content="{{asset('/storage/'.app(App\Models\GeneralSettings::class)->logo)}}" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:image:alt" content="Logo for {{app(App\Models\GeneralSettings::class)->site_name()}} website" />

@if(App::getLocale() == 'ar')
  <meta name="description" content="{{app(App\Models\SeoSettings::class)->meta_description()}}">
@else
  <meta name="description" content="{{app(App\Models\SeoSettings::class)->meta_description()}}">
@endif
  <meta name="keywords" content="{{app(App\Models\SeoSettings::class)->keywords}}">

@else
  @php $blog = App\Models\Blog::where('name_en',removeSlug(request('q')))->first(); @endphp
    <meta name="description" content="{{ $blog?->blog_seo?->page_description ?? 'وصف الصفحة الافتراضي لتحسينات SEO' }}">
    <meta name="keywords" content="{{$blog?->blog_seo?->keywords}}">
    <meta name="robots" content="index, follow">
    
    {{-- Canonical URL (prevents duplicate content issues) --}}
    <link rel="canonical" href="{{ url('/') }}/{{ $blog?->blog_seo?->page_url ?? 'default-url' }}">

    {{-- Open Graph (Facebook, WhatsApp) --}}
    <meta property="og:title" content="{{ $blog?->blog_seo?->page_title ?? 'افتراضي - تحسينات SEO' }}">
    <meta property="og:description" content="{{ $blog?->blog_seo?->page_description ?? 'وصف الصفحة الافتراضي' }}">
    <meta property="og:url" content="{{ url('/') }}/{{ $blog?->blog_seo?->page_url ?? 'default-url' }}">
    <meta property="og:type" content="website">
@if(App\Models\Blog::where('name_en',removeSlug(request('q')))->first()?->getFirstMediaUrl('base_image','thumb'))
      <meta property="og:image" content="{{ App\Models\Blog::where('name_en',removeSlug(request('q')))->first()?->getFirstMediaUrl('base_image','thumb')}}" alt="{{App\Models\Blog::where('name_en',removeSlug(request('q')))->first()?->name_en}}" class="w-100">
    @else
      <meta property="og:image" content="{{url('dashboard/dist/dist/img/no-photo.png')}}" alt="" class="w-100">
    @endif

    {{-- Twitter Card (for Twitter SEO) --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog?->blog_seo?->page_title ?? 'افتراضي - تحسينات SEO' }}">
    <meta name="twitter:description" content="{{ $blog?->blog_seo?->page_description ?? 'وصف الصفحة الافتراضي' }}">
@if(App\Models\Blog::where('name_en',removeSlug(request('q')))->first()?->getFirstMediaUrl('base_image','thumb'))
      <meta property="twitter:image" content="{{ App\Models\Blog::where('name_en',removeSlug(request('q')))->first()?->getFirstMediaUrl('base_image','thumb')}}" alt="{{App\Models\Blog::where('name_en',removeSlug(request('q')))->first()?->name_en}}" class="w-100">
    @else
      <meta property="twitter:image" content="{{url('dashboard/dist/img/no-photo.png')}}" alt="" class="w-100">
    @endif
@endif