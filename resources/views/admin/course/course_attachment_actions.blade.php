@if ($attachment->type === 'video')
    <a href="{{ route('codeDebugger', ['id' => $attachment->course_id, 'video_id' => $attachment->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">Watch</a>
@elseif ($attachment->type === 'document')
    <a href="{{ asset('courseAssignments/' . $attachment->url) }}" download class="bg-green-500 text-white px-4 py-2 rounded-2xl">Download</a>
@endif
