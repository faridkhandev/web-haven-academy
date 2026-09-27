<h3>Visitor Information</h3>
<p><strong>Name</strong><br>{{ $data['first_name'] }} {{ $data['last_name'] }}</p>
<p><strong>Email</strong><br>{{ $data['email'] }}</p>
<p><strong>Subject</strong><br>{{ $data['subject'] }}</p>
<p><strong>Message</strong><br>{!! nl2br(e($data['message'])) !!}</p>