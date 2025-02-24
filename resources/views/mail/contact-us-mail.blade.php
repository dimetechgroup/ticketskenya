<x-mail::message>
# {{ $data['subject'] }}

    You have received a new message from the contact form. Here are the details:

**Name:**   {{ $data['name'] }}

**Email:**  {{ $data['email'] }}

**Phone Number:**   {{ $data['phone_number'] }}

##  Message:

{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
