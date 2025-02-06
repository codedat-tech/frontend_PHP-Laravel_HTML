@component('mail::message')
    # Consultation Reminder

    Dear {{ $customerName }},

    This is a reminder for your upcoming consultation with {{ $designerName }} scheduled at {{ $scheduledAt }}.

    Thank you,
    Bucki Decord Vista team.
    {{-- {{ config('app.name') }} --}}
@endcomponent
