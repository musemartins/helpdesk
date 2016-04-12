@foreach ($issues as $key => $issue)

<h1>{{ $issue->title }}</h1>
<p>{{ $issue->question }}</p>
<p>{{ $issue->assigned_to }}</p>
@endforeach