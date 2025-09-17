@component('mail::message')
# Reminder: Draft Not Submitted

You created a draft management action **{{ $managementAction->sr_name }}** on {{ $managementAction->created_at->toDayDateTimeString() }} but haven’t submitted it yet.

Please review and submit it when ready.

@component('mail::button', ['url' => route('keyActions.edit', $managementAction->id)])
Open Draft
@endcomponent

Thanks,<br>{{ config('app.name') }}
@endcomponent
