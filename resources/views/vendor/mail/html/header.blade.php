<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    <img src="{{Info::SettingsGroupKey()['logo'] ?? ''}}" style="width: auto;max-width:100%" class="logo" alt="{{Info::SettingsGroupKey()['title'] ?? env('APP_NAME')}}">
{{-- @if (trim($slot) === 'Laravel')
@else
{{ $slot }}
@endif --}}
</a>
</td>
</tr>
