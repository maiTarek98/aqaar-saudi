@extends('site.index')
@section('title', trans('site.jobs') )
@section('content')
<h3>روابط التوثيق الخاصة بالعقار</h3>

@foreach ($property->access_links as $link)
    <div class="card mb-3 p-3 shadow-sm border">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>الجهة رقم:</strong> {{ $link->current_level }}<br>
                <strong>أنشئ بواسطة:</strong> {{ $link->source_user->name ?? 'مالك العقار' }}
            </div>

            <div>
                <a href="{{ route('property.verify.link', $link->token) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    فتح الرابط
                </a>

                <button class="btn btn-sm btn-outline-secondary copy-btn" data-link="{{ route('property.verify.link', $link->token) }}">
                    نسخ الرابط
                </button>
            </div>
        </div>

        <div class="mt-3">
            <img src="{{ 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode(route('property.verify.link', $link->token)) }}" alt="QR Code">
        </div>
    </div>
@endforeach

<script>
    document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const link = btn.dataset.link;
            navigator.clipboard.writeText(link).then(() => {
                alert('تم نسخ الرابط');
            });
        });
    });
</script>

@endsection