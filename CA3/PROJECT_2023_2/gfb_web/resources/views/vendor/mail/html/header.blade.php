@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'GFB')
    <h2>GFB</h2>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
