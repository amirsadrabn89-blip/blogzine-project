@extends('layouts.layout-site')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | صفحه تغییر رمز عبور
@endsection


{{-- ====(main)=== --}}
@section('site-content')
    <!-- ======================= Inner intro START -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8 mx-auto ">
                    <div class="p-4 p-sm-5  rounded custom-box-shadow">
                        <h2>تغییر رمز عبور</h2>
                        <!-- Form START -->

                        <form class="mt-4" method="POST" action="{{ route('password.update') }}">

                            @csrf

                            <div class="mb-1 mt-2">
                                <label class="form-label">رمز عبور جدید<sup class="text-danger ms-1">*</sup></label>
                                <input type="password" id="password" name="password" class="form-control">
                                <div id="password-strength" class="mb-1 d-flex gap-1 w-100">
                                    <div class="strength-password-part" id="strength_password_1"></div>
                                    <div class="strength-password-part" id="strength_password_2"></div>
                                    <div class="strength-password-part" id="strength_password_3"></div>
                                    <div class="strength-password-part" id="strength_password_4"></div>
                                    <div class="strength-password-part" id="strength_password_5"></div>
                                </div>
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="mb-4 mt-3">
                                <label class="form-label">تکرار رمز عبور<sup class="text-danger ms-1">*</sup></label>
                                <input type="password" name="password_confirmation" class="form-control mb-1">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-success">
                                    ذخیره رمز عبور جدید
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

@push('scripts')
    <script>
        // password strength profile
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");

            const parts = [
                document.getElementById("strength_password_1"),
                document.getElementById("strength_password_2"),
                document.getElementById("strength_password_3"),
                document.getElementById("strength_password_4"),
                document.getElementById("strength_password_5")
            ];

            passwordInput.addEventListener("input", function() {
                const password = passwordInput.value;
                let score = 0;

                if (password.length > 0) {
                    if (password.length >= 8) score++;
                    if (/[a-z]/.test(password)) score++;
                    if (/[A-Z]/.test(password)) score++;
                    if (/[0-9]/.test(password)) score++;
                    if (/[^a-zA-Z0-9]/.test(password)) score++;
                }

                parts.forEach(part => {
                    if (part) part.style.backgroundColor = "rgba(0, 0, 0, 0.2)";
                });

                let color = "";
                switch (score) {
                    case 1:
                        color = "#dc3545";
                        break;
                    case 2:
                        color = "#fd7e14";
                        break;
                    case 3:
                        color = "#ffc107";
                        break;
                    case 4:
                        color = "#9acd32";
                        break;
                    case 5:
                        color = "#198754";
                        break;
                }

                for (let i = 0; i < score; i++) {
                    if (parts[i]) {
                        parts[i].style.backgroundColor = color;
                    }
                }
            });
        });
    </script>
@endpush
