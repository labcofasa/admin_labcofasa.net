@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://app.labcofasa.net/images/empresas/logo/1/cofasalogo.png" class="logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
