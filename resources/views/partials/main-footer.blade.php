<footer class="bg-dark d-block rounded-top-5">
    <div class="px-5 pt-5 ">
        <!-- Widgets START -->
        <div class="row justify-content-around g-4 px-xl-5">
            <!-- Footer Widget -->
            <div class="col-8 col-md-4 col-lg-2 col-xl-2 pt-5 me-xl-5">

                <a class="" href="{{ route('index.page') }}">
                    <div class="shadow border rounded-4 p-2 pt-4 pb-3 text-center">
                        <h4 class="fw-bold mt-4 d-inline" style="color: #d0d4d9;">ir.</h4>
                        <h3 class="fw-bold mt-4 d-inline" style="color: #d0d4d9;">BlogZine</h3>
                        <div class="border-bottom rounded-5 py-2"></div>
                    </div>
                </a>

            </div>
            <!-- Footer Widget -->
            <div class="col-md-3 col-lg-2 col-xl-2 d-none d-md-block">
                <h5 class="fw-semibold mb-4 text-white">دسته بندی ها</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="nav flex-column text-primary-hover">
                            @foreach ($popularCategories as $category)
                                <li class="nav-item mb-1"><a class="nav-link pt-0" href="{{ route('post-grid-masonry-filter.page', ['category_id' => $category->id]) }}">{{ $category->title }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer Widget -->
            <div class="col-md-5 col-lg-4 col-xl-3 d-none d-md-block">
                <h5 class="fw-semibold mb-4 text-white">تیتر اخبار روز</h5>

                @foreach ($latestArticles as $article)
                    <div class="nav flex-column position-relative d-inline-block mb-3" style="color: #d0d4d9;">
                        ● <a href="{{ route('articles.show', $article) }}" class="stretched-link text-reset btn-link mb-3">{{ $article->title }}</a>
                    </div>
                    <br>
                @endforeach


            </div>
            <!-- Footer Widget -->
            <div class="col-md-12 col-sm-6 col-lg-2">
                <div class="border-bottom border-1 bg-secondary w-100 my-3 d-block d-lg-none"></div>
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <h5 class="fw-semibold mb-4 text-white">اپلیکیشن موبایل</h5>
                    <p class="text-body-secondary">برنامه را دانلود کنید و آخرین اخبار فوری و مقالات روزانه را دریافت کنید.</p>
                    <div class="row g-2 d-md-flex align-items-center justify-content-center">
                        <div class="col-3 col-lg-12 col-xl-6">
                            <a href="https://www.apple.com/app-store/"><img class="w-100" src="{{ asset('assets/images/app-store.svg') }}" alt="app-store"></a>
                        </div>
                        <div class="col-3 col-lg-12 col-xl-6">
                            <a href="https://play.google.com/store/games?hl=en"><img class="w-100" src="{{ asset('assets/images/google-play.svg') }}" alt="google-play"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widgets END -->
    </div>

    <!-- Footer copyright START -->
    <div class="bg-dark-overlay-3 mt-5">
        <div class="container">
            <div class="row align-items-center justify-content-md-between py-4">
                <div class="col-md-4">
                    <!-- Copyright -->
                    <div class="text-center text-md-start fw-bold">تمامی حقوق محفوظ است</div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-center">
                    <!-- Links -->
                    <ul
                        class="nav fw-bold text-center text-sm-end justify-content-center justify-content-center mt-3 mt-md-0">
                        <li class="nav-item"><a class="nav-link" href="{{ route('about_us.page') }}">درباره ما</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact_us.page') }}">تماس با ما</a></li>
                    </ul>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-end">
                    {{-- <ul class="nav d-flex flex-row-reverse justify-content-center align-items-end ">
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-telegram  fa-fw me-2" style="font-size: 22px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-instagram fa-fw me-2" style="font-size: 22px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-whatsapp  fa-fw me-2" style="font-size: 22px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-linkedin  fa-fw me-2" style="font-size: 22px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-youtube   fa-fw me-2" style="font-size: 22px;"></i></a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Footer copyright END -->
</footer>
