<div class="bg-gray-200 dark:bg-slate-900 relative">
    <div class="relative">
        @if (session('error'))
            <div id="error" class="left-1/2 bottom-5 bg-red-200 absolute text-left px-5 py-3 -translate-x-1/2">
                <div class="font-bold text-red-600">
                    Erreur !
                </div>
                {{ session('error') }}
                <script>
                    const error_div = document.getElementById('error');

                    setTimeout(() => {
                        error_div.classList.toggle('hidden');    
                    }, 5000);
                </script>
            </div>
        @endif

        @if (session('message'))
            <div id="message" class="left-1/2 bottom-5 bg-white border-2 border-green-600 absolute text-left px-5 py-3 -translate-x-1/2">
                <div class="font-bold text-green-600">
                    🗒️ Information
                </div>
                {{ session('message') }}
                <script>
                    const message_div = document.getElementById('message');

                    setTimeout(() => {
                        message_div.classList.toggle('hidden');    
                    }, 5000);
                </script>
            </div>
        @endif
    </div>

    <div class="absolute flex m-2">
        <a href="{{ route('lang.switch', 'fr') }}" @class([
            'bg-blue-500 rounded-full' => App::getLocale() === 'fr',
            'p-1'
        ])>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path fill="#fff" d="M10 4H22V28H10z"></path><path d="M5,4h6V28H5c-2.208,0-4-1.792-4-4V8c0-2.208,1.792-4,4-4Z" fill="#092050"></path><path d="M25,4h6V28h-6c-2.208,0-4-1.792-4-4V8c0-2.208,1.792-4,4-4Z" transform="rotate(180 26 16)" fill="#be2a2c"></path><path d="M27,4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4Zm3,20c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24Z" opacity=".15"></path><path d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z" fill="#fff" opacity=".2"></path></svg>
        </a>
        <a href="{{ route('lang.switch', 'en') }}" @class([
            'bg-blue-500 rounded-full' => App::getLocale() === 'en',
            'p-1'
        ])>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><rect x="1" y="4" width="30" height="24" rx="4" ry="4" fill="#071b65"></rect><path d="M5.101,4h-.101c-1.981,0-3.615,1.444-3.933,3.334L26.899,28h.101c1.981,0,3.615-1.444,3.933-3.334L5.101,4Z" fill="#fff"></path><path d="M22.25,19h-2.5l9.934,7.947c.387-.353,.704-.777,.929-1.257l-8.363-6.691Z" fill="#b92932"></path><path d="M1.387,6.309l8.363,6.691h2.5L2.316,5.053c-.387,.353-.704,.777-.929,1.257Z" fill="#b92932"></path><path d="M5,28h.101L30.933,7.334c-.318-1.891-1.952-3.334-3.933-3.334h-.101L1.067,24.666c.318,1.891,1.952,3.334,3.933,3.334Z" fill="#fff"></path><rect x="13" y="4" width="6" height="24" fill="#fff"></rect><rect x="1" y="13" width="30" height="6" fill="#fff"></rect><rect x="14" y="4" width="4" height="24" fill="#b92932"></rect><rect x="14" y="1" width="4" height="30" transform="translate(32) rotate(90)" fill="#b92932"></rect><path d="M28.222,4.21l-9.222,7.376v1.414h.75l9.943-7.94c-.419-.384-.918-.671-1.471-.85Z" fill="#b92932"></path><path d="M2.328,26.957c.414,.374,.904,.656,1.447,.832l9.225-7.38v-1.408h-.75L2.328,26.957Z" fill="#b92932"></path><path d="M27,4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4Zm3,20c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24Z" opacity=".15"></path><path d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z" fill="#fff" opacity=".2"></path></svg> 
        </a>
    </div>

    <div class="flex gap-2 justify-center text-sm py-2">
        {{-- https://nucleoapp.com/svg-flag-icons --}}
        
        <form method="POST" action="/logout">
            @csrf
            @auth
                <span class="text-sm dark:text-white">
                    {{ __('footer.status.connected_as') }} 
                    <b class="text-blue-500">
                        {{ auth()->user()->name}} @admin()🗿@endadmin
                    </b>
                    <button type="submit" class="py-1.5 px-2 rounded-full dark:bg-red-900 dark:text-red-300 bg-red-100 text-red-600">
                        {{ __('footer.status.logout') }}
                    </button>
                </span>
            @endauth
        </form>
        
        @admin()
        <a href="/admin" class="py-1.5 px-2 text-sm rounded-full dark:bg-blue-900 dark:text-blue-300 bg-blue-100 text-blue-600">
            {{ __('footer.status.admin_zone')}}
        </a>
        @endadmin
        
        @if (App\Models\Setting::get('maintenance') === "true")
            <span class="text-red-900 font-bold ml-5 my-1">Maintenance active</span>
        @endif
    </div>

    <div class="absolute right-2 bottom-0">
        <x-app.light_switch/>
    </div>
</div>
