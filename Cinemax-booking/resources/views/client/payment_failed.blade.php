@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="alert alert-danger text-center">
        <h2>❌ Thanh toán thất bại!</h2>
        <p>Đã có lỗi xảy ra hoặc bạn đã hủy giao dịch. Vui lòng thử lại hoặc liên hệ hỗ trợ.</p>
        <a href="{{ route('client.home') }}" class="btn btn-primary mt-3">Về trang chủ</a>
    </div>
</div>
@endsection