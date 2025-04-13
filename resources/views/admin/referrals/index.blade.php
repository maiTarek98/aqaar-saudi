@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h4>نقاط الولاء</h4>
        </div>
        <div class="card-body text-center">
            <p>اكسب نقاط عن كل دعوة </p>
            <h3>{{ $referral->referral_code ?? 'N/A' }}</h3>
            <button onclick="copyToClipboard('{{ $referral->referral_code }}')" class="btn btn-primary">
                نسخ الكود
            </button>
            <!-- WhatsApp Sharing -->
            <a href="https://wa.me/?text=استخدم كود الإحالة الخاص بي {{ $referral->referral_code }} للحصول على نقاط!" target="_blank" class="btn btn-success">
                <i class="bi bi-whatsapp"></i> WhatsApp
            </a>

            <!-- Twitter Sharing -->
            <a href="https://twitter.com/intent/tweet?text=استخدم+كود+الإحالة+الخاص+بي+{{ $referral->referral_code }}+للحصول+على+نقاط!" target="_blank" class="btn btn-info">
                <i class="bi bi-twitter-x"></i> Twitter
            </a>

            <!-- Telegram Sharing -->
            <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text=استخدم كود الإحالة الخاص بي {{ $referral->referral_code }} للحصول على نقاط!" target="_blank" class="btn btn-primary">
                <i class="bi bi-telegram"></i> Telegram
            </a>
            <div class="mt-4">
                <h5>نقاط الولاء الحالية</h5>
                <h2>{{ $referral->points ?? 0 }}</h2>
            </div>

            <!-- Trigger Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#referralLogsModal">
    عرض سجل النقاط
</button>

<!-- Modal Structure -->
<div class="modal fade" id="referralLogsModal" tabindex="-1" aria-labelledby="referralLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="referralLogsModalLabel">سجل النقاط</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>المستخدم المحال</th>
                            <th>النقاط المكتسبة</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($referral->referral_logs as $log)
                            <tr>
                                <td>{{ $log->referred_user?->name }}</td>
                                <td>{{ $log->points_awarded }}</td>
                                <td>{{ $log->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                        <td class="text-center text-muted" style="font-size: 25px" colspan="8">
                                            {{ trans('main.Norequests') }}
                                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

<script>
    function copyToClipboard(code) {
        navigator.clipboard.writeText(code);
        alert('تم نسخ الكود بنجاح!');
    }
</script>
@endsection