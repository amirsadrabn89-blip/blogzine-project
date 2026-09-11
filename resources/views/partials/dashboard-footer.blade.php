<footer class="pb-3 bg-body-custom">
    <div class="container">
        <div class="card card-body bg-light border">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                    <!-- Copyright -->
                    <div class="text-center text-lg-start">تمامی حقوق این سایت متعلق به وبلاگ می باشد.</div>
                </div>
                <div class="col-lg-6 d-sm-flex align-items-center justify-content-center justify-content-lg-end">
                    <!-- Language switcher -->
                    {{-- <div class="dropup me-0 me-sm-3 mt-3 mt-md-0 text-center text-sm-end">
                        <a class="dropdown-toggle text-body" href="#" role="button" id="languageSwitcher" data-bs-toggle="dropdown" aria-expanded="false"> زبان
                        </a>
                        <ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
                            <li><a class="dropdown-item" href="#">فارسی</a></li>
                            <li><a class="dropdown-item" href="#">انگلیسی </a></li>
                            <li><a class="dropdown-item" href="#">فرانسوی</a></li>
                        </ul>
                    </div> --}}
                    <!-- Links -->
                    <ul class="nav text-center text-sm-end justify-content-center mt-3 mt-md-0">
                        @if (auth()->user()?->is_admin)
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.help-and-rules.page') }}">راهنما و قوانین سایت</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('users_help-and-rules.page') }}">راهنما و قوانین سایت</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
