@extends('layouts.layout-site')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | صفحه بررسی کد تأیید
@endsection


{{-- ====(main)=== --}}
@section('site-content')
    <!-- ======================= Inner intro START -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8 mx-auto ">
                    <div class="p-4 p-sm-5  rounded custom-box-shadow">
                        <h2>بررسی کد تأیید</h2>
                        <!-- Form START -->
                        <form class="mt-4" method="POST" action="{{ route('password.check-otp') }}">

                            @csrf

                            <div class="mb-4 mt-5">
                                <label class="form-label">کد تایید<sup class="text-danger ms-1">*</sup></label>
                                <input type="text" name="otp" maxlength="5" class="form-control mb-1">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('otp')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-success">
                                    تایید کد
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Inner intro END -->
@endsection
