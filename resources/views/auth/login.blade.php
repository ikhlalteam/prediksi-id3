<x-guest-layout>
    <div class="bg-gray-50">
        <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
            <div class="max-w-md w-full">
                <a href="javascript:void(0)">
                    <img src="https://th.bing.com/th/id/OIP.i6_kLshPRkklgjp7i-7nQQAAAA?w=156&h=181&c=7&r=0&o=5&pid=1.7" alt="logo" class="w-40 mb-8 mx-auto block" />
                </a>

                <div class="p-8 rounded-2xl bg-white shadow">
                    <h2 class="text-slate-900 text-center text-3xl font-semibold">Sistem prediksi kebutuhan pupuk </h2>
                    <h3 class="text-slate-900 text-center text-3xl font-semibold">login </h3>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="mt-12 space-y-6">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label class="text-slate-800 text-sm font-medium mb-2 block" for="email">Email</label>
                            <input name="email" id="email" type="email" required autofocus autocomplete="username" 
                                class="w-full text-slate-800 text-sm border border-slate-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Enter your email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="text-slate-800 text-sm font-medium mb-2 block" for="password">Password</label>
                            <input name="password" id="password" type="password" required autocomplete="current-password"
                                class="w-full text-slate-800 text-sm border border-slate-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Enter your password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-slate-300 rounded" />
                                <label for="remember_me" class="ml-3 block text-sm text-slate-800">
                                    Ingat saya 
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}"
                                        class="text-blue-600 hover:underline font-semibold">
                                        lupa password?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Submit -->
                        <div class="!mt-12">
                            <button type="submit"
                                class="w-full py-2 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-red-600 hover:bg-blue-700 focus:outline-none cursor-pointer">
                                login
                            </button>
                        </div>

                        <!-- Register link -->
                        <p class="text-slate-800 text-sm !mt-6 text-center">
                            belum punya akun ?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">
                                daftar sekarang 
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
