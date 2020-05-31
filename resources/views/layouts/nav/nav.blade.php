<nav class="bg-gray-900 shadow mb-8 py-6 border-b border-gray-300">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex flex-col md:flex-row items-center justify-center">
            <div class="mr-6">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 md:ml-4 no-underline">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a class="no-underline hover:underline text-gray-300 text-sm md:ml-12 p-3" href="/movies">{{ __('Movies') }}</a>
            </div>

            <div class="flex-1 text-right flex-col md:flex-row"> 
                @guest
                    <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }}</span>

                    <a href="{{ route('logout') }}"
                       class="no-underline hover:underline text-gray-300 text-sm p-3"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </div>
            @livewire('search-dropdown')
        </div>
    </div>
</nav>
