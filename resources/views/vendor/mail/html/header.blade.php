@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="" class="logo" alt="Logo Cofasa">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
