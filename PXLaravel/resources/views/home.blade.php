<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
                    <h3 class="h3 my-4">
                        Welcome to your BookHorizon Backend
                    </h3>

                    <div class="text-muted">
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-6 pr-0">
                        <div class="card-body border-right border-bottom p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="https://laravel.com/docs" class="h5 font-weight-bolder text-decoration-none text-dark">Book Rented</a>
                                    </div>
                                    <p class="text-muted">
                                    
                                    </p>
                                    <a href="https://laravel.com/docs" class="text-decoration-none">
                                        <div class="mt-3 d-flex align-content-center font-weight-bold text-primary">
                                            <div>Explore the documentation</div>

                                            <div class="ml-1 text-primary">
                                                <svg viewBox="0 0 20 20" fill="currentColor" width="16" class="arrow-right w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-0">
                        <div class="card-body border-bottom p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="https://laracasts.com" class="h5 font-weight-bolder text-decoration-none text-dark">Sales</a>
                                    </div>
                                    <p class="text-muted">
                                    </p>
                                    <a href="https://laravel.com/docs" class="text-decoration-none">
                                        <div class="mt-3 d-flex align-content-center font-weight-bold text-primary">
                                            <div>Start watching Laracasts</div>

                                            <div class="ml-1 text-primary">
                                                <svg viewBox="0 0 20 20" fill="currentColor" width="16" class="arrow-right w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pr-0">
                        <div class="card-body border-right p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="https://getbootstrap.com/" class="h5 font-weight-bolder text-decoration-none text-dark">Newest Added</a>
                                    </div>
                                    <p class="text-muted">
                                    
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-0">
                        <div class="card-body p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                               </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <span class="h5 font-weight-bolder text-decoration-none text-dark">Stock Warning !</span>
                                    </div>
                                    <p class="text-muted">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>