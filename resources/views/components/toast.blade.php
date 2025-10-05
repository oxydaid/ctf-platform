@props(['on'])

<div
    x-data="{ showToast: false, timeout: null }"
    x-init="
        @this.on('{{ $on }}', () => {
            clearTimeout(timeout);
            showToast = true;
            timeout = setTimeout(() => {
                showToast = false
            }, 3000);
        })
    "
    x-show.transition.out.opacity.duration.1500ms="showToast"
    x-transition:leave.opacity.duration.1500ms
    style="display: none;"
    {{-- Atribut `class` digabungkan agar bisa ditimpa dari luar --}}
    {{ $attributes->merge(['class' => 'fixed bottom-5 right-5 bg-green-600 text-white text-sm p-4 rounded-xl shadow-lg']) }}
>
    <p>{{ $slot }}</p>
</div>