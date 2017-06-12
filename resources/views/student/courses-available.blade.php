<option value=" ">-- Select a subject --</option>
@foreach($subjects as $objSubject)
    <option value="{{ $objSubject->subject_id }}" >{{ $objSubject->name }}</option>
@endforeach