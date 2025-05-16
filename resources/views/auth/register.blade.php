<x-guest-layout>
    <div class="bg-gray-50 min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">
            <a href="javascript:void(0)">
                <img src="https://th.bing.com/th/id/OIP.i6_kLshPRkklgjp7i-7nQQAAAA?w=156&h=181&c=7&r=0&o=5&pid=1.7"
                     alt="logo" class="w-40 mb-8 mx-auto block" />
            </a>

            <div class="p-8 rounded-2xl bg-white shadow">
                <h2 class="text-slate-900 text-center text-3xl font-semibold">Daftar</h2>
                <h3 class="text-slate-900 text-center text-xl font-medium mt-1">Sistem Prediksi Kebutuhan Pupuk</h3>

                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="text-slate-800 text-sm font-medium mb-2 block">Email</label>
                        <input id="email" name="email" type="email" required autofocus autocomplete="username"
                            class="w-full text-slate-800 text-sm border border-slate-300 px-4 py-3 rounded-md outline-blue-600"
                            placeholder="Masukkan email anda" />
                        @error('email')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="text-slate-800 text-sm font-medium mb-2 block">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="w-full text-slate-800 text-sm border border-slate-300 px-4 py-3 rounded-md outline-blue-600"
                            placeholder="Masukkan password" />
                        @error('password')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="text-slate-800 text-sm font-medium mb-2 block">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                            class="w-full text-slate-800 text-sm border border-slate-300 px-4 py-3 rounded-md outline-blue-600"
                            placeholder="Ulangi password" />
                        @error('password_confirmation')
                            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit & Link -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full py-2 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-red-600 hover:bg-blue-700 focus:outline-none cursor-pointer">
                            Register
                        </button>

                        <p class="text-slate-800 text-sm mt-6 text-center">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">
                                Login di sini
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
