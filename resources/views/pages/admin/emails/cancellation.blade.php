    <h2>Dear {{ $user->name }},</h2>
    <p>We regret to inform you that your booking has been cancelled.</p>

    @if($reason)
        <p><strong>Reason:</strong> {{ $reason }}</p>
    @endif

    <p>If you have any questions, feel free to contact our support.</p>

    <p>Thanks</p>

