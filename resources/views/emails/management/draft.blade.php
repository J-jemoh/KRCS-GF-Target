@component('mail::message')
# Management Action Saved as Draft

Hello {{ $managementAction->user->name }},

Your management action for SR **{{ $managementAction->sr_name }}** was saved as a draft on {{ $managementAction->created_at->toDayDateTimeString() }}.

Please submit it when ready.


@component('mail::button', ['url' => route('keyActions.edit', $managementAction->id)])
Edit Draft
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
