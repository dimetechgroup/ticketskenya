{{-- resources/views/mail/contact-us-mail.blade.php --}}
<x-mail::message>
    #{{ $data['name'] }}

    You have received a new message from the contact form. Here are the details:

    **Name:** {{ $data['name'] }}
    **Email:** {{ $data['email'] }}
    **Phone Number:** {{ $data['phone_number'] }}

    ## Message:
    {{ $data['message'] }}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
