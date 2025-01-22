<x-mail::message>
# Website Down Detector

The following websites have been found to be offline (not returning a 2xx HTTP status):

<x-mail::table>
| Name                 | URL                 |
| -------------------- | :-----------------: |
@foreach($websites as $website)
| {{ $website->name }} | [{{ $website->url }}]({{ $website->url }}) |
@endforeach
</x-mail::table>
</x-mail::message>
