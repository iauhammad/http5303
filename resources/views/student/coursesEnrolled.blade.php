@if(count($subjects) == 0)
    <h5 class="text-info">{{ $student->first_name . ' ' . $student->last_name }}'s enrollment details</h5>
    <div class="text-warning">Student is currently not enrolled in any courses.</div>
@else
    <h5 class="text-info">{{ $student->first_name . ' ' . $student->last_name }}'s enrollment details</h5>
    <div id="courseEnrolled">
        @foreach($subjects as $objSubject)
            <span data-enrollmentid="{{ $objSubject->id }}" class="chip"
                  data-subjectid="{{ $objSubject->subject_id }}">
                {{ $objSubject->name }}
                <i class="material-icons course-icon" title="Click to disenroll from this course">delete</i>
            </span>
        @endforeach
    </div>
@endif
