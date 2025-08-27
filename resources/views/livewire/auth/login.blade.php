<div>
    <div class="card mb-3">

        <div class="card-body">

            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">login</h5>
                <p class="text-center small">Masukan Email dan Password Anda</p>
            </div>

            <form class="row g-3 needs-validation" wire:submit.prevent="submit" novalidate>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required autocomplete="email" autofocus id="email" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input wire:model="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" required
                        autocomplete="current-password" id="yourPassword" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                            ? 'checked' : '' }} id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                </div>
                {{-- <div class="col-12">
                    <p class="small mb-0">Lupa Password ?
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Klik disini</a>
                        @endif
                    </p>
                </div> --}}
            </form>

        </div>
    </div>
</div>